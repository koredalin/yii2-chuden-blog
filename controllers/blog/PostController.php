<?php

namespace app\controllers\blog;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\behaviors\SluggableBehavior;
use app\models\BlogPost;
use app\models\search\BlogPostSearch;
use app\models\BlogSubscription;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for BlogPost model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        // TODO - https://code.tutsplus.com/tutorials/how-to-program-with-yii2-sluggable-behavior--cms-23222
        return [
			'access' => [
				'class' => AccessControl::className(),
			    'ruleConfig' => [
			        'class' => AccessRule::className(),
			    ],
				'only' => ['create', 'update', 'delete', 'view', 'index', 'page'],
				'rules' => [
					[
						'actions' => ['view', 'index', 'page'],
						'allow' => true,
						'roles' => ['?', '@', 'admin'],
					],
					[
						'actions' => ['create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'mesage',
                // 'slugAttribute' => 'slug', // Not needed.
            ],
        ];
    }
    
    public function getPageRoute(BlogPost $model)
    {
        if (!isset($model->id) || !isset($model->slug)) {
            return ['/blog/post'];
        }
        return ['/blog/post/page', 'id'=>$model->id, 'slug'=>$model->slug];
    }

    public function getPageUrl(BlogPost $model)
    {
        return \yii\helpers\Url::to($this->getPageRoute($model));
    }

    /**
     * Lists all BlogPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPost model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Forecast model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPage($id, $language, $slug)
    {
        $model = $this->findPageModel($id, $language, $slug);
        $isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin;
        if ((int) $model->published != 1 && !$isAdmin) {
            return $this->redirect(['/blog/post']);
        }
        $this->needSubscription($model);
        Yii::$app->language = trim($model->language);
        $alterLangsModels = $model::find()->getAlternativeLanguages($model->slug, $model->language);
        $subscriptionsNumber = (int)BlogSubscription::find()->countAllSubscriptions();
        $commentModel = new BlogComment();
        
        return $this->render('page', [
            'model' => $model,
            'commentModel' => $commentModel,
            'alterLangsModels' => $alterLangsModels,
            'subscriptionsNumber' => $subscriptionsNumber,
        ]);
    }

    /**
     * Creates a new BlogPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogPost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BlogPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BlogPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the BlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPageModel($id, $language, $slug)
    {
        $language = trim($language);
        if (strlen($language) != 5) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        $language = strtolower(substr($language, 0, 2)) . '-' . strtoupper(substr($language, -2));
        if (($model = BlogPost::find()->where(['id' => (int)$id, 'language' => $language, 'slug' => strtolower(trim($slug))])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

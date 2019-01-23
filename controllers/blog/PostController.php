<?php

namespace app\controllers\blog;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use app\models\BlogPost;
use app\models\search\BlogPostSearch;
use app\models\BlogComment;
use app\models\BlogCommentLike;
use app\models\Language;
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
        // https://code.tutsplus.com/tutorials/how-to-program-with-yii2-sluggable-behavior--cms-23222
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

    public static function getAssembledPostPageUrl(BlogPost $postModel)
    {
        return '/blog/post/'.$postModel->id.'/'.strtolower($postModel->language->code).'/'.$postModel->slug;
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
        Yii::$app->language = trim($model->language->code);
        $alterLangsModels = $model::find()->getAlternativeLanguages($model->slug, $model->language->code);
        $subscriptionsNumber = (int)BlogSubscription::find()->countAllSubscriptions();
        $commentModel = new BlogComment();
        $user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->id;
        $userCommentLikeIdsPerPost = array_column(BlogCommentLike::find()->getUserCommentLikeIdsPerPost($user_id, $id), 'blog_comment_id');
        !is_array($userCommentLikeIdsPerPost) ? $userCommentLikeIdsPerPost = array() : false;
        
        return $this->render('page', [
            'model' => $model,
            'commentModel' => $commentModel,
            'alterLangsModels' => $alterLangsModels,
            'subscriptionsNumber' => $subscriptionsNumber,
            'userCommentLikeIdsPerPost' => $userCommentLikeIdsPerPost,
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
        $languageItems = ArrayHelper::map(Language::find()->all(), 'id', 'name');
        return $this->render('create', [
            'model' => $model,
            'languageItems' => $languageItems,
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
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $languageItems = ArrayHelper::map(Language::find()->all(), 'id', 'name');
        return $this->render('update', [
            'model' => $model,
            'languageItems' => $languageItems,
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
        $languageObj = Language::find()->select('id')->where(['code' => $language]);
        if (($model = BlogPost::find()->where(['id' => (int)$id, 'language_id' => $languageObj, 'slug' => strtolower(trim($slug))])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

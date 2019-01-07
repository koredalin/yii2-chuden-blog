<?php

namespace app\controllers\blog;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use app\models\BlogComment;
use app\models\search\BlogCommentSearch;
use app\models\BlogPost;
use app\models\BlogSubscription;
use yii\web\NotFoundHttpException;

/**
 * CommentController implements the CRUD actions for BlogComment model.
 */
class CommentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
			    'ruleConfig' => [
			        'class' => AccessRule::className(),
			    ],
				'only' => ['create', 'update', 'delete', 'defaultcreate', 'defaultupdate', 'defaultdelete', 'view', 'index'],
				'rules' => [
					[
						'actions' => ['create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['?', '@', 'admin'],
					],
					[
						'actions' => ['defaultcreate', 'defaultupdate', 'defaultdelete', 'view', 'index'],
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
        ];
    }
    
    private function isAuthorizedUser(BlogComment $model)
    {
        $isAdmin = Yii::$app->user->identity->isAdmin;
        if ($isAdmin || (int)$model->user->id == (int)Yii::$app->user->identity->id) {
            return true;
        }
        return false;
    }

    /**
     * Lists all BlogComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogComment model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            $this->redirect(['/blog/post']);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new BlogComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($blog_post_id, $reply_to_id = 0)
    {
        $model = new BlogComment();
        $postModel = BlogPost::findOne($blog_post_id);
        if (!isset($postModel)) {
            $this->redirect(['/blog/post']);
        }
        $model->user_id = (int)Yii::$app->user->identity->id;
        $model->blog_post_id = (int)$postModel->id;
        $reply_to_id = (int)$reply_to_id;
        if ($reply_to_id > 0) {
            $leadModel = BlogComment::find()->where(['blog_post_id' => $blog_post_id, 'id' => $reply_to_id])->one();
            if (isset($leadModel)) {
                $model->parent_id = ($leadModel->parent_id > 0) ? (int)$leadModel->parent_id : (int)$leadModel->id;
                $model->reply_to_id = (int)$reply_to_id;
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$this->getAssembledPostPageUrl($postModel)]);
        }
        Yii::$app->language = trim($postModel->language);
        $alterLangsModels = BlogPost::find()->getAlternativeLanguages($postModel->slug, $postModel->language);
        $subscriptionsNumber = (int)BlogSubscription::find()->countAllSubscriptions();
        
        return $this->render('/blog/post/page', [
            'model' => $postModel,
            'commentModel' => $model,
            'alterLangsModels' => $alterLangsModels,
            'subscriptionsNumber' => $subscriptionsNumber,
        ]);
    }

    /**
     * Updates an existing BlogComment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postModel = BlogPost::findOne($model->blog_post_id);
        if (!isset($model) || !isset($postModel)) {
            $this->redirect(['/blog/post']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save(false);
            return $this->redirect([$this->getAssembledPostPageUrl($postModel)]);
        }
        Yii::$app->language = trim($postModel->language);
        $alterLangsModels = BlogPost::find()->getAlternativeLanguages($postModel->slug, $postModel->language);
        $subscriptionsNumber = (int)BlogSubscription::find()->countAllSubscriptions();

        return $this->render('/blog/post/page', [
            'model' => $postModel,
            'commentModel' => $model,
            'alterLangsModels' => $alterLangsModels,
            'subscriptionsNumber' => $subscriptionsNumber,
        ]);
    }

    /**
     * Deletes an existing BlogComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $postModel = BlogPost::findOne($model->blog_post_id);
        if (!isset($model) || !isset($postModel)) {
            $this->redirect(['/blog/post']);
        }
        $model->delete();

        return $this->redirect([$this->getAssembledPostPageUrl($postModel)]);
    }

    /**
     * Creates a new BlogComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDefaultcreate()
    {
        $model = new BlogComment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BlogComment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDefaultupdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BlogComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDefaultdelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function getAssembledPostPageUrl(BlogPost $postModel)
    {
        return '/blog/post/'.$postModel->id.'/'.strtolower($postModel->language).'/'.$postModel->slug;
    }

    /**
     * Finds the BlogComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

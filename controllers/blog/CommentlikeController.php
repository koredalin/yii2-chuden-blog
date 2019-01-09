<?php

namespace app\controllers\blog;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use app\models\BlogPost;
use app\models\BlogComment;
use app\models\BlogCommentLike;
use app\models\search\BlogCommentLikeSearch;
use yii\web\NotFoundHttpException;

/**
 * CommentlikeController implements the CRUD actions for BlogCommentLike model.
 */
class CommentlikeController extends Controller
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
				'only' => ['like', 'create', 'update', 'delete', 'view', 'index'],
				'rules' => [
					[
						'actions' => ['like', 'delete'],
						'allow' => true,
						'roles' => ['@', 'admin'],
					],
					[
						'actions' => ['create', 'update', 'view', 'index'],
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

    /**
     * Lists all BlogCommentLike models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogCommentLikeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogCommentLike model.
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
     * Creates a new BlogCommentLike model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogCommentLike();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    private function getAssembledPostPageUrl(BlogPost $postModel)
    {
        return '/blog/post/'.$postModel->id.'/'.strtolower($postModel->language).'/'.$postModel->slug;
    }
    
    private function updateCommentLikes($blog_comment_id)
    {
        $commentLikes = BlogCommentLike::find()->countCommentLikes($blog_comment_id);
        $commentModel = BlogComment::findOne($blog_comment_id);
        $commentModel->likes = $commentLikes;
        $commentModel->updated_at = date('Y-m-d H:i:s');
        $commentModel->save(false);
    }


    public function actionLike($blog_comment_id)
    {
        $model = new BlogCommentLike();
        $model->user_id = (int)Yii::$app->user->identity->id;
        $model->blog_comment_id = (int)$blog_comment_id;
        if ($model->save()) {
            $this->updateCommentLikes($blog_comment_id);
            $postModel = $model->blogComment->blogPost;
            if (isset($postModel)) {
                return $this->redirect([$this->getAssembledPostPageUrl($postModel)]);
            }
        }
        
        return $this->redirect(['/blog/post']);
    }
    
    public function actionDislike($blog_comment_id)
    {
        $model = BlogCommentLike::findOne(['user_id' => (int)Yii::$app->user->identity->id, 'blog_comment_id' => (int)$blog_comment_id]);
        $postModel = $model->blogComment->blogPost;
        $model->delete();
        if (isset($postModel)) {
            $this->updateCommentLikes($blog_comment_id);
            return $this->redirect([$this->getAssembledPostPageUrl($postModel)]);
        }
        
        return $this->redirect(['/blog/post']);
    }

    /**
     * Updates an existing BlogCommentLike model.
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
     * Deletes an existing BlogCommentLike model.
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
     * Finds the BlogCommentLike model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogCommentLike the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogCommentLike::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

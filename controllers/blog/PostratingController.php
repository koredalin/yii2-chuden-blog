<?php

namespace app\controllers\blog;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use app\controllers\blog\PostController;
use app\models\BlogPost;
use app\models\BlogPostRating;
use app\models\search\BlogPostRatingSearch;
use yii\web\NotFoundHttpException;

/**
 * PostratingController implements the CRUD actions for BlogPostRating model.
 */
class PostratingController extends Controller
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
				'only' => ['vote', 'create', 'update', 'delete', 'view', 'index'],
				'rules' => [
					[
						'actions' => ['vote'],
						'allow' => true,
						'roles' => ['@', 'admin'],
					],
					[
						'actions' => ['create', 'update', 'view', 'index', 'delete'],
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
     * Lists all BlogPostRating models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogPostRatingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPostRating model.
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
     * Creates a new BlogPostRating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    protected function create($blog_post_id, $rating)
    {
        $model = new BlogPostRating();
        $model->user_id = Yii::$app->user->identity->id;
        $model->blog_post_id = (int)$blog_post_id;
        $model->rating = (int)$rating;
        if ($model->save()) {
            $this->updatePostRating($blog_post_id);
            return $this->redirect([PostController::getAssembledPostPageUrl($model->blogPost)]);
        }

        return $this->redirect(['/blog/post']);
    }

    /**
     * Updates an existing BlogPostRating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function update(BlogPostRating &$model, $rating)
    {
        $model->rating = (int)$rating;
        if ($model->save()) {
            $this->updatePostRating($model->blog_post_id);
            return $this->redirect([PostController::getAssembledPostPageUrl($model->blogPost)]);
        }

        return $this->redirect(['/blog/post']);
    }
    
    private function updatePostRating($blog_post_id)
    {
        $postRating = BlogPostRating::find()->getPostRating($blog_post_id);
        $postVoteCount = BlogPostRating::find()->getPostVoteCount($blog_post_id);
        $postModel = BlogPost::findOne($blog_post_id);
        $postModel->rating = $postRating;
        $postModel->vote_count = $postVoteCount;
        $postModel->updated_at = date('Y-m-d H:i:s');
        $postModel->save(false);
    }

    /**
     * Updates an existing BlogPostRating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $blog_post_id, $rating
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVote($blog_post_id, $rating)
    {
        $model = BlogPostRating::findOne(['user_id' => (int)Yii::$app->user->identity->id, 'blog_post_id' => (int)$blog_post_id]);
        if (!isset($model)) {
            return $this->create($blog_post_id, $rating);
        }
        
        return $this->update($model, $rating);
    }

    /**
     * Creates a new BlogPostRating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogPostRating();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BlogPostRating model.
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
     * Deletes an existing BlogPostRating model.
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
     * Finds the BlogPostRating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogPostRating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPostRating::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

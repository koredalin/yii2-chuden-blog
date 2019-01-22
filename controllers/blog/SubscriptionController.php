<?php

namespace app\controllers\blog;

use Yii;
use app\models\BlogSubscription;
use app\models\search\BlogSubscriptionSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Language;
use yii\web\NotFoundHttpException;

/**
 * SubscriptionController implements the CRUD actions for BlogSubscription model.
 */
class SubscriptionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlogSubscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSubscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogSubscription model.
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
     * Creates a new BlogSubscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogSubscription();

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
     * Updates an existing BlogSubscription model.
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
     * Deletes an existing BlogSubscription model.
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
     * Finds the BlogSubscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BlogSubscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogSubscription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

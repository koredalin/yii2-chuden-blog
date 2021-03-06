<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\controllers\blog\PostController;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'published',
            [// Published
                'label' => 'Published',
                'attribute' => 'published',
                'format' => 'raw',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin ? true : false,
                'value' => function ($data) {
                    return $data->published == 1 ? '<span class="green">PUBLISHED</span>' : 'NOT PUBLISHED';
                },
            ],
//            'language',
            [// Language
                'label' => 'Language',
                'attribute' => 'languageCode',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->language->code.' - '.$data->language->name;
                },
            ],
//            'slug',
            [// Slug. Link to Post Page.
                'label' => 'Slug',
                'attribute' => 'slug',
                'format' => 'raw',
                'value' => function ($data) {
                    $postUrl = PostController::getAssembledPostPageUrl($data);
                    $result = Html::a($data->slug, [$postUrl], ['data-pjax' => '0',]);
                    return $result;
                },
            ],
            'title',
            [// Slug. Link to Post Page.
                'label' => 'Author',
                'attribute' => 'author',
                'format' => 'raw',
                'value' => function ($data) {
                    $result = $data->author->username;
                    return $result;
                },
            ],
            //'meta_description',
            //'blog_category_id',
            //'tags',
            //'content:ntext',
            //'rating',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

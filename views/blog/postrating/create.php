<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogPostRating */

$this->title = Yii::t('app', 'Create Blog Post Rating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Post Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

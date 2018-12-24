<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogCommentRating */

$this->title = Yii::t('app', 'Create Blog Comment Rating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Comment Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

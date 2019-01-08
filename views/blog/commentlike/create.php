<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogCommentLike */

$this->title = Yii::t('app', 'Create Blog Comment Like');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Comment Likes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-like-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

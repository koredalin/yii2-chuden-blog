<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogComment */

$this->title = Yii::t('app', 'Create Blog Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

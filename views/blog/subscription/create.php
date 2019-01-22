<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogSubscription */

$this->title = Yii::t('app', 'Create Blog Subscription');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-subscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'languageItems' => $languageItems,
    ]) ?>

</div>

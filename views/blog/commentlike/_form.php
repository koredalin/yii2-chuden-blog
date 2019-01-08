<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogCommentLike */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-comment-like-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'blog_comment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

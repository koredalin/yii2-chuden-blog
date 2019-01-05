<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogSubscription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'language')->dropDownList([ 'en-GB' => 'En-GB', 'bg-BG' => 'Bg-BG', 'ru-RU' => 'Ru-RU', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

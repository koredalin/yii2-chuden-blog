<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;
use app\models\BlogPost;

/* @var $this yii\web\View */
/* @var $model app\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'published')->dropDownList([ BlogPost::NOT_PUBLISHED => Yii::t('app', 'Not Published'), BlogPost::PUBLISHED => Yii::t('app', 'Published'), ], ['prompt' => '', 'options'=>[BlogPost::NOT_PUBLISHED => ['Selected' => true]]]) ?>

    <div><strong>Language</strong></div>
    <?php
    $enGb = 61;
    echo Html::activeDropDownList($model, 'language_id', $languageItems, ['prompt' => '', 'options'=>[$enGb => ['Selected' => true]], 'class' => 'form-control']);
    ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <div><strong>Category</strong></div>
    <?= Html::activeDropDownList($model, 'blog_category_id', $categoryItems, ['prompt' => '', 'class' => 'form-control']) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'content' => Yii::t('app', 'Content'), 'audio' => Yii::t('app', 'Audio'), 'video' => Yii::t('app', 'Video'), ], ['prompt' => '', 'options'=>['content' => ['Selected' => true]]]) ?>
    
    <div id="podcast_url_block" class="<?php echo (!in_array($model->type, ['audio', 'video'])) ? 'hidden' : ''; ?>">
        <?php
        echo '<p><strong>'.Yii::t('app', 'Audio-video URL').'</strong></p>';
        echo $form->field($model, 'podcast_url')->textarea(['rows' => 6]);
        ?>
    </div>
    <div id="content_block" class="<?php echo (!in_array($model->type, ['', 'content'])) ? 'hidden' : ''; ?>">
        <?php
        echo '<p><strong>'.Yii::t('app', 'Content').'</strong></p>';
        echo MarkdownEditor::widget([
            'model' => $model, 
            'attribute' => 'content',
        ]);
        ?>
    </div>

    <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $this->registerJsFile('@web/js/blog_post_form.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
</div>

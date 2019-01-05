<?php

use yii\helpers\Html;
use kartik\markdown\Markdown;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Forecast */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', $model->title);
//var_dump($this->title); exit;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Posts'), 'url' => ['/blog/post']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' =>  \Yii::$app->params['brand'] . ' | ' . Yii::t('app', $model->description),
]);
?>

<div>
<?php 
    echo Html::a(Html::img('@web/images/sp-subscribe-button.png',
                ['id'=>'sp-subscribe-button', 'alt' => 'Posts Subscription']),
        ['/blog/subscription']);
?>
</div>
<h4>Help us grow. Number of Free Forecasts Subscriptions: <strong><?php echo (int)$subscriptionsNumber; ?></strong></h4>

<div class="game-forecast-view">
    <div id="prev-next-predictions">
        <span class="prev-prediction inline-block">
        <?php
        $prevPost = app\models\BlogPost::find()->getPreviousPost($model->id);
        $nextPost = app\models\BlogPost::find()->getNextPost($model->id);
        if (isset($prevPost)) {
            echo Html::a(Yii::t('app', 'Previous post'), array('/blog/post/'.$prevPost->id.'/'.strtolower($prevPost->language).'/'.$prevPost->slug)).PHP_EOL;
        } else {
            echo Yii::t('app', 'Previous post').PHP_EOL;
        }
        ?>
        </span>
        <span> | </span>
        <span class="next-prediction inline-block">
        <?php
        if ($nextPost > 0) {
            echo Html::a(Yii::t('app', 'Next post'), array('/blog/post/'.$nextPost->id.'/'.strtolower($nextPost->language).'/'.$nextPost->slug)).PHP_EOL;
        } else {
            echo Yii::t('app', 'Next post').PHP_EOL;
        }
        ?>
        </span>
    </div>
    <div id="alter-langs">
        <?php
        $langLinks = '';
        if (isset($alterLangsModels) && is_array($alterLangsModels) && count($alterLangsModels) > 0) {
            $langLinks .= Yii::t('app', 'Open the page in') . ': | ';
            foreach ($alterLangsModels as $langModel) {
                $alternativePostUrl = '/blog/post/'.$langModel->id.'/'.strtolower($langModel->language).'/'.$langModel->slug;
                $langLinks .= Html::a(Yii::$app->params['languages'][$model->language], [$alternativePostUrl]) . ' | ';
            }
            echo $langLinks;
            unset($langModel);
        } else {
            echo Yii::t('app', 'No pages in alternative languages') . '.';
        }
        unset($alterLangsModels);
        ?>
    </div>
    <?php
    echo '<h1>' . Html::encode($this->title) . '</h1>' . PHP_EOL;
    $this->title .= $title . ' | ' . \Yii::$app->params['brand'];
    ?>
    <h2><?php echo Yii::t('app', 'Blog Post information') . ':'; ?></h2>
    <ul id="forecast_match_info">
        <li><?php echo Yii::t('app', 'Category'); ?>: <strong><?php echo $model->category->name; ?></strong></li>
        <li><?php echo Yii::t('app', 'Post created at'); ?>: <strong><?php echo $model->created_at; ?></strong></li>
        <li><?php echo Yii::t('app', 'Post last update'); ?>: <strong><?php echo Yii::t('app', $model->updated_at); ?></strong></li>
    </ul>
    <div><?php echo Markdown::convert($model->content) . PHP_EOL; ?></div>
</div>
    
<hr>

<?php
$ctrlAct = \Yii::$app->controller->id . '-' . \Yii::$app->controller->action->id;
if (in_array($ctrlAct, array('forecast-addcomment', 'forecast-updatecomment'), true)) {
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($commentModel, 'content')->textarea(['rows' => 6]) ?>
<div>Click the captcha image to change it.</div>
<?php echo $form->field($commentModel, 'verifyCode')->widget(Captcha::className()); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Add Comment'), ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
} else {
    $needLogin = \Yii::$app->user->isGuest ? ' '.Yii::t('app', '/Log-in needed/') : '';
    echo '<div>' . Html::a(Yii::t('app', 'Add a comment').$needLogin, ['/forecast/addcomment', 'id' => (int)$model->id,], ['class' => 'btn btn-primary']) . '</div>' . PHP_EOL;
}
?>

<hr>

<?php
$comments = $commentModel->find()->where(['prediction_id' => (int)$model->id])->orderBy(['updated_at' => SORT_DESC])->all();
$adminUsernames = \Yii::$app->getModule('user')->admins;
foreach ($comments as $key => $comment) {
    $currUsername = $comment->user->username;
?>
    <div class="comment">
        <span class="comment-username inline-block">
            <?php if (in_array($currUsername, $adminUsernames)) {
                echo '<div class="blog-comment-domain"><em>Score Predictor</em></div>'.PHP_EOL;
            } ?>
            <div><strong><?php echo $currUsername; ?></strong></div>
        </span>
        <span class="comment-text inline-block">
            <?php echo Html::encode($comment->content); ?>
        </span>
        <span class="comment-actions inline-block">
            <?php if (!\Yii::$app->user->isGuest && (\Yii::$app->user->identity->id == $comment->user->id || \Yii::$app->user->identity->isAdmin)) {
                echo Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                        ['/forecast/updatecomment', 'id' => $model->id, 'prediction_comment_id' => (int)$comment->id], 
                        ['title' => 'Edit comment', 'data-pjax' => '0',]
                    ) . PHP_EOL;
                echo Html::a('<span class="glyphicon glyphicon-remove"></span>',
                        ['/forecast/deletecomment', 'id' => $model->id, 'prediction_comment_id' => (int)$comment->id], 
                        ['title' => 'Delete comment', 'data-pjax' => '0',]
                    ) . PHP_EOL;
            } ?>
        </span>
    </div>
    <hr>
<?php } ?>





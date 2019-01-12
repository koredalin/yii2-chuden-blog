<?php

use yii\helpers\Html;
use kartik\markdown\Markdown;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\models\BlogComment;
use app\views\helpers\HtmlStarsRating;

/* @var $this yii\web\View */
/* @var $model app\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', $model->title);
//var_dump($this->title); exit;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Posts'), 'url' => ['/blog/post']];
$this->params['breadcrumbs'][] = $this->title;
$brand = \Yii::$app->params['brand'];
$this->registerMetaTag([
    'name' => 'description',
    'content' =>  $brand . ' | ' . Yii::t('app', $model->content),
]);
?>

<div>
<?php 
    echo Html::a(Html::img('@web/images/sp-subscribe-button.png',
                ['id'=>'sp-subscribe-button', 'alt' => 'Posts Subscription']),
        ['/blog/subscription']);
?>
</div>
<h4>Help us grow. Number of all subscriptions: <strong><?php echo (int)$subscriptionsNumber; ?></strong></h4>

<div class="game-forecast-view separator">
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
    $this->title .= ' | ' . \Yii::$app->params['brand'];
    ?>
    <h2><?php echo Yii::t('app', 'Blog Post information') . ':'; ?></h2>
    <ul id="forecast_match_info">
        <li><?php echo Yii::t('app', 'Category'); ?>: <strong><?php echo $model->blogCategory->name; ?></strong></li>
        <li><?php echo Yii::t('app', 'Post created at'); ?>: <strong><?php echo $model->created_at; ?></strong></li>
        <li><?php echo Yii::t('app', 'Post last update'); ?>: <strong><?php echo Yii::t('app', $model->updated_at); ?></strong></li>
    </ul>
    <div><?php echo Markdown::convert($model->content) . PHP_EOL; ?></div>
</div>
<div id="stars-rating" class="separator">
    <span id="current_stars_rating" class="">
        <?php echo HtmlStarsRating::starsRating(round($model->rating, 2)); ?>
    </span>
    <span id="vote_stars_rating_block" class="">
        <?php if (\Yii::$app->user->isGuest) { ?>
        <?php echo Html::a('<span class="glyphicon glyphicon-check"></span>'.Yii::t('app', 'Vote for this post'), ['/user/login'], ['class' => 'btn btn-primary', 'title' => \Yii::t('app', 'Need log-in'), 'data-pjax' => '0']); ?>
        <?php } else { ?>
        <span id="vote_stars_rating" class="hidden">
            <?php echo HtmlStarsRating::starsRatingVote($model->id); ?>
        </span>
        <button type="button" id="logged_stars_vote_button" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>Vote for this post</button>
        <button type="button" id="cancel_logged_stars_vote_button" class="btn btn-warning hidden">Cancel vote</button>
    </span>
        <?php } ?>
</div>

<?php
$ctrlAct = \Yii::$app->controller->id . '-' . \Yii::$app->controller->action->id;
if (in_array($ctrlAct, array('blog/comment-create', 'blog/comment-update'), true)) {
?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($commentModel, 'content')->textarea(['rows' => 6]) ?>
    <div>Click the captcha image to change it.</div>
    <?php echo $form->field($commentModel, 'verifyCode')->widget(Captcha::className()); ?>
    <div class="form-group separator">
        <?= Html::submitButton(Yii::t('app', 'Add Comment'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php
} else {
    $addCommentOptions = ['class' => 'btn btn-primary', 'data-pjax' => '0'];
    \Yii::$app->user->isGuest ? $addCommentOptions['title'] = \Yii::t('app', 'Need log-in') : false;
    echo '<div class="separator">' . Html::a(Yii::t('app', 'Add a comment'), ['/blog/comment/create', 'blog_post_id' => (int)$model->id,], $addCommentOptions) . '</div>' . PHP_EOL;
}
?>

<?php
$parentComments = BlogComment::find()->getParentPostComments($model->id);
$heirComments = BlogComment::find()->getHeirPostComments($model->id);
//echo '$parentComments: ';
//print_r($parentComments);
//echo '$heirComments: ';
//print_r($heirComments);
$rearrangedHeirComments = array();
foreach ($heirComments as $heirCommentModel) {
    $rearrangedHeirComments[(int)$heirCommentModel->parent_id][] = $heirCommentModel;
}
//echo '$rearrangedHeirComments: ';
//print_r($rearrangedHeirComments); exit;
$adminUsernames = \Yii::$app->getModule('user')->admins;
foreach ($parentComments as $key => $commentModel) {
    $currUsername = $commentModel->user->username;
    $isLikedComment = in_array($commentModel->id, $userCommentLikeIdsPerPost);
    echo $this->render('/blog/post/parent_comment', [
        'model' => $model,
        'adminUsernames' => $adminUsernames,
        'currUsername' => $currUsername,
        'commentModel' => $commentModel,
        'brand' => $brand,
        'isLikedComment' => $isLikedComment,
    ]);
    if (in_array($commentModel->id, array_keys($rearrangedHeirComments))) {
        foreach ($rearrangedHeirComments[$commentModel->id] as $heirCommentModel) {
            $currUsername = $heirCommentModel->user->username;
            $isLikedComment = in_array($heirCommentModel->id, $userCommentLikeIdsPerPost);
            echo $this->render('/blog/post/heir_comment', [
                'model' => $model,
                'adminUsernames' => $adminUsernames,
                'currUsername' => $currUsername,
                'commentModel' => $heirCommentModel,
                'brand' => $brand,
                'isLikedComment' => $isLikedComment,
            ]);
        }
    }
}
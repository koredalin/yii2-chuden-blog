<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<div class="parent_comment">
    <span class="comment-username inline-block">
        <?php if (in_array($currUsername, $adminUsernames)) {
            echo '<div class="blog-comment-brand"><em>'.$brand.'</em></div>'.PHP_EOL;
        } ?>
        <div><strong><?php echo $currUsername; ?></strong></div>
    </span>
    <span class="comment-text inline-block">
        <?php echo Html::encode($commentModel->content); ?>
    </span>
    <span class="comment-actions inline-block">
        <?php
        if (!\Yii::$app->user->isGuest) {
            echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
                    ['/blog/comment/create', 'blog_post_id' => $model->id, 'reply_to_id' => $commentModel->id], 
                    ['title' => \Yii::t('app', 'Repy to comment'), 'data-pjax' => '0',]
                ) . PHP_EOL;
            if (\Yii::$app->user->identity->id == $commentModel->user->id || \Yii::$app->user->identity->isAdmin) {
                echo Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                        ['/blog/comment/update', 'id' => $commentModel->id,], 
                        ['title' => \Yii::t('app', 'Edit comment'), 'data-pjax' => '0',]
                    ) . PHP_EOL;
                echo Html::a('<span class="glyphicon glyphicon-remove"></span>',
                        ['/blog/comment/delete', 'id' => $commentModel->id,], 
                        ['title' => \Yii::t('app', 'Delete comment'), 'data-pjax' => '0',]
                    ) . PHP_EOL;
            }
        }
        ?>
    </span>
</div>
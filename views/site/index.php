<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Chuden Blog</h1>

        <p class="lead">Created by Hristo Hristov</p>

        <p><a class="btn btn-lg btn-info" target="_blank" href="https://github.com/koredalin/yii2-chuden-blog">Github repository</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Blog Categories</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?php echo Html::a('Categories &raquo', ['/blog/category'], array('class' => 'btn btn-default')); ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Blog Posts</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p>
                    <?php echo Html::a('Posts &raquo', ['/blog/post'], array('class' => 'btn btn-default')); ?>
                    <?php echo Html::a('Post-Ratings &raquo', ['/blog/postrating'], array('class' => 'btn btn-default')); ?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Blog Comments</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p>
                    <?php echo Html::a('Comments &raquo', ['/blog/comment'], array('class' => 'btn btn-default')); ?>
                    <?php echo Html::a('Comment-Ratings &raquo', ['/blog/commentrating'], array('class' => 'btn btn-default')); ?>
                </p>
            </div>
        </div>

    </div>
</div>

<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use cinghie\cookieconsent\widgets\CookieWidget;

$this->title = 'About Chuden Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Author <a target="_blank" href="https://github.com/koredalin">Hristo Hristov</a>.</p>
    <p>E-mail: <a href="mailto:koredalin@yahoo.com">koredalin@yahoo.com</a>.</p>
    <p>Github repository: <a target="_blank" href="https://github.com/koredalin/yii2-chuden-blog">Chuden Blog</a>.</p>

</div>

<?= CookieWidget::widget([ 
	'message' => 'This website uses cookies to ensure you get the best experience on our website.',
	'dismiss' => 'Got It',
	'learnMore' => 'More info',
	'link' => 'http://silktide.com/privacy-policy',
	'theme' => 'dark-bottom'
]); ?>
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use cinghie\cookieconsent\widgets\CookieWidget;

$this->title = 'About Chuden Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Author Hristo Hristov. koredalin@yahoo.com.
    </p>

</div>

<?= CookieWidget::widget([ 
	'message' => 'This website uses cookies to ensure you get the best experience on our website.',
	'dismiss' => 'Got It',
	'learnMore' => 'More info',
	'link' => 'http://silktide.com/privacy-policy',
	'theme' => 'dark-bottom'
]); ?>
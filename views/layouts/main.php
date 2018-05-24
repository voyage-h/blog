<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $navitems = Yii::$app->user->isGuest ? [
        ['label' => '登陆', 'url' => ['/site/login']],
        ['label' => '注册', 'url' => ['/site/register']]
    ] : [
        ['label' => Html::icon('home').' 首页', 'url' => ['blog/index']],
        ['label' => Html::icon('globe').' 热门', 'url' => ['blog/hot']],
        ['label' => Html::icon('edit').' 发布', 'url' => 'javascript:void(0)','linkOptions'=>['id'=>'publish',' data-toggle'=>'modal','data-target'=>'#publishModal']],
        [
         'label' => Html::icon('user').' '.Yii::$app->user->identity->name,
         'items' => [
              ['label' => '个人中心', 'url' => ['/user/show']],
              '<li class="divider"></li>',
              ['label' => '退出', 'url' => ['/user/logout']],
             ],
         ],
    ];
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navitems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

    </div>
</div>


<!-- publish modal -->
<?
Modal::begin([
     'header' => '<h4>发布状态</h4>',
     'options' => [
         'id' => 'publishModal',
     ]
 ]);?>
<?=app\widgets\PublishFormWidget::widget()?>
<?php Modal::end();?>
<!-- /publish modal -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

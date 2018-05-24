<?php

use app\models\Like;
use Yii\Bootstrap\ActiveForm;

$likeModal = new Like();
$form = ActiveForm::begin([
    'action' => '?r=site/like',           //此处为请求地址 Url用法查看手册
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'options' => [
        'id' => 'like-form',
        'hidden' => true,
    ]
]);
?>
<?=$form->field($likeModal,'id')->fileInput();?>
<?php ActiveForm::end(); ?>

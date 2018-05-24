<?php
use yii\bootstrap\Modal;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

Modal::begin([
     'header' => '<h4>上传头像</h4>',
     'options' => [
         'id' => 'uploadModal',
     ]
 ]);?>
<?php $form = ActiveForm::begin([
    'action' => '?r=upload/avatar',
    'options'=>[
    'class' => 'upload-avatar-form',
    'enctype' => 'multipart/form-data',
]]); ?>
<?= $form->field(new app\models\UploadForm(), 'imageFiles')->fileInput(['class'=>'upload-avatar-input']) ?>

<div class="form-group upload-images upload-avatar">
<a href="javascript:void(0)"><img src="/images/upload/<?=$user->avatar?>"></a>
</div>
<div class="form-group" style="text-align:right">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
<?php Modal::end();?>

<?php

use yii\bootstrap\Modal;
use yii\bootstrap\Html;

?>

<p class="card-img">
<?php foreach(json_decode($imgs) as $img) : ?>
<a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal"><img src="/images/upload/<?=$img?>"></a>
<?php endforeach ?>
</p>

<?php
Modal::begin([
     'options' => [
         'id' => 'previewModal',
     ],
 ]);?>
<?=Html::a(Html::icon('glyphicon glyphicon-chevron-left'),'javascript:void(0)',['class'=>'preview-img-btn prev-img']);?>
<?=Html::img('/images/upload/default.jpg',['class'=>'previewModal-img'])?>
<?=Html::a(Html::icon('glyphicon glyphicon-chevron-right'),'javascript:void(0)',['class'=>'preview-img-btn next-img']);?>

<?php
$css = <<<CSS
.previewModal-img {
    width:100%;
}
.preview-img-btn {
    font-size: 5rem;
    color:#ddd;
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
}
.prev-img {
   left:20px;
}
CSS;

$js = <<<JS
var previewObj;
function replaceImg(obj) {
    var src = $(obj).find('img').attr('src');
    if (src != undefined) {
        $(".previewModal-img").attr('src',src);
        previewObj = obj;
    }
}
$('#previewModal').on('show.bs.modal', function (e) {
    replaceImg(e.relatedTarget);
})
$(".next-img").click(function(){
    replaceImg($(previewObj).next());
})
$(".prev-img").click(function(){
    replaceImg($(previewObj).prev());
})
JS;
$this->registerCss($css);
$this->registerJs($js);
Modal::end();
?>

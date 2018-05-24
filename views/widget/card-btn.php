<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use app\models\Blog;

$url_event = Url::to(['event/show','id'=>$blog->id]);
$url_comment = Url::to(['comment/show','id'=>$blog->id]);

?>

<div class="card-btn">

<div class="card-btn-left">
  <?=Html::a(Html::icon('heart').' 热度 '.Html::tag('em',$blog->popularity_count),$url_event,['class'=>'card-btn-trend'.(Url::current() == $url_event ? ' active' : '')])?>
 </div>

<div class="card-btn-right">
  <?=Html::a(Html::icon('thumbs-up'),'javascript:void(0)',['data-id'=>$blog->id,'class'=>'card-btn-like'.(!empty($blog->like) ? ' active':'')])?>
  <?=Html::a(Html::icon('comment'),$url_comment,['class'=>(Url::current() == $url_comment ? ' active' : '')])?>
  <?=Html::a(Html::icon('retweet'),'javascript:void(0)',['data-id'=>$blog->id,'data-target'=>'#repostModal','data-toggle'=>'modal'])?>
</div>

</div>

<?php

Modal::begin([
     'header' => '<h4>转发</h4>',
     'options' => [
         'id' => 'repostModal',
     ]
 ]);?>
<?=app\widgets\PublishFormWidget::widget(['options'=>['action'=>'?r=blog/repost']])?>
<?php Modal::end();?>

<?php

$js = <<<JS
//转发
$("#repostModal").on("show.bs.modal", function (e) {
    $(e.target).find("#blog-id").val($(e.relatedTarget).attr("data-id"));
})
//点赞
$(".card-btn-like").click(function(){
    var obj = $(this).parents('.card-btn').find('.card-btn-trend');
    var likeobj = $(this);
    var id = $(this).attr('data-id');
    $.ajax({
        url: "?r=like/save",
        type: "POST",
        dataType: "json",
        data: {'id':id},
        success: function(data) {
            var em = $(obj).find('em');
            var origin_num = $(em).text();
            if (data == 1) {
                $(likeobj).addClass('active');
            } else {
                $(likeobj).removeClass('active');
            }
            $(em).text(data == 1 ? ++origin_num : --origin_num);
        },
    });
})
JS;
$this->registerJs($js);
?>

<?php

use yii\bootstrap\Html;
use yii\widgets\LinkPager

?>

<?php foreach($blogs as $blog) :?>
<div class="card">

  <!-- 头像  -->
  <div class="card-avatar hidden-xs">
    <?=Html::a(Html::img("/images/upload/".$blog->user->avatar),['user/show','id'=>$blog->user->id]);?>
  </div>
  <!-- /头像  -->

  <!--  内容 -->
  <div class="card-content">

    <!--  标题 -->
    <p class="card-title">
      <?=Html::a($blog->user->name,['user/show','id'=>$blog->user->id]);?>
      <?php if($blog->user->id == Yii::$app->user->id): ?>
      <?=Html::a(Html::icon('remove'), ['blog/delete','id'=>$blog->id],['class'=>'card-btn-delete']);?>
      <?php endif ?>
    </p>
    <!--  /标题 -->

    <!--  状态 -->
    <p class="card-status"><?=$blog->created_at?> <?=$blog->parent_id ? '转发' : '发布'?>了状态</p>
    <!--  /状态 -->
    

    <!-- 转发 -->
    <?php if($blog->parent_id): ?>

    <p class="card-text"><?=empty($blog->text) ? '转发了' : $blog->text() ?></p>

    <div class="repost">

    <!--  转发标题 -->
    <p class="card-title">
      <?php if($blog->parent): ?>
      <?=Html::a("@".$blog->origin->user->name, ['user/show','id'=>$blog->origin->user->id]);?>
      <?php else: ?>
      原微博已被删除
      <?php endif ?>
    </p>
    <!--  /转发标题 -->

    <p class="card-text"><?=$blog->origin->text()?></p>
  
    <!--  转发内容 -->
    <?php if($blog->origin->img): ?>
    <?=app\widgets\CardImageWidget::widget(['imgs'=>$blog->origin->img])?>
    <?php endif ?>
    <!--  /转发内容 -->

    <?=app\widgets\CardButtonWidget::widget(['blog'=>$blog->origin])?>

    </div>
    <!--  /转发 -->


    <?php else :?>
    <p class="card-text"><?=$blog->text()?></p>
    <?php if($blog->img): ?>
    <?=app\widgets\CardImageWidget::widget(['imgs'=>$blog->img])?>
    <?php endif ?>

    <?php endif ?>

     <?=app\widgets\CardButtonWidget::widget(['blog'=>$blog])?>
  </div>
  <!--  /内容  -->

</div>
<?php endforeach;?>

<?php if($pagination): ?>
<div class="page">
<?=LinkPager::widget(['pagination' => $pagination])?>
</div>
<?php endif ?>

<?php

$js = <<<JS
//删除按钮
$(".card").hover(function(){
    $(this).find(".card-btn-delete").toggle();
})
JS;

$css = <<<CSS
.page {
    float:right;
}
CSS;
$this->registerCss($css);
$this->registerJs($js);
?>


<div class="card-container">

<?php if (empty($blogs)): ?>
<div class="card-content">还没有发过状态</div>
<?php else: ?>
<?=app\widgets\BlogWidget::widget(compact('blogs','paginate'))?>
<?php endif ?>

 </div>

<div class="menu-container">
<?=app\widgets\MenuUserWidget::widget()?>
<?=app\widgets\MenuTopicWidget::widget()?>
<?=app\widgets\MenuRecommendWidget::widget()?>
</div>

<div class="card-container">
    <?=app\widgets\BlogWidget::widget(compact('blogs','pagination'))?>
</div>

<div class="menu-container hidden-xs">
    <?=app\widgets\MenuTopicWidget::widget()?>
    <?=app\widgets\MenuRecommendWidget::widget()?>
</div>


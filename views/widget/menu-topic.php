<div class="menu">
  <div class="menu-topic" data-page=1>

    <div class="menu-topic-title">
    <h5>话题列表
    <?=yii\bootstrap\Html::a(yii\bootstrap\Html::icon('refresh'),'javascript:void(0)',['class'=>'refresh'])?>
    </h5>
    </div>

    <div class="menu-topic-list">
     <?php foreach($topics as $topic) : ?>
    <p><a href="?r=topic/show&id=<?=$topic['id']?>">#<?=$topic['name']?>#</a></p>
    <?php endforeach ?>
    </div>

  </div>
</div>

<?php

$css = <<<CSS
.refresh {
    float:right
}
CSS;

$js = <<<JS
$(".refresh").click(function(){
    var page=$(".menu-topic").attr("data-page");
    ++page;
    $.ajax({
        url: "?r=topic/list",
        type: "POST",
        dataType: "json",
        data: {'page':page},
        success: function(data) {
            var topic = '';
            $(data.topics).each(function(i,k){
                topic += "<p><a href='?r=topic/show&id="+k['id']+"'>"+k['name']+"</a></p>"
            })
            $(".menu-topic-list").html(topic)
            $(".menu-topic").attr("data-page",data.page);
        },
        error: function() {
            alert(data);
        }
    });
})
JS;
$this->registerCss($css);
$this->registerJs($js);
?>

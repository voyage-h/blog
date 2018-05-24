//图片
var form;
$(".btn-form-img").click(function(){
    form = $(this).parents("form");
    $(form).find("#uploadform-imagefiles").click();
})
$(".upload-blog-input").change(function(){
    //var form = $(this).parents('form');
    $(form).attr('action','?r=upload/blog');
    $(form).attr('target','upload-iframe');
    $(form).submit();
})
//话题
$(".btn-form-topic").click(function(){
    $(this).parents("form").find("textarea").val("#话题内容# ").focus();
})
//回执
function preview(filenames) {
    var images = input = '';
    $($.parseJSON(filenames)).each(function(i,k){
        images += "<img class='preview-img' src='images/upload/"+k+"'>";
        input += "<input type='hidden' name='filenames[]' value='"+k+"'>";
    })

    $(form).find(".upload-images").html(images+input).css("clear","both");
    $(".upload-form").attr('target','');
    $(".upload-blog-form").attr('action','?r=blog/store');
}

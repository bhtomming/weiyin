$(function(){
    var friend_text = $("#form_friend");

    $(".icon-trash").click(function(){
        id = $(this).attr("data-id");
        del = confirm('你要删除该商品?');
        if(del === true){
            del_car(id);
            $(this).parent().remove();
        }
    });

    friend_text.keyup(function(){
        if($(this).val() ===1){
            $(this).val($(this).val().replace(/[^1-9]{11}/g,""));
        }else {
            $(this).val($(this).val().replace(/[\D]/g,""));
        }
    });

    $("#form_check_phone").click(function(){
        var phone = friend_text.val();
        var pattern =  /^1[34578]\d{9}$/;
        var friend = $("#friend-alert");
        if(!pattern.test(phone)){
            friend.html("<span class=\"text-danger\" >请输入正确的手机号码</span>");
            return false;
        }
        var route = "/app_dev.php/friend/quire/"+phone;
        $.ajax({
            url: route,
            dataType: 'json',
            success: function(data){
                var color = data.member ? "text-success" : "text-danger";
                friend.html("<span class=\""+color+"\" >"+data.msg+"</span>") ;
            },
            error: function(err){
                var msg = "系统出错请联系管理员.";
                friend.html("<span class=\"text-danger\" >"+msg+"</span>");
            }
        });
    });

    function del_car(id){
        route = "/app_dev.php/shopping_car/del/"+id;
        $.ajax({
            url: route,
            dataType: 'json'
        });
    }

});

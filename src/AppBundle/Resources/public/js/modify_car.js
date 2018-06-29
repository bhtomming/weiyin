$(function(){
    var friend_text = $("#friend_phone");

    $(".icon-trash").click(function(){
        id = $(this).attr("data-id");
        del = confirm('你要删除该商品?');
        if(del === true){
            del_car(id);
            $(this).parent().parent().remove();
        }
    });

    friend_text.keyup(function(){
        if($(this).val() ===1){
            $(this).val($(this).val().replace(/[^1-9]{11}/g,""));
        }else {
            $(this).val($(this).val().replace(/[\D]/g,""));
        }
    });

    $("#check_phone").click(function(){
        var phone = friend_text.val();
        var pattern =  /^1[34578]\d{9}$/;
        var friend = $("#friend-alert");
        if(!pattern.test(phone)){
            friend.html("<span class=\"text-danger\" >请输入正确的手机号码</span>");
            return false;
        }
        $.post("/app_dev.php/cart/friend/quire",{'phone' : phone},function(data,status){
                var color = data.member ? "text-success" : "text-danger";
                friend.html("<span class=\""+color+"\" >"+data.msg+"</span>") ;
                if(status !== "success"){
                    var msg = "系统出错请联系管理员.";
                    friend.html("<span class=\"text-danger\" >"+msg+"</span>");
                }
            });
    });

    function del_car(id){
        $.post('/app_dev.php/cart/delete',
            {'id':id},
            function(data,status){
            if("success" === status ){

            }
        });
    }

    //优惠券显示控制
    var coupon = $("#coupon");
    checkCoupon();
    function checkCoupon(){
        if($("#use_coupon").is(":checked")){
            coupon.show();
        }else{
            coupon.hide();
        }
    }
    $("#use_coupon").change(function(){
        checkCoupon();
    });

    $("#submit").click(function(){
        data = $("#cart_view").serializeObject();
        $.post("/app_dev.php/trade/create",data,function(data,status){
            if('success' === status){
                console.log(data.url);
            }
        });
    });

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
});

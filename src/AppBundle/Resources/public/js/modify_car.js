
$(function(){
    $.getScript("/bundles/app/js/comm.js");
    var friend_text = $("#friend_phone");

    $(".icon-trash").click(function(){
        id = $(this).attr("data-cart-id");
        pid = $(this).attr("data-id");
        del = confirm('你要删除该商品?');
        if(del === true){
            del_car(id);
            var amount = $("#item-"+pid+"-amount").text();
            var total = $("#total_amount");
	        var total_amount = total.text();
	        total_amount = parseFloat(total_amount) - parseFloat(amount);
	        total.text(total_amount);
            $(this).parent().parent().remove();
            $("#cart_id_"+id).remove();
            if(total_amount === 0){
	            location.reload();
            }
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
        $.post(getPath("/cart/friend/quire"),{'phone' : phone},function(data,status){
                var color = data.member ? "text-success" : "text-danger";
                friend.html("<span class=\""+color+"\" >"+data.msg+"</span>") ;
                if(status !== "success"){
                    var msg = "系统出错请联系管理员.";
                    friend.html("<span class=\"text-danger\" >"+msg+"</span>");
                }
            });
    });

    function del_car(id){
        $.post(getPath('/cart/delete'),
            {'id':id},
            function(data,status){
            if("success" === status ){
                $(".alert-error").addClass("alert-info").html(data.msg);
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
        $.post(getPath("/trade/create"),data,function(data,status){
            if(null !== data.url && 'success' === status){
               window.location.href = data.url;
            }
            if(data.msg !== null || 'undefined' !== data.msg){
	            $(".alert-error").addClass("alert-danger").html(data.msg);
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


$(function(){
    $.getScript("/bundles/app/js/comm.js");
    var number_text = $("input[name=number]");

    number_text.keyup(function(){
        if($(this).val() ===1){
            $(this).val($(this).val().replace(/[^1-9]/g,""));
        }else {
            $(this).val($(this).val().replace(/[\D]/g,""));
        }
    });
    number_text.change(function(){
        id = $(this).attr("data-id");
        max = $(this).attr("data-max");
        num = $(this).val();
        if(num >= max){
            num = max;
            $(this).val(max);
        }
        //改变当前金额
        if($("#item-"+id+"-amount").length > 0){
            setItemAmount(id,num);
        }
    });

    $("input[name=reduce]").click(function(){
        //获取当前条目id
        id = $(this).attr("data-id");
        //获取文本框内的值
        num_now = parseInt($("#num-"+id).val());
        //判断当前值是否为0；
        if(num_now <= 1){
            return;
        }
        //不为零时开始自减
        num_now--;
        //改变文本框的值
        setNumber("#num-"+id,num_now);
        //改变当前金额
        if($("#item-"+id+"-amount").length > 0){
            setItemAmount(id,num_now);
        }
    });

    $("input[name=add]").click(function(){
        id = $(this).attr("data-id");
        num_now = parseInt($("#num-"+id).val());
        max = $(this).attr("data-max");
        //num = num_now + 1;
        num_now++;
        if(num_now >= max ){
            num_now = max;
        }
        //改变文本框的值
        setNumber("#num-"+id,num_now);
        if($("#item-"+id+"-amount").length > 0){
            setItemAmount(id,num_now);
        }
    });

    function setNumber(id,num){ //设置文本框数值
        $(id).val(num);
    }

    function setItemAmount(id,num){ //单个商品金额,并且算出总数，发数据
        price = parseFloat($("#item-"+id+"-price").text()).toFixed(2);
        itemAmount = num * price;
        $("#item-"+id+"-amount").text(itemAmount);
        if($("#total_amount").length > 0){
            changeTotalAmount();
        }
        send(id,num);
    }

    function changeTotalAmount(){ //改变总金额函数
        var totalAmount = 0;
        $(".amount").each(function(){
            if("undefined" !== $(this).text()){
                totalAmount = (parseFloat(totalAmount) + parseFloat($(this).text())).toFixed(2);
            }
        });
        $("#total_amount").text(totalAmount);
    }

    function send(id,num){
        $.post(getPath("/cart/add"),{
            'id':id,
            'num':num
        },function(data,status){
            if(status === "success"){}
            if("success" !== status){
                $(".alert-error").html("网络有问题，请稍后再试");
            }
        });
    }
});

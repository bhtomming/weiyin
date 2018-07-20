$(function(){
    $.getScript("/bundles/app/js/comm.js");
    $("#add-car").click(function(){//添加到购物车
        var id = $(this).attr('data-id');
        var num = $("input[name=number]").val();
        $.post(getPath('/cart/add'),{
            'id':id,
            'num':num
        },function(data,status){
            if("success" === status ){
                $("#alert").html("添加商品成功!<a href='"+getPath("/cart/show")+"'>现在查看购物车</a>").addClass('alert alert-success');
            }
        });
    });
});

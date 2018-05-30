$(function(){
    $("#add-car").click(function(){
        var id = $(this).attr('data-id');
        var num = $("#number_number").val();
        var route = "/app_dev.php/shopping_car/add/"+id+"/"+num;
        $.ajax({
            url: route,
            type:'GET',
            dataType: 'json',
            success: function(data,status){
                if("success" == status ){
                    $("#alert").html("添加商品成功!<a href=\"/shopping_car/view/\">现在查看购物车</a>").addClass('alert alert-success');
                }
            }
        });
    });

});

$(function(){
    $("#add-car").click(function(){
        var id = $(this).attr('data-id');
        var num = $("#form_num").val();
        var route = "/app_dev.php/shopping_car/add/"+id+"/"+num;
        $.ajax({
            url: route,
            dataType: 'json'
        });
    });

});

$(function(){
    var id = num = 0;
    var route = '';
    var good_amount;
    var price;
    var total_amount;

    $(".reduce").click(function(){
        id = $(this).attr("data-id");
        num = parseInt($(".num-"+id).val()) - 1;
        send();
    });

    $(".add").click(function(){
        id = $(this).attr("data-id");
        num = parseInt($(".num-"+id).val()) + 1;
        send();
    });


    function send(){
        $(".num-"+id).val(num);
        var html_sum = $(".item-"+id+"-sum");
        price = parseFloat($("#item-"+id+"-price").text());
        total_amount = parseFloat($("#total_amount").text()).toFixed(2);
        total_amount = total_amount - parseFloat(html_sum.text()).toFixed(2);
        sum =  (num * price).toFixed(2);
        html_sum.text(sum);
        total_amount = parseFloat(sum + total_amount).toFixed(2);
        $("#total_amount").text(total_amount);
        route = "/app_dev.php/shopping_car/add/"+id+"/"+num;
        $.ajax({
            url: route,
            dataType: 'json'
        });
    }

});

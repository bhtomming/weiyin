$(function(){
    var id = num = 0;
    var route = '';
    var good_amount;
    var price;
    var total_amount;
    var number_text = $(".number");

    $(".reduce").click(function(){
        id = $(this).attr("data-id");
        num_now = $(".num-"+id).val();
        if(num_now <= 1){
            return;
        }
        num = parseInt(num_now) - 1;
        send();
    });

    $(".add").click(function(){
        id = $(this).attr("data-id");
        num = parseInt($(".num-"+id).val()) + 1;
        send();
    });

    number_text.change(function(){
        id = $(this).attr("data-id");
        num = $(this).val();
        send();
    });
    number_text.keyup(function(){
        if($(this).val() ===1){
            $(this).val($(this).val().replace(/[^1-9]/g,""));
        }else {
            $(this).val($(this).val().replace(/[\D]/g,""));
        }
    });


    function send(){
        $(".num-"+id).val(num);
        var html_sum = $(".item-"+id+"-sum");
        price = parseFloat($("#item-"+id+"-price").text());
        total_amount = parseFloat($("#total_amount").text()).toFixed(2);
        total_amount = (parseFloat(total_amount) - parseFloat(html_sum.text())).toFixed(2);
        sum =  (num * price).toFixed(2);
        html_sum.text(sum);
        total_amount = (parseFloat(total_amount) + parseFloat(sum)).toFixed(2);
        $("#total_amount").text(total_amount);

        route = "/app_dev.php/shopping_car/add/"+id+"/"+num;
        $.ajax({
            url: route,
            dataType: 'json'
        });
    }

});

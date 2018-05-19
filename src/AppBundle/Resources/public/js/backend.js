$(function(){
        entity = getUrlParam('entity').toLowerCase();

    var action = '';
    var method = '';
    $('#'+entity+'_address_city').change(function() {
        var data = {};
        var $form = $(this).closest('form');
        action = $form.attr('action');
        method = $form.attr('method');
        data[$(this).attr('name')] = $(this).val();
        // Submit data via AJAX to the form's action path.
        send(data,function(html) {
            $('#'+entity+'_address_area').html(
                $(html).find('#'+entity+'_address_area').html()
            );
        });
    });

    $('#'+entity+'_address_province').change(function() {
        var data = {};
        var $form = $(this).closest('form');
        action = $form.attr('action');
        method = $form.attr('method');
        data[$(this).attr('name')] = $(this).val();
        send(data,function(html) {
            city = $('#'+entity+'_address_city');
            city.html(
                $(html).find('#'+entity+'_address_city').html()
            );
        });
    });

    $('#address_area').change(function() {
        var data = {};
        data[$(this).attr('name')] = $(this).val();
        // Submit data via AJAX to the form's action path.
        send(data,function(html) {
            console.log('发送成功');
        });
    });

    function send(data,success_call){
        $.ajax({
            url : action,
            type: method,
            data : data,
            success: success_call
        });
    }
});
function getUrlParam(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
}
$(function(){
        entity = getUrlParam('entity').toLowerCase();

    /*var action = '';
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
    }*/
    var citydata =[];
    citydata['code'] = [];
    citydata['name'] = [];
    var city_option = $("#"+entity+"_address_city option");
    var city_select = $("#"+entity+"_address_city");
    var area_select = $("#"+entity+"_address_area");
    //var city_data = new Array();
    city_option.each(function(){
        citydata['code'].push($(this).val());
        citydata['name'].push($(this).text());
    });
    var area_option = $("#"+entity+"_address_area option");
    var areadata = [];
    areadata['code'] = [];
    areadata['name'] = [];
    area_option.each(function(){
        areadata['code'].push($(this).val());
        areadata['name'].push($(this).text());
    });
    city_select.change(function() {
        var code = $(this).val();
        var cparea = [];
        cparea['code'] = [];
        cparea['name'] = [];

        for(var i=0; i<areadata['code'].length; i++){
            var areazz = new RegExp(code.substring(0,4)+'[0-9]{2}');
            if(areazz.test(areadata['code'][i])){
                cparea['code'].push(areadata['code'][i]);
                cparea['name'].push(areadata['name'][i]);
            }
        }
        changeAreaData(cparea);
    });

    $("#"+entity+"_address_province").change(function() {
        var code = $(this).val();
        var cpcity = [];
        cpcity['code'] = [];
        cpcity['name'] = [];
        if(isGov(code)){
            for(var j=0; j<areadata['code'].length; j++){
                var areazz = new RegExp(code.substring(0,3)+'[0-9]{2}');
                if(areazz.test(areadata['code'][j])){
                    cpcity['code'].push(areadata['code'][j]);
                    cpcity['name'].push(areadata['name'][j]);
                }
            }
            changeAreaData(cpcity);
            cpcity['code'] = [];
            cpcity['name'] = [];
            changeCityData(cpcity);
        }else{
            for(var i=0; i<citydata['code'].length; i++){
                var cityzz = new RegExp(code.substring(0,2)+'[0-9]{4}');
                if(cityzz.test(citydata['code'][i])){
                    cpcity['code'].push(citydata['code'][i]);
                    cpcity['name'].push(citydata['name'][i]);
                }
            }

            changeCityData(cpcity);
        }


    });

    function changeCityData(city_data){
        console.log(city_select.html());
        city_select.append("<option value>请选择城市</option>");
        for(var i = 0; i<city_data['code'].length; i++){
            city_select.append("<option value="+city_data['code'][i]+">"+city_data['name'][i]+"</option>");
        }
    }
    function changeAreaData(area_data){
        area_select.html('');
        area_select.append("<option value>请选择区域</option>");
        for(var i = 0; i<area_data['code'].length; i++){
            area_select.append("<option value="+area_data['code'][i]+">"+area_data['name'][i]+"</option>");
        }
    }
    function isGov(code){
        if('110000' === code || '310000' === code || '500000' === code || '120000' === code){
            return true;
        }
        return false;
    }
});
function getUrlParam(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
}
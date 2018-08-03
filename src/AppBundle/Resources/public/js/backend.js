$(function(){
        entity = getUrlParam('entity').toLowerCase();
    
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
        changeNextFields(area_select,new RegExp('^'+code.substring(0,4)+'[0-9]{2}'),areadata,"<option value>请选择区域</option>");
    });

    $("#"+entity+"_address_province").change(function() {
        var code = $(this).val();
        if(isGov(code)){
            city_select.html("<option value>请选择城市</option>");
            changeNextFields(area_select,new RegExp('^'+code.substring(0,2)+'[0-9]{4}'),areadata,"<option value>请选择区域</option>");

        }else{
            changeNextFields(city_select,new RegExp('^'+code.substring(0,2)+'[0-9]{4}'),citydata,"<option value>请选择城市</option>");
        }

    });

    function isGov(code){
        if('110000' === code || '310000' === code || '500000' === code || '120000' === code){
            return true;
        }
        return false;
    }

    function changeNextFields(obj2,reg_match,data,options){
        obj2.html(options);
        $.each(data['code'],function(index,value){
            if(reg_match.test(value)){
                obj2.append("<option value="+value+">"+data['name'][index]+"</option>");
            }
        });
    }
});
function getUrlParam(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
}
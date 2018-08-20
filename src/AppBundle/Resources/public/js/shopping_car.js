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
                inhtml = "<a href='"+getPath("/cart/show")+"'>现在查看购物车</a>";
                if(401 === data.status){
	                inhtml = "您未登录,请先<a href='"+getPath("/member")+"'>登录</a>再添加商品";
                }else if("unmatch" === data.status){
                    inhtml = "请输入正确的数据";
                }else if("unfind" === data.status){
                    inhtml = "找不到你要的商品";
                }else{
	                inhtml = data.msg + "<a href='"+getPath("/cart/show")+"'>现在查看购物车</a>";
                }
	            $("#alert").html(inhtml).addClass('alert alert-success');
            }
        });
    });
    $("#shop").click(function(){
	    var id = $(this).attr('data-id');
	    var num = $("input[name=number]").val();
	    $.post(getPath('/cart/add'),{
		    'id':id,
		    'num':num
	    },function(data,status) {
		    if ("success" === status) {
			    if (401 === data.status) {
				    inhtml = "您未登录,请先<a href='" + getPath("/member") + "'>登录</a>再添加商品";
			    } else if ("unmatch" === data.status) {
				    inhtml = "请输入正确的数据";
			    } else if ("unfind" === data.status) {
				    inhtml = "找不到你要的商品";
			    } else {
				    window.location.href = getPath("/cart/show");
			    }
			    $("#alert").html(inhtml).addClass('alert alert-success');
		    }
	    });
    });
});

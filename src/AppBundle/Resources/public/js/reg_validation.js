$(function(){
	$.getScript("/bundles/app/js/comm.js");
	$("#fos_user_registration_form_username").change(function(){
		var name = $(this).val();
		var isValid = validation(this,/^[\u4E00-\u9FA5]{2,10}$/,"用户名由2-10个中文组成");
		if(isValid && isUsed('name',name)){
			$(this).parent().append("<div class='text-danger'>该手用户名已经有人使用!</div>");
		}
	});
    $("#fos_user_registration_form_phone").change(function(){
        var phone = $(this).val();
        var isValid = validation(this,/^((0\d{2,3}-\d{7,8})|(1[34578]\d{9}))$/,"请输入正确的手机号码");
	    if(isValid && isUsed('phone',phone)){
            $(this).parent().append("<div class='text-danger'>该手机号已经有人使用！</div>");
	    }
    });
    $("#fos_user_registration_form_plainPassword_first").change(function(){
        validation(this,/^[a-zA-Z0-9_]{6,20}$/,"请输入正确的密码,密码由6-20位数字及字母组成");
    });
    $("#fos_user_registration_form_plainPassword_second").change(function(){
        validation(this,/^[a-zA-Z0-9_]{6,20}$/,"请输入正确的密码,密码由6-20位数字及字母组成");
        if($(this).val() !== $("#fos_user_registration_form_plainPassword_first").val()){
            var pare = $(this).parent();
            if($(pare.has('div')).length === 0){
                $(this).parent().append("<div class='text-danger'>两次输入密码不一致</div>");
            }else{
                $(this).parent().children('div').html("<div class='text-danger'>两次输入密码不一致</div>");
            }

        }
    });

    function validation(ob,reg,msg){
        var data = $(ob).val();
        var pare = $(ob).parent();
        if(!reg.test(data)){
            if($(pare.has('div')).length === 0){
                $(ob).parent().append("<div class='text-danger'>"+msg+"</div>");
            }
            $("#submit").attr("disabled", true).addClass("disabled");
            return false;
        }else{
            if($(pare.has('div')).length > 0){
                $(pare.children('div').remove());
            }
            $("#submit").removeAttr("disabled").removeClass("disabled");
            return true;
        }
    }

    $("#member_phone").change(function(){
        isvali = validation(this,/^((0\d{2,3}-\d{7,8})|(1[34578]\d{9}))$/,"请输入正确的手机号码");
	    var phone = $(this).val();
	    if(isvali && isPhoneUse(phone)){
		    $(this).parent().children(".text-danger").html("<div class='text-danger'>该手机号已经有人使用！</div>").addClass("col-md-10 offset-md-2");
	    }
    });

    $("#member_email").change(function(){
        validation(this,/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/,"请输入正确的邮箱");
        $(this).parent().children(".text-danger").addClass("col-md-10 offset-md-2")
    });

	function isUsed(feild,value){
		var used = false;
		$.ajaxSettings.async = false;
		data = { };
		data[feild] = value;
		$.post(getPath("/user/query"),data,function(data,status)  {
			if(status !== "success" || "undefined" === data.used){
				used = false;
			}
			used = data.used;
		});
		return used;
	}
});

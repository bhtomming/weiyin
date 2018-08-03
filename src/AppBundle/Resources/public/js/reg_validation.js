$(function(){
    $("#fos_user_registration_form_phone").change(function(){
        validation(this,/^((0\d{2,3}-\d{7,8})|(1[34578]\d{9}))$/,"请输入正确的手机号码");
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
        }else{
            if($(pare.has('div')).length > 0){
                $(pare.children('div').remove());
            }
            $("#submit").removeAttr("disabled").removeClass("disabled");
        }
    }

    $("#member_phone").change(function(){
        validation(this,/^((0\d{2,3}-\d{7,8})|(1[34578]\d{9}))$/,"请输入正确的手机号码");
        $(this).parent().children(".text-danger").addClass("col-md-10 offset-md-2")
    });
    $("#member_email").change(function(){
        validation(this,/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/,"请输入正确的邮箱");
        $(this).parent().children(".text-danger").addClass("col-md-10 offset-md-2")
    });

});

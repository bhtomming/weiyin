$(document).ready(function(){
    var card = $(".card");
    var fileUri = '';
    var fileName = '';
    var delUrl = "";
    var modUrl = "";
    var funNum = getQueryString('CKEditorFuncNum');
    function getQueryString(name){
        var reg = new RegExp("(^|&)"+name+"=([^&]*)(&|$)","i");
        var result = window.location.search.substr(0).match(reg);
        if(result !== null){
            return result[2];
        }else{
            return null;
        }
    }
    card.click(function(){
        fileUri = $(this).children("img").attr('src');
        fileName = $(this).children("img").attr('title');
        card.removeClass('border-primary');
        $(this).addClass('border-primary');
    });
    card.dblclick(function(){
        fileUri = $(this).children("img").attr('src');
        sure();
    });
    card.hover(function(){
        $(this).addClass('border-primary');
    });
    card.mouseleave(function(){
        if(fileUri === $(this).children("img").attr('src')){
            return;
        }
        $(this).removeClass('border-primary');
    });
    $("#del").click(function(){
        if(undefined === fileUri || '' === fileUri){
            alert("请选择图片");
            return false;
        }
        delUrl = $(this).attr('data-action');
        $.ajax({
            type: 'delete',
            dataType: 'json',
            url: delUrl,
            data: {
                fileName: fileUri
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // 状态码
                //console.log(XMLHttpRequest.status);
                // 状态
                //console.log(XMLHttpRequest.readyState);
                // 错误信息
                //console.log(textStatus);
                alert('删除发生错误，请联系管理员!');
            },
            success: function(data){
                success('删除',data);
            }
        } );
    });
    $("#modify").click(function(){
        if(undefined === fileName || '' === fileName){
            alert('没选择图片，请选择你要修改的图片!');
            return false;
        }
        modUrl = $(this).attr('data-action');
    });

    $("#modifyModal").on('show.bs.modal',function(){
        $("#name-input").val(fileName);
    });

    $(".modal-footer>.btn-primary").click(function(){
        newName = $("#name-input").val();
        saveModify(newName);
        $("#modifyModal").modal('hide');
    });
    $("#sure").click(function(){
        sure();
    });
    function sure(){
        window.opener.CKEDITOR.tools.callFunction( funNum, fileUri );
        window.close();
    }
    function err(e){
        alert('发生错误'+e);
    }
    function success(op,data){
        if(data.status !== 200){
            alert('服务器无法完成'+op+'操作!');
        }else{
            alert(op+'成功!');
            window.location = location.href;
        }
    }
    function saveModify(newFileName){
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: modUrl,
            data: {
                filePath: fileUri,
                fileName: newFileName
            },
            error: function(data){
                err(data);
            },
            success: function(data){
                success('修改',data);
            }
        } );
    }
});




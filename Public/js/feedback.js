/**
 * Created by zhangke on 2015/9/28 0028.
 */
var login = false;
var loginid = 0;
$(function(){
    getUserInfo();             //获取登录信息
    addFeedback();             //添加反馈
})
//获取登录信息
function getUserInfo(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/User/getSession",
        dataType:"json",
        success: function (data) {
            if(data != false){
                login = true;
                loginid = data;
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//添加反馈($content,$contact)
function addFeedback(){
    $("#feedback").click(function(){
        var content = $("#content").val();
        var contact = $("#contact").val();
        if(contact.length > 0 && content.length > 0){
            $.ajax({
                type:"GET",
                url:"index.php?s=Home/Feed/addFeed",
                dataType:"json",
                data:{
                    content:content,
                    contact:contact
                },
                success: function (data) {
                    if(data != false){
                        location.href = "index.php?s=Home/Index/myFeedback";
                    }
                },
                error:function (){
                    //alert('服务器错误！');
                }
            });
        }
    })
}
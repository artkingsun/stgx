/**
 * Created by zhangke on 2015/8/30 0030.
 */
$(document).ready(function(){
    isLogin();                    //判断是否登录
    getFooterInfo();              //获得底部信息
    exit();                       //退出登录
})

//获得底部信息
function getFooterInfo(){
    var addContent = '<p>Copyright © shutonggaoxiao 2015, All Rights Reserved</p><p>书童高校版权所有</p>';
    $("#footer").html(addContent);
}
//退出登录
function exit(){
    $("#exit").click(function(){
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/User/userExit",
            dataType:"json",
            success: function (data) {
                if(data == true){
                    isLogin();
                }else{
                    alert("退出失败！");
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    });
}
//判断是否登录
function isLogin(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/User/getUserInfo",
        dataType:"json",
        success: function (data) {
            if(data != false){
                var name = data.username;
                var nameContent = name + '  <span class="caret"></span>';
                $("#nav-name").html(nameContent);
                $("#nav-user").css("display","block");
            }else{
                $("#nav-login").css("display","block");
                $("#nav-user").css("display","none");
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}


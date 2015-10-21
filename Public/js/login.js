/**
 * Created by zhangke on 2015/9/18 0018.
 */
$(document).ready(function(){
    login();                      //注册
});
//注册
function login(){
    $("#login").click(function(){
        var email = $("#email").val();
        var pwd = $("#pwd").val();
        if(email != '' && pwd != ''){
            var reg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
            if(reg.test(email)){
                $.ajax({
                    type:"POST",
                    url:"index.php?s=Home/User/userLogin",
                    dataType:"json",
                    data:{
                        email:email,
                        password:pwd,
                        logintype:true
                    },
                    success: function (data) {
                        if(data == true){
                            location.href = "index.php?s=Home/Index/index";
                        }else{
                            alert("登录失败！");
                        }
                    },
                    error:function (){
                        //alert('服务器错误！');
                    }
                });
            }else{
                alert("登录失败！");
            }
        }else{
            alert("登录失败！");
        }
    })
}

//判断邮箱是否注册
function isRegister(){
    var email = $("#emil").val();
    $.ajax({
        type:"POST",
        url:"index.php?s=Home/User/isRegister",
        dataType:"json",
        data:{
            email:email
        },
        success: function (data) {
            if(data == false){
                alert('邮箱未注册!');
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
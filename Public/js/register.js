/**
 * Created by zhangke on 2015/9/18 0018.
 */
$(document).ready(function(){
    register();
});
//注册
function register(){
    $("#register").click(function(){
        var email = $("#email").val();
        var name = $("#userName").val();
        var pwd = $("#pwd").val();
        var password = $("#password").val();
        if(email != '' && name != '' && pwd != '' && password != '' && pwd == password){
            var reg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
            if(reg.test(email)){
                $.ajax({
                    type:"POST",
                    url:"index.php?s=Home/User/userRegister",
                    dataType:"json",
                    data:{
                        email:email,
                        userName:name,
                        password:password,
                        pwd:pwd
                    },
                    success: function (data) {
                        if(data == true){
                            location.href = "index.php?s=Home/Index/login";
                        }else{
                            alert("注册失败！");
                        }
                    },
                    error:function (){
                        //alert('服务器错误！');
                    }
                });
            }else{
                alert("注册失败！");
            }
        }else{
            alert("注册失败！");
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
            if(data == true){
                alert('邮箱已经注册！');
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
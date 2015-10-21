/**
 * Created by zhangke on 2015/9/28 0028.
 */
var login = false;
var loginid = 0;
$(document).ready(function(){
    getUserInfo();                          //获得用户登录信息
    addPromotion();                         //添加优惠活动
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
//添加优惠活动
function addPromotion(){
    $("#addPromotion").click(function(){
        var title = $("#title").val();
        var content = $("#content").val();
        var place = $("#place").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var type = $("#type").val();
        if(title.length > 0 && content.length > 0 && place.length > 0 && start.length > 0 && end.length > 0){
            alert(end);
            $.ajax({
                type:"GET",
                url:"index.php?s=Home/Promotion/addPromotion",
                dataType:"json",
                data:{
                    title:title,
                    content:content,
                    place:place,
                    start:start,
                    end:end,
                    type:type
                },
                success: function (data) {
                    if(data != false){
                        location.href = "index.php?s=Home/Index/promotion";
                    }
                },
                error:function (){
                    //alert('服务器错误！');
                }
            });
        }
    })
}

/**
 * Created by zhangke on 2015/9/29 0029.
 */
var login = false;
var loginid = 0;
var pic = "";
//页面打开就加载
$(function(){
    getUserInfo();        //获取登录信息
    uploadPic();          //图片上传
    addFound();           //添加失物
});
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
//图片上传
function uploadPic(){
    $('#addPic').click(function(){
        $("#uploadPic").ajaxSubmit({
            url:"index.php?s=Home/File/upload",
            success:function(data){
                if(data) {
                    pic = "Uploads/"+data;
                    var html = ' </br> <img class="img-responsive" src="' + pic + '" />';
                    $('#showPic').html(html);
                }
            }
        })
        return false;
    });
}
//添加失物
function addFound() {
    $('#addFound').click(function(){
        var title = $("#title").val();
        var content = $("#content").val();
        var place = $("#place").val();
        var foundTime = $("#foundTime").val();
        var contact = $("#contact").val();
        var foundPic = pic;
        //alert(title + content + place + foundTime + contact + foundPic);
        if(title.length > 0 && content.length > 0 && place.length > 0
        && foundTime.length > 0 && contact.length > 0 && foundPic.length > 0){
            $.ajax({// addFound($title,$content,$place,$foundtime,$contact,$picurl)
                type:"GET",
                url:"index.php?s=Home/Found/addFound",
                dataType:"json",
                data:{
                    title:title,
                    content:content,
                    place:place,
                    foundtime:foundTime,
                    contact:contact,
                    picurl:foundPic
                },
                success: function (data) {
                    if(data == true) {
                        location.href = "index.php?s=Home/Index/found";
                    }
                },
                error:function (){
                    alert('服务器出问题了！');
                }
            });
        }
    });

}
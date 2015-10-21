/**
 * Created by zhangke on 2015/9/21 0021.
 */
$(function(){
    getUserInfo();                          //获得用户登录信息
    addExam();                              //添加考试资料
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
//添加考试资料
function addExam(){
    $("#publish").click(function(){
        var title = $("#title").val();
        var url = $("#url").val();
        var content = $("#content").val();
        var subject = $("#subject").val();
        var year = $("#year").val();
        var prof = $("#prof").val();
        if(title.length > 0 && url.length > 0 && content.length > 0){
            $.ajax({
                type:"POST",
                url:"index.php?s=Home/Exam/addExam",
                dataType:"json",
                data:{
                    title:title,
                    content:content,
                    year:year,
                    prof:prof,
                    subject:subject,
                    url:url
                },
                success:function(data){
                    if(data == true){
                        alert("发布成功！");
                        location.href = "index.php?s=Home/Index/exam";
                    }else{
                        alert("发布失败！");
                    }
                },
                error:function (){
                    //alert('服务器错误！');
                }
            })
        }
    });

}
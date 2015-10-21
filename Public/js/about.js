/**
 * Created by zhangke on 2015/9/28 0028.
 */

var type = "所有信息";
var login = false;
var loginid = 0;
$(function(){
    getUserInfo();            //获得登录信息
    getAboutList(type);       //获取关于列表
    //chooseAboutType();        //选择关于类别
    addAbout();               //发布关于
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
                var content = '<button class="btn btn-lg btn-block btn-violet"  data-toggle="modal" data-target="#publishAbout">发布信息</button>'
                    + '<br><ul class="nav-list" id="aboutType">'
                    + '<li ><a href="#" class="active">所有信息</a></li>'
                    + '<li ><a href="#">关于我们</a></li>'
                +'<li ><a href="#">技术标准</a></li> <li ><a href="#">功能实现</a></li> </ul>';
            }else{
                var content = '<ul class="nav-list" id="aboutType">'
                    + '<li ><a href="#" class="active">所有信息</a></li>'
                    + '<li ><a href="#">关于我们</a></li>'
                    +'<li ><a href="#">技术标准</a></li> <li ><a href="#">功能实现</a></li> </ul>';
            }
            $("#about-nav").html(content);
            chooseAboutType();
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//选择关于类别
function chooseAboutType(){
    $('#aboutType a').click(function(){
        $(this).parent().each(function () {//移除其余非点中状态
            $('#aboutType a').removeClass("active");
        });
        $(this).addClass("active");//给所点中的增加样式
        type = $(this).text();
        getAboutList(type);
    })
}
//获得关于列表
function getAboutList(type){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/About/readAboutListByType",
        dataType:"json",
        data:{
            type:type
        },
        success: function (data) {
            if(data != false){
                var content = '';
                var j = data.length;
                for(var i = 0;i < j;i++ ){
                    content += '<div class="panel"><div class="panel-head"><span class="id-none">'
                    + data[i].aboutid + '</span>';
                    if(loginid == data[i].userid){
                        content += '<button type="button" class="close delAbout" data-dismiss="modal" aria-label="Close">';
                    }else{
                        content += '<button type="button" class="close delAbout id-none" data-dismiss="modal" aria-label="Close">';
                    }
                    content += '<span aria-hidden="true">&times;</span></button><p class="text-white">'
                    + data[i].abouttitle + '</p></div><div class="panel-content"><p>'
                    + data[i].aboutcontent + '</p></div></div>';
                }
                $("#aboutList").html(content);
                delAbout();
            }else{
                $("#content").html("这家伙真懒，什么都没留下！");
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//添加关于
function addAbout(){
    $("#addAbout").click(function(){
        var title = $("#title").val();
        var content = $("#content").val();
        var type = $("#type").val();
        if(title.length > 0 && content.length > 0){
            $.ajax({
                type:"GET",
                url:"index.php?s=Home/About/addAbout",
                dataType:"json",
                data:{
                    title:title,
                    content:content,
                    type:type
                },
                success: function (data) {
                    if(data != false){
                        alert("发布成功!");
                        getAboutList(type);
                    }
                },
                error:function (){
                    //alert('服务器错误！');
                }
            });
        }
    })
}
//删除关于
function delAbout(){
    $(".delAbout").click(function(){
        var aboutid = $(this).prev().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/About/delAbout",
            dataType:"json",
            data:{
                aboutid:aboutid
            },
            success: function (data) {
                if(data != false){
                    getAboutList(type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    })
}
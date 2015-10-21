/**
 * Created by zhangke on 2015/9/28 0028.
 */
var login = false;
var loginid = 0;
$(function(){
    getUserInfo();             //获取登录信息
    getFeedList();             //读取反馈信息列表
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
//获得反馈信息列表
function getFeedList(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Feed/readFeedList",
        dataType:"json",
        success:function(data){
            if(data){
                var feedContent = '';
                var j = data.length;
                for(var i = 0; i < j; i++){
                    feedContent += '<div class="panel"><div class="panel-head"><span class="id-none">'
                    + data[i].feedid + '</span>'
                    + '<button type="button" class="close delFeed" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    + '<p class="text-white">'
                    + data[i].feedtime + '</p></div><div class="panel-content"><p>'
                    + data[i].feedcontent + '</p></div></div>';
                }
                $("#feedList").html(feedContent);
                delFeed();
            }else{
                var feedContent = '';
                feedContent += '<div class="panel"><div class="panel-head"><span class="id-none">'
                + '<button type="button" class="close delFeed" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                + '<p class="text-white">别在那BB，有什么不满赶紧去反馈！</p></div><div class="panel-content"><p>'
                + '别在那BB，有什么不满赶紧去反馈</p></div></div>';
                feedContent += '<div class="panel"><div class="panel-head"><span class="id-none">'
                + '<button type="button" class="close delFeed" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                + '<p class="text-white">别在那BB，有什么不满赶紧去反馈</p></div><div class="panel-content"><p>'
                + '你要是不反馈，那群程序猿、设计狮、产品汪、职能喵怎么知道你内心深处的真实想法！</p></div></div>';
                $("#feedList").html(feedContent);
            }
        }
    })
}
//删除反馈信息
function delFeed(){
    $(".delFeed").click(function(){
        var feedid = $(this).prev().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Feed/delFeed",
            dataType:"json",
            data:{
                feedid:feedid
            },
            success:function(data){
                if(data != false){
                    getFeedList();
                }
            }
        })
    })
}
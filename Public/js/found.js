/**
 * Created by zhangke on 2015/9/29 0029.
 */
var page = 1;
var row = 10;
var type = 1;
var lastPage = 0;
var login = false;
var loginid = 0;
$(document).ready(function(){
    getUserInfo();                           //获得用户登录信息
    getFoundList(page,row,type);             //读取失物
    searchFound();                           //搜索失物
    chooseFoundType();                       //选择失物分类
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
//读取失物
function getFoundList(page,row,type){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Found/readFoundListByPage",
        dataType:"json",
        data:{
            page:page,
            row:row,
            type:type
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                foundPage(page,lastPage);
                var content = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    content += '<div class="panel"> <div class="panel-head"> <div class="box-left"> <a href="#"> <img src="'
                    + data[i].userpic + '"/> </a> <span class="id-none">'
                    + data[i].userid + '</span> </div> <div class="box-left"> <a href="#">'
                    + data[i].username + '</a> <p><strong class="text-white">'
                    + data[i].foundtitle + '</strong></p> <p>发布时间：'
                    + data[i].foundpublish + '</p> </div> </div> <div class="panel-content"> <div class="panel-content-left"> <img src="'
                    + data[i].foundpic + '"/> </div> <div class="panel-content-right"> <p>'
                    + data[i].foundcontent + '</p> <strong class="text-yellow">发现地点：'
                    + data[i].foundplace + '</strong><br> <strong class="text-yellow">发现时间：'
                    + data[i].foundtime + '</strong><br> <strong class="text-yellow">联系方式：'
                    + data[i].foundcontact + '</strong> </div> </div> <div class="panel-footer">'
                    + '<a href="#" class="btn btn-default btn-lg changeStatus">';
                    if(data[i].foundget == 1){
                        var status = "已领取";
                    }else{
                        var status = "未领取";
                    }
                    content += status + '</a> <span class="id-none">'
                    + data[i].foundid + '</span> ';
                    if(data[i].userid == loginid){
                        content += '<button class="btn btn-danger btn-lg delFound">删除</button></div> </div>';
                    }else{
                        content += '</div> </div>';
                    }
                }
                $("#foundList").html(content);
                delFound();
                changeStatus();
            }else{
                $("#foundList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    getFoundList(page,row,type);
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    getFoundList(page,row,type);
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//选择失物类别
function chooseFoundType(){
    $('#foundType a').click(function(){
        $(this).parent().each(function () {//移除其余非点中状态
            $('#foundType a').removeClass("active");
        });
        $(this).addClass("active");//给所点中的增加样式
        type = $(this).text();
        //$type 1 默认 2 未领取 3 已领取
        switch (type){
            case "默认排序":
                type = 1;
                break;
            case "未领取":
                type = 2;
                break;
            case "已领取":
                type = 3;
                break;
        }
        getFoundList(page,row,type);
    })
}
//翻页按钮显示
function foundPage(page,lastPage){
    if(lastPage < 2){
        $("#lastPage").css("display","none");
        $("#nextPage").css("display","none");
    }else{
        if(page == lastPage){
            $("#lastPage").css("display","block");
            $("#nextPage").css("display","none");
        }else if(page == 1){
            $("#lastPage").css("display","none");
            $("#nextPage").css("display","block");
        }else{
            $("#lastPage").css("display","");
            $("#nextPage").css("display","");
        }
    }
}
//删除失物
function delFound(){
    $(".delFound").click(function(){
        var foundid = $(this).prev().html();
        //alert(foundid);
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Found/delFound",
            dataType:"json",
            data:{
                foundid:foundid
            },
            success: function (data) {
                if(data != false){
                    getFoundList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    })
}
//更改失物是否领取
function changeStatus(){
    $(".changeStatus").click(function(){
        var foundget = $(this).html();
        var foundid = $(this).next().html();
        if(foundget == "未领取"){
            foundget = 0;
        }
        if(foundget == "已领取"){
            foundget = 1;
        }
        //alert(foundget + foundid);
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Found/changeFoundGetStatus",
            dataType:"json",
            data:{
                foundid:foundid,
                foundget:foundget
            },
            success: function (data) {
                if(data != false){
                    getFoundList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    })
}
//搜索考试资料 ($page,$row,$year,$prof,$subject,$keyword)
function searchFound(){
    $("#searchFound").click(function(){
        var keyword = $("#keyword").val();
        if(keyword.length > 0){
            searchFoundList(page,row,keyword);
        }
    })

}
//搜索考试资料列表
function searchFoundList(page,row,keyword){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Found/sesrchFound",
        dataType:"json",
        data:{
            page:page,
            row:row,
            keyword:keyword
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                foundPage(page,lastPage);
                var content = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    content += '<div class="panel"> <div class="panel-head"> <div class="box-left"> <a href="#"> <img src="'
                    + data[i].userpic + '"/> </a> <span class="id-none">'
                    + data[i].userid + '</span> </div> <div class="box-left"> <a href="#">'
                    + data[i].username + '</a> <p><strong class="text-white">'
                    + data[i].foundtitle + '</strong></p> <p>发布时间：'
                    + data[i].foundpublish + '</p> </div> </div> <div class="panel-content"> <div class="panel-content-left"> <img src="'
                    + data[i].foundpic + '"/> </div> <div class="panel-content-right"> <p>'
                    + data[i].foundcontent + '</p> <strong class="text-yellow">发现地点：'
                    + data[i].foundplace + '</strong><br> <strong class="text-yellow">发现时间：'
                    + data[i].foundtime + '</strong><br> <strong class="text-yellow">联系方式：'
                    + data[i].foundcontact + '</strong> </div> </div> <div class="panel-footer">'
                    + '<a href="#" class="btn btn-default btn-lg changeStatus">';
                    if(data[i].foundget == 1){
                        var status = "已领取";
                    }else{
                        var status = "未领取";
                    }
                    content += status + '</a> <span class="id-none">'
                    + data[i].foundid + '</span> ';
                    if(data[i].userid == loginid){
                        content += '<button class="btn btn-danger btn-lg delFound">删除</button></div> </div>';
                    }else{
                        content += '</div> </div>';
                    }
                }
                $("#foundList").html(content);
                delFound();
                changeStatus();
            }else{
                $("#foundList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    getFoundList(page,row,type);
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    getFoundList(page,row,type);
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}

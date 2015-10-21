/**
 * Created by zhangke on 2015/9/28 0028.
 */
var page = 1;
var row = 10;
var type = "默认排序";
var lastPage = 0;
var login = false;
var loginid = 0;
$(document).ready(function(){
    getUserInfo();                          //获得用户登录信息
    getPromotionList(page,row,type);        //读取优惠信息
    searchStore();                          //搜索商店
    choosePromotionType();                  //选择分类
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
//读取优惠活动
function getPromotionList(page,row,type){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Promotion/readPromotionListByPage",
        dataType:"json",
        data:{
            page:page,
            row:row,
            type:type
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                promotionPage(page,lastPage);
                var promotionContent = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    promotionContent += '<div class="panel"> <div class="panel-head"> <div class="box-left"> <a href="#"> <img src="'
                    + data[i].userpic +'"/> </a><span class="id-none">'
                    + data[i].userid + '</span></div> <div class="box-left">'
                    + '<a href="#">' + data[i].username + '</a><p><strong class="text-white">'
                    + data[i].promotiontitle + '</strong></p><p>发布时间：'
                    + data[i].promotiontime + '</p> </div> </div> <div class="panel-content">'
                    + '<strong class="text-yellow">活动时间：' + data[i].promotionstart + '~'
                    + data[i].promotionend + '</strong> <p>'
                    + data[i].promotioncontent + '</p> <strong class="text-yellow">活动地点：'
                    + data[i].promotionplace + '</strong> </div> <div class="panel-footer">'
                    + '<a href="#" class="btn btn-default btn-lg">正在进行</a>'
                    + '<span class="id-none">'
                    + data[i].promotionid + '</span> ';
                    if(loginid == data[i].userid){
                        promotionContent += '<button class="btn btn-danger btn-lg delPromotion">删除</button> </div> </div>';
                    }
                    promotionContent += '</div> </div>';
                }
                $("#promotionList").html(promotionContent);
                delPromotion();
            }else{
                $("#promotionList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    getPromotionList(page,row,type);
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    getPromotionList(page,row,type);
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//选择优惠活动类别
function choosePromotionType(){
    $('#promotionType a').click(function(){
        $(this).parent().each(function () {//移除其余非点中状态
            $('#promotionType a').removeClass("active");
        });
        $(this).addClass("active");//给所点中的增加样式
        type = $(this).text();
        getPromotionList(page,row,type);
    })
}
//翻页按钮显示
function promotionPage(page,lastPage){
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
//删除优惠活动
function delPromotion(){
    $(".delPromotion").click(function(){
        var promotionid = $(this).prev().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Promotion/delPromotion",
            dataType:"json",
            data:{
                promotionid:promotionid
            },
            success: function (data) {
                if(data != false){
                    getPromotionList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    })
}
//搜索商店
function searchStore(){
    $("#searchStore").click(function(){
        var keyword = $("#keyword").val();
        searchPromotionList(page,row,keyword);
    })
}
//搜索优惠活动 ($page,$row,$keyword){
function searchPromotionList(page,row,keyword){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Promotion/searchPromotion",
        dataType:"json",
        data:{
            page:page,
            row:row,
            keyword:keyword
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                promotionPage(page,lastPage);
                var promotionContent = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    promotionContent += '<div class="panel"> <div class="panel-head"> <div class="box-left"> <a href="#"> <img src="'
                    + data[i].userpic +'"/> </a><span class="id-none">'
                    + data[i].userid + '</span></div> <div class="box-left">'
                    + '<a href="#">' + data[i].username + '</a><p><strong class="text-white">'
                    + data[i].promotiontitle + '</strong></p><p>发布时间：'
                    + data[i].promotiontime + '</p> </div> </div> <div class="panel-content">'
                    + '<strong class="text-yellow">活动时间：' + data[i].promotionstart + '~'
                    + data[i].promotionend + '</strong> <p>'
                    + data[i].promotioncontent + '</p> <strong class="text-yellow">活动地点：'
                    + data[i].promotionplace + '</strong> </div> <div class="panel-footer">'
                    + '<a href="#" class="btn btn-default btn-lg">正在进行</a>'
                    + '<span class="id-none">'
                    + data[i].promotionid + '</span> ';
                    if(loginid == data[i].userid){
                        promotionContent += '<button class="btn btn-danger btn-lg delPromotion">删除</button> </div> </div>';
                    }
                    promotionContent += '</div> </div>';
                }
                $("#promotionList").html(promotionContent);
                delPromotion();
            }else{
                $("#promotionList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    searchPromotionList(page,row,keyword);
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    searchPromotionList(page,row,keyword);
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
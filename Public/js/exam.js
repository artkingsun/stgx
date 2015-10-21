/**
 * Created by zhangke on 2015/9/21 0021.
 */
var page = 1;
var row = 10;
var type = 1;
var lastPage = 0;
var login = false;
var loginid = 0;
$(document).ready(function(){
    getUserInfo();                          //获得用户登录信息
    getYear();                              //获取考试资料年份
    getProf();                              //获取考试资料专业
    getSubject();                           //获取考试资料科目
    getExamList(page,row,type);             //读取考试资料
    searchExam();                           //搜索考试资料
    chooseExamType();                       //选择分类
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
//读取考试资料
function getExamList(page,row,type){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Exam/readExamListByPage",
        dataType:"json",
        data:{
            page:page,
            row:row,
            type:type
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                examPage(page,lastPage);
                var examContent = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    examContent += '<div class="panel"><div class="panel-head"><div class="box-left"><a href="#">'
                    +'<img src="'
                    + data[i].userpic + '"/></a><span class="id-none">'
                    + data[i].userid + '</span></div><div class="box-left"><a href="#">'
                    + data[i].username + '</a><p><strong class="text-white">'
                    + data[i].examtitle + '</strong></p><p>发布时间：'
                    + data[i].examtime + '</p></div></div><div class="panel-content"><p>'
                    + data[i].examcontent
                    + '</p> <strong class="text-yellow">科目：'
                    + data[i].examsubject
                    + '</strong><br><strong class="text-yellow">专业：'
                    + data[i].examprof
                    + '</strong><br><strong class="text-yellow">年份：'
                    + data[i].examyear
                    + '</strong></div>'
                    + '<div class="panel-footer"><span class="id-none">'
                    + data[i].examid
                    + '</span><button class="btn btn-default btn-lg goodExam"><span class="glyphicon glyphicon-thumbs-up"></span>（'
                    + data[i].examgood
                    + '）</button> <button class="btn btn-default btn-lg badExam"><span class="glyphicon glyphicon-thumbs-down"></span>（'
                    + data[i].exambad;
                    if(loginid == data[i].userid){
                        examContent += '）</button> <button class="btn btn-danger btn-lg delExam"><span class="glyphicon glyphicon-trash"></span></button> <a href="'
                        + data[i].examurl
                        + '" target="_blank" class="btn btn-default btn-lg downloadExam"><span class="glyphicon glyphicon-download-alt"></span> 立即下载（'
                        + data[i].examdownload
                        + '）</a></div></div>';
                    }else{
                        examContent += '）</button> <a href="'
                        + data[i].examurl
                        + '" target="_blank" class="btn btn-default btn-lg downloadExam"><span class="glyphicon glyphicon-download-alt"></span> 立即下载（'
                        + data[i].examdownload
                        + '）</a></div></div>';
                    }
                }
                $("#examList").html(examContent);
                goodExam();
                badExam();
                delExam();
                downloadExam();
            }else{
                $("#examList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    getExamList(page,row,type);
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    getExamList(page,row,type);
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//选择资料类别
function chooseExamType(){
    $('#examType a').click(function(){
        $(this).parent().each(function () {//移除其余非点中状态
            $('#examType a').removeClass("active");
        });
        $(this).addClass("active");//给所点中的增加样式
        type = $(this).text();
        //$type 1 默认 2 下载量 3 好评量 4 差评量
        switch (type){
            case "默认排序":
                type = 1;
                break;
            case "下载最多":
                type = 2;
                break;
            case "好评最多":
                type = 3;
                break;
            case "差评最多":
                type = 4;
                break;
        }
        getExamList(page,row,type);
    })
}
//翻页按钮显示
function examPage(page,lastPage){
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
//删除考试资料
function delExam(){
    $(".delExam").click(function(){
        var examid = $(this).siblings().html();
        //alert(examid);
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Exam/delExam",
            dataType:"json",
            data:{
                examid:examid
            },
            success: function (data) {
                if(data != false){
                    getExamList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
    })
}
//下载考试资料
function downloadExam(){
    $(".downloadExam").click(function(){
        var examid = $(this).siblings().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Exam/countDownload",
            dataType:"json",
            data:{
                examid:examid
            },
            success: function (data) {
                if(data != false){
                    getExamList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
        getExamList(page,row,type);
    })
}
//好评考试资料
function goodExam(){
    $(".goodExam").click(function(){
        var examid = $(this).siblings().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Exam/countGood",
            dataType:"json",
            data:{
                examid:examid
            },
            success: function (data) {
                if(data != false){
                    getExamList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
        getExamList(page,row,type);
    })
}
//差评考试资料
function badExam(){
    $(".badExam").click(function(){
        var examid = $(this).siblings().html();
        $.ajax({
            type:"GET",
            url:"index.php?s=Home/Exam/countBad",
            dataType:"json",
            data:{
                examid:examid
            },
            success: function (data) {
                if(data != false){
                    getExamList(page,row,type);
                }
            },
            error:function (){
                //alert('服务器错误！');
            }
        });
        getExamList(page,row,type);
    })
}
//下载、好评、差评目前只实现计数，未判断是否重复评价等
//获得考试资料年份
function getYear(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Exam/getYear",
        dataType:"json",
        success: function (data) {
            if(data != false){
                var yearContent = '<option value="选择年份">选择年份</option>';
                var j = data.length;
                for(var i = 0; i < j; i++){
                    yearContent += '<option value="'
                    + data[i].examyear + '">' + data[i].examyear + '</option>';
                }
                $("#chooseYear").html(yearContent);
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//获得考试资料专业
function getProf(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Exam/getProf",
        dataType:"json",
        success: function (data) {
            if(data != false){
                var profContent = '<option value="选择专业">选择专业</option>';
                var j = data.length;
                for(var i = 0; i < j; i++){
                    profContent += '<option value="'
                    + data[i].examprof + '">' + data[i].examprof + '</option>';
                }
                $("#chooseProf").html(profContent);
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//获得考试资料科目
function getSubject(){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Exam/getSubject",
        dataType:"json",
        success: function (data) {
            if(data != false){
                var subjectContent = '<option value="选择科目">选择科目</option>';
                var j = data.length;
                for(var i = 0; i < j; i++){
                    subjectContent += '<option value="'
                    + data[i].examsubject + '">' + data[i].examsubject + '</option>';
                }
                $("#chooseSubject").html(subjectContent);
            }
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
//搜索考试资料 ($page,$row,$year,$prof,$subject,$keyword)
function searchExam(){
    $("#search").click(function(){
        var year = $("#chooseYear").val();
        var prof = $("#chooseProf").val();
        var subject = $("#chooseSubject").val();
        var keyword = $("#keyword").val();
        if(year == "选择年份"){
            year = "";
        }
        if(prof == "选择专业"){
            prof = "";
        }
        if(subject == "选择科目"){
            subject = "";
        }
        //alert(year + prof + subject + keyword);
        if(subject.length > 0 && subject.length < 20){
            searchExamList(page,row,year,prof,subject,keyword);
        }
    })

}
//搜索考试资料列表
function searchExamList(page,row,year,prof,subject,keyword){
    $.ajax({
        type:"GET",
        url:"index.php?s=Home/Exam/searchExam",
        dataType:"json",
        data:{
            page:page,
            row:row,
            year:year,
            prof:prof,
            subject:subject,
            keyword:keyword
        },
        success: function (data) {
            if(data != false){
                lastPage = data[data.length - 1].pageall;
                examPage(page,lastPage);
                var examContent = '';
                var j = data.length - 1;
                for(var i = 0;i < j;i++ ){
                    examContent += '<div class="panel"><div class="panel-head"><div class="box-left"><a href="#">'
                    +'<img src="'
                    + data[i].userpic + '"/></a><span class="id-none">'
                    + data[i].userid + '</span></div><div class="box-left"><a href="#">'
                    + data[i].username + '</a><p><strong class="text-white">'
                    + data[i].examtitle + '</strong></p><p>发布时间：'
                    + data[i].examtime + '</p></div></div><div class="panel-content"><p>'
                    + data[i].examcontent
                    + '</p> <strong class="text-yellow">科目：'
                    + data[i].examsubject
                    + '</strong><br><strong class="text-yellow">专业：'
                    + data[i].examprof
                    + '</strong><br><strong class="text-yellow">年份：'
                    + data[i].examyear
                    + '</strong></div>'
                    + '<div class="panel-footer"><span class="id-none">'
                    + data[i].examid
                    + '</span><button class="btn btn-default btn-lg goodExam"><span class="glyphicon glyphicon-thumbs-up"></span>（'
                    + data[i].examgood
                    + '）</button> <button class="btn btn-default btn-lg badExam"><span class="glyphicon glyphicon-thumbs-down"></span>（'
                    + data[i].exambad;
                    if(loginid == data[i].userid){
                        examContent += '）</button> <button class="btn btn-danger btn-lg delExam"><span class="glyphicon glyphicon-trash"></span></button> <a href="'
                        + data[i].examurl
                        + '" target="_blank" class="btn btn-default btn-lg downloadExam"><span class="glyphicon glyphicon-download-alt"></span> 立即下载（'
                        + data[i].examdownload
                        + '）</a></div></div>';
                    }else{
                        examContent += '）</button> <a href="'
                        + data[i].examurl
                        + '" target="_blank" class="btn btn-default btn-lg downloadExam"><span class="glyphicon glyphicon-download-alt"></span> 立即下载（'
                        + data[i].examdownload
                        + '）</a></div></div>';
                    }
                }
                $("#examList").html(examContent);
                goodExam();
                badExam();
                delExam();
                downloadExam();
            }else{
                $("#examList").html("这家伙真懒，什么都没留下！");
                $("#lastPage").css("display","none");
                $("#nextPage").css("display","none");
            }
            //上一页
            $("#lastPage").click(function(){
                if(page > 1){
                    page -= 1;
                    searchExamList(page,row,year,prof,subject,keyword)
                }
            });
            //下一页
            $("#nextPage").click(function(){
                if(page < lastPage){
                    page += 1;
                    searchExamList(page,row,year,prof,subject,keyword)
                }
            });
        },
        error:function (){
            //alert('服务器错误！');
        }
    });
}
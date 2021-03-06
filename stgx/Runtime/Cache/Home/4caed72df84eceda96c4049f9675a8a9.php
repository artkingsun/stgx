<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>书童高校--优惠活动</title>
    <meta name="keywords" content="书童高校 校园应用 学生平台 IT技术 计算机 博客 互联网 Web前端 PHP UI UED" />
    <meta name="description" content="书童高校" />
    <meta name="copyright" content="书童高校" />
    <meta name="author" content="Art" />

    <!--响应式开启-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--IE兼容-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--将360默认为极速模式打开-->
    <meta name="renderer" content="webkit">
    <!--加载CSS样式-->
    <link rel="stylesheet" href="Public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Public/css/stgx.css" />
    <link rel="icon" href="Public/images/icon.png">
</head>
<body>
<!-- 导航 开始-->
<nav class="navbar navbar-default  navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?s=Home/Index/index">书童高校</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php?s=Home/Index/index">首页</a></li>
                <li><a href="index.php?s=Home/Index/exam">考试资料</a></li>
                <li><a href="index.php?s=Home/Index/found">失物招领</a></li>
                <li class="active"><a href="index.php?s=Home/Index/promotion">优惠活动</a></li>
                <li><a href="index.php?s=Home/Index/feedback">用户反馈</a></li>
                <li><a href="index.php?s=Home/Index/about">关于我们</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right" id="nav-login" style="display: none">
                <li><a href="index.php?s=Home/Index/login">登录</a></li>
                <li><a href="index.php?s=Home/Index/register">注册</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="nav-user" style="display: none">
                <li class="active" class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="nav-name"> 昵称 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?s=Home/Index/myBlog">我的主页</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?s=Home/Index/personSet">个人设置</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?s=Home/Index/messageCenter">消息中心</a></li>
                        <li class="divider"></li>
                        <li><a href="#" id="exit">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--导航 结束-->

<!--内容 开始-->
<div class="container">
    <div class="row">
        <div class="col-md-2 ">
            <div class="input-group-lg">
                <a class="btn btn-block btn-lg btn-violet" href="index.php?s=Home/Index/index">返回主页</a>
            </div>

        </div>
        <div class="col-md-8">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="搜索关键字" id="keyword">
                <span class="input-group-btn">
                <!--<button class="btn btn-default" type="button">搜索</button>-->
                    <button class="btn btn-violet" id="searchStore">优惠商家</button>
                </span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group-lg">
                <a href="index.php?s=Home/Index/promotionPublish" class="btn btn-block btn-lg btn-violet">我要发布</a>
            </div>

        </div>
    </div>

    <br/>
    <div class="row" >
        <div class="col-md-offset-2 col-md-8">
            <ul class="nav-list-left" id="promotionType">
                <li><a href="#" class="active">默认排序</a></li>
                <li><a href="#">火锅</a></li>
                <li><a href="#">干锅</a></li>
                <li><a href="#">超市</a></li>
                <li><a href="#">炒菜</a></li>
            </ul>
            <br/>
        </div>

    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8" id="promotionList">
            <!--<div class="panel">-->
                <!--<div class="panel-head">-->
                    <!--<div class="box-left">-->
                        <!--<a href="#">-->
                            <!--<img src="Public/images/8.jpg"/>-->
                        <!--</a>-->
                        <!--<span class="id-none">-->
                            <!--userid-->
                        <!--</span>-->
                    <!--</div>-->
                    <!--<div class="box-left">-->
                        <!--<a href="#">昵称</a>-->
                        <!--<p><strong class="text-white">标题</strong></p>-->
                        <!--<p>发布时间：2015-01-01 00:00:00</p>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="panel-content">-->
                    <!--<strong class="text-yellow">活动时间：2015-06-10~2015-06-12</strong>-->
                    <!--<p>内容内容内容容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</p>-->

                    <!--<strong class="text-yellow">活动地点：西南科技大学新区 XX街</strong>-->
                <!--</div>-->
                <!--<div class="panel-footer">-->
                    <!--<a href="#" class="btn btn-default btn-lg">正在进行</a>-->
                    <!--<span class="id-none">foundid</span>-->
                    <!--<button class="btn btn-danger btn-lg delPromotion">删除</button>-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="panel">-->
                <!--<div class="panel-head">-->
                    <!--<div class="box-left">-->
                        <!--<a href="#">-->
                            <!--<img src="Public/images/8.jpg"/>-->
                        <!--</a>-->
                        <!--<span class="id-none">-->
                            <!--userid-->
                        <!--</span>-->
                    <!--</div>-->
                    <!--<div class="box-left">-->
                        <!--<a href="#">昵称</a>-->
                        <!--<p><strong class="text-white">标题</strong></p>-->
                        <!--<p>发布时间：2015-01-01 00:00:00</p>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="panel-content">-->
                    <!--<strong class="text-yellow">活动时间：2015-06-10~2015-06-12</strong>-->
                    <!--<p>内容内容内容容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</p>-->

                    <!--<strong class="text-yellow">活动地点：西南科技大学新区 XX街</strong>-->
                <!--</div>-->
                <!--<div class="panel-footer">-->
                    <!--<a href="#" class="btn btn-default btn-lg">正在进行</a>-->
                    <!--<span class="id-none">foundid</span>-->
                    <!--<button class="btn btn-danger btn-lg">删除</button>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <button class="btn btn-violet" id="lastPage"><span class="glyphicon glyphicon-chevron-left"></span> 上一页</button>
            <button class="btn btn-violet" id="nextPage">下一页 <span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </div>
    <br/>
</div>

<!--内容 结束-->



<!--结尾 开始-->
<div class="footer" id="footer">

</div>
<!--结尾 结束-->

<script type="text/javascript" src="Public/js/jquery.min.js" ></script>
<script type="text/javascript" src="Public/bootstrap/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="Public/js/art.js" ></script>
<script type="text/javascript" src="Public/js/promotion.js" ></script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>书童高校--关于我们</title>
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
                <li><a href="index.php?s=Home/Index/promotion">优惠活动</a></li>
                <li><a href="index.php?s=Home/Index/feedback">用户反馈</a></li>
                <li class="active"><a href="index.php?s=Home/Index/about">关于我们</a></li>
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
        <div class="col-md-3">
            <a href="index.php?s=Home/Index/index">
                <img src="Public/images/logo.png" width="100%" height="120"/>
            </a>
        </div>

    </div>

    <hr />

    <div class="row">
        <div class="col-md-3" id="about-nav">
            <!--<button class="btn btn-lg btn-block btn-violet"  data-toggle="modal" data-target="#publishAbout">发布信息</button>-->
            <!--<br>-->
            <!--<ul class="nav-list" id="aboutType">-->
                <!--<li ><a href="#" class="active">所有信息</a></li>-->
                <!--<li ><a href="#">关于我们</a></li>-->
                <!--<li ><a href="#">技术标准</a></li>-->
                <!--<li ><a href="#">功能实现</a></li>-->
            <!--</ul>-->
        </div>
        <div class="col-md-9" id="aboutList">
            <!--<div class="panel">-->
                <!--<div class="panel-head">-->
                    <!--<span class="id-none">aboutid</span>-->
                    <!--<button type="button" class="close delAbout" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--<p class="text-white">小标题</p>-->
                <!--</div>-->
                <!--<div class="panel-content">-->
                    <!--<p>-->
                        <!--内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容-->
                    <!--</p>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="panel">-->
                <!--<div class="panel-head">-->
                    <!--<span class="id-none">aboutid</span>-->
                    <!--<button type="button" class="close delAbout id-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--<p class="text-white">小标题</p>-->
                <!--</div>-->
                <!--<div class="panel-content">-->
                    <!--<p>-->
                        <!--内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容-->
                    <!--</p>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</div>

<!--内容 结束-->



<!--结尾 开始-->
<div class="footer" id="footer">

</div>
<!--结尾 结束-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="publishAbout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">发布信息</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="text-white" >小标题</label>
                    <input type="text" class="form-control"  placeholder="输入小标题" id="title">
                    <label class="text-white">内容描述</label>
                    <textarea class="form-control" rows="3" placeholder="输入内容" id="content"></textarea>
                    <label class="text-white" >选择类别</label>
                    <select class="form-control" id="type">
                        <option value="关于我们">关于我们</option>
                        <option value="技术标准">技术标准</option>
                        <option value="功能实现">功能实现</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button id="addAbout" type="button" class="btn btn-block btn-violet" data-dismiss="modal">确定</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="Public/js/jquery.min.js" ></script>
<script type="text/javascript" src="Public/bootstrap/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="Public/js/art.js" ></script>
<script type="text/javascript" src="Public/js/about.js" ></script>
</body>
</html>
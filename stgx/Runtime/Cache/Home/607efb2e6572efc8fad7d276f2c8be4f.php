<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>书童高校--失物招领</title>
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
                <li class="active"><a href="index.php?s=Home/Index/found">失物招领</a></li>
                <li><a href="index.php?s=Home/Index/promotion">优惠活动</a></li>
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
        <div class="col-md-offset-1 col-md-2">
            <a class="btn btn-block btn-lg btn-violet" href="index.php?s=Home/Index/found">失物招领</a>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-head">
                    <div class="col-md-12">
                        <h3 class="text-yellow">发布失物</h3>
                    </div>
                </div>
                <div class="panel-content">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label  class="text-white">标题</label>
                            <input class="form-control" placeholder="标题" id="title">
                        </div>
                        <div class="form-group">
                            <label  class="text-white">失物描述</label>
                            <textarea class="form-control" rows="3" placeholder="失物描述" id="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label  class="text-white">发现地点</label>
                            <input class="form-control" placeholder="发现地点" id="place">
                        </div>
                        <div class="form-group">
                            <label  class="text-white">发现时间</label>
                            <input class="form-control" placeholder="发现时间" id="foundTime">
                        </div>
                        <div class="form-group">
                            <label  class="text-white">联系方式</label>
                            <input class="form-control" placeholder="手机/QQ/Email等方式" id="contact">
                        </div>
                        <!--<div class="form-group">-->
                            <!--<label  class="text-white">领取地点</label>-->
                            <!--<input class="form-control"   placeholder="领取地点">-->
                        <!--</div>-->

                        <div class="row form-group">
                            <label class="col-md-2 text-white">上传失物图片</label>
                            <form action="index.php?s=Home/File/upload" onsubmit="return a()" enctype="multipart/form-data" method="post"  id="uploadPic">
                                <div class="col-md-4">
                                    <input type="file"  name="photo" />
                                </div>
                                <div class="col-md-6">
                                    <input type="button"  class="btn btn-yellow" value="上传图片" id="addPic" >
                                </div>
                            </form>

                            <div class="col-md-offset-2 col-md-4" id="showPic">
                                </br>
                                <img class="img-responsive" src="Public/images/5.jpg" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-4">
                                <button class="btn btn-block btn-lg btn-yellow" id="addFound">发布</button>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!--内容 结束-->



<!--结尾 开始-->
<div class="footer" id="footer">

</div>
<!--结尾 结束-->

<script type="text/javascript" src="Public/js/jquery.min.js" ></script>
<script type="text/javascript" src="Public/js/jquery.form.js"></script>
<script type="text/javascript" src="Public/bootstrap/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="Public/js/art.js" ></script>
<script type="text/javascript" src="Public/js/foundPublish.js" ></script>
</body>
</html>
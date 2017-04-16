<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="autocomplete" content="off" />
    <script src="/js/jquery.min.js"></script>
    <script src="/lib/jquery.cookie.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.css">
    <script src="/lib/bootstrap/js/bootstrap.js"></script>
    <!-- bootstrap sweetalert -->
    <script src="/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="/lib/bootstrap-sweetalert/sweetalert.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.css">
    <!-- asset component -->
    <link rel="stylesheet" href="/css/components.css">
	<!-- 사용자 정의 css -->
	<link rel="stylesheet" href="/css/main.css?v=<?=date('YmdHis');?>" />
	<script type="text/javascript" src="/js/main.js?v=<?=date('YmdHis');?>"></script>
    <title>Newstory</title>
</head>
<body>
<div class="page-wrapper">
    <header class="header">
        <div class="container hidden-sm hidden-xs">
            <h1 class="text-center margin-bottom-20">
                    <!--<img src="/images/ci_img/logo_ci_main.png" alt="메인로고" class="title-image">-->
                    Newstory
            </h1>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnbList">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand hidden-md hidden-lg" href="/">NewStory</a>
                </div>
                <div class="collapse navbar-collapse" id="gnbList">
                    <ul class="nav navbar-nav">
                        <? foreach ( $gnb as $g ) { ?>
                            <li role="presentation" class="<? if (substr($pagecode,0,2) == substr($g[0],0,2)) { echo 'active'; }?>"><a href="<?=$g[3];?>"><?=$g[1];?></a></li>
                        <? } ?>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if ( ! get_cookie('is_login')  ) {
                            ?>
                            <li><a href="/users/login">로그인</a></li>
                            <li><a href="/users/membership">회원가입</a></li>
                        <?
                        } else {
                            ?>
                            <li><a href="/users/login/logout">로그아웃</a></li>
                            <li><a href="/users/membership">My page</a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
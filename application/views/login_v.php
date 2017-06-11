<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEWVID LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert.css">    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        html,body { height: 100%; background: #f1f1f1; }
        .wrap { width:640px; box-sizing: border-box; padding:10px; margin:auto; }
        .logo { width:300px; }
        .wrap form { background-color: #FFF; padding:15px;  }
        .page-header h1 { text-align: center; }
        @media screen and (max-width : 640px) {
            .wrap {
                width : 90%;
            }
        }
    </style>
</head>
<body>
<div class="wrap clearfix">
    <div class="page-header">
        <h1>
            <img src="/images/logo_gray3.png" alt="로그인 로고" class="logo">
        </h1>
    </div>
    <?=form_open('/members/loginGo',array('class'=>'login-form'))?>
        <div class="form-group">
            <input type="text" class="form-control input-lg" name="id" id="id" placeholder="ID" autocomplete="off" autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="PASSWORD" autocomplete="new-password">
        </div>
        <button type="button" class="btn btn-primary pull-right" onclick="login();" id="login-submit-btn">
            제출
            <i class="glyphicon glyphicon-ok"></i>
        </button>
        <p class="text-primary">
            <a href="/members/addMember">
                아직 회원이 아니신가요?
            </a>
        </p>
    <?=form_close()?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="/lib/sweetalert/sweetalert.min.js"></script>

</body>
</html>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>뉴스토리 회원가입</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        html,body { background: #f1f1f1; height: 100%; }
        body {

        }
        .wrap { width:640px; margin:auto; box-sizing: border-box; padding:10px; border:1px solid #F2F2F2; }
        .wrap form { background: #FFF; padding:15px; }
        .logo { width:300px; }
        .page-header h1 { text-align: center; }
        @media screen and (max-width : 640px) {
            .wrap {
                width : 90%;
            }
        }
    </style>
</head>
<body>
<!--
이름, 닉네임, 아이디, 패스워드, 이메일
-->
<div class="wrap">
    <div class="page-header">
        <h1>
            <img src="/images/logo_gray3.png" alt="로그인 로고" class="logo">
        </h1>
    </div>
    <form action="/members/joinmember" method="post">
        <div class="form-group">
            <textarea name="access" rows="8" readonly class="form-control">
만든사람 : 이지훈
연락처 : 010-9003-6094
            </textarea>
            <div class="md-checkbox-inline">
                <div class="md-checkbox">
                    <input type="checkbox" class="md-check" id="access-check">
                    <label for="access-check">
                        <span class="inc"></span>
                        <span class="check"></span>
                        <span class="box"></span>
                        동의합니다.
                    </label>
                </div>
            </div>
        </div>
        <p class="help-block text-right"><i class="fa fa-check"></i>는 필수항목 입니다.</p>
        <div class="form-group">
            <div class="input-icon left">
                <i class="fa fa-check"></i>
                <input type="text" name="name" id="name" class="form-control" placeholder="이름">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-icon left">
                    <i class="fa fa-check"></i>
                    <input type="text" name="id" id="id" placeholder="아이디" class="form-control">
                </div>
                <span class="input-group-btn">
                    <a class="btn btn-primary" onclick="idCheck();" id="idCheckBtn">중복확인</a>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-icon left">
                    <input type="text" name="nick" id="nick" placeholder="닉네임" class="form-control">
                </div>
                <span class="input-group-btn">
                    <a class="btn btn-primary" id="nickCheckBtn" onclick="nickCheck();">중복확인</a>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon left">
                <i class="fa fa-check"></i>
                <input type="password" name="password" id="password" placeholder="비밀번호" class="form-control" autocomplete="new-password" onkeyup="passwordCheck(this);">
                <p class="help-block" id="pass-help"></p>
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon left">
                <i class="fa fa-check"></i>
                <input type="password" name="password_re" id="password_re" placeholder="비밀번호 확인" class="form-control" autocomplete="new-password" onkeyup="passwordReCheck(this);">
                <p class="help-block" id="pass-re-help"></p>
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon left">
                <input type="email" name="email" id="email" placeholder="이메일" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <input type="button" value="가입하기" class="btn btn-default" onclick="submitForm();">
        </div>
    </form>
</div>
<input type="hidden" id="idCheck" value="false">
<input type="hidden" id="passCheck" value="false">
<input type="hidden" id="passReCheck" value="false">
<input type="hidden" id="nickCheck" value="false">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.js"></script>
<script src="/lib/sweetalert/sweetalert.min.js"></script>
<script>
    var token = $("ci_token_newvid").val();

function submitForm()
{
    //target forms
    var accessCheck,name,id,password,password_re,nick,email;
    accessCheck = $("#access-check"),
        name = $("#name"),
        id = $("#id"),
        password = $("#password"),
        password_re = $("#password_re"),
        nick = $("#nick"),
        email = $("#email");

    //hidden forms
    var idc,passc,passrec,nickc;
    idc = $("#idCheck"),
        passc = $("#passCheck"),
        passrec = $("#passReCheck"),
        nickc = $("#nickCheck");

    //help-blocks
    var accessCheck_help,name_help,password_help,password_re_help,nick_help,email_help;




    if ( accessCheck.is(":checked") == false ) {
        swal("","약관에 동의 해 주세요.","warning");
        return false;
    }

    if ( name.val() == "" || id.val() == "" || password.val() == "" || password_re.val() == "" )
    {
        swal("","필수항목을 입력 해 주세요.","warning");

        return false;
    }

    if ( idc.val() == "false" ) { swal("","아이디 중복 확인을 해주세요.","warning"); return false; }
    if ( passc.val() == "false" ) { swal("","올바른 비밀번호를 입력 해주세요!! -_-+","warning"); return false; }
    if ( passrec.val() == "false" ) { swal("","비밀번호 확인을 해주세요 -_-+","warning"); return false; }
    if ( nickc.val() == "false" ) { swal("","닉네임을 사용하시려면 중복확인을 하셔야 합니다.","warning"); return false; }


    $("form").submit();
}

function nickCheck() {
    var data = {
        ci_token_newvid : token,
        nick : $("#nick").val()
    };

    if ( data.nick < 4 || data.nick > 12) {
        swal("","닉네임은 4자이상 12자 이하로 입력 해 주세요.","warning");

        return false;
    }


    $.ajax({
        url : "/members/check/nick",
        type : "GET",
        data : {ci_token_newvid : token, nick : $("#nick").val()},
        success : function (data) {
            try {
                //data = Number(data);

                console.log(data);
                if ( data == 0 ) {
                    swal("","사용 가능 한 닉네임 입니다.","success");
                    $("#nick").attr("readonly",true);
                    $("#nickCheckBtn").html("<li class='fa fa-check'></li>");
                    $("#nickCheckBtn").addClass('disabled')
                    $("#nickCheck").val("true");
                } else {
                    swal('','이미 사용중인 닉네임 입니다.','warning');
                    $("#nickCheck").val("false");
                }
            } catch (e) {console.log(e);}
        }
    })
}



function passwordCheck(pass) {
    var check = /^(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])(?=.*[0-9]).{6,100}$/;

    if ( !check.test($(pass).val()) ) {
        $("#pass-help").text("비밀번호는 6자 이상 으로 입력 해주세요.");
        $("#pass-help").removeClass("text-success");
        $("#pass-help").addClass("text-danger");
        $("#passCheck").val("false");

    } else {
        $("#pass-help").text("안전 한 비밀번호 입니다.");
        $("#pass-help").addClass("text-success");
        $("#pass-help").removeClass("text-danger");
        $("#passCheck").val("true");
    }
}

function passwordReCheck(re) {
    var password = $("#password").val();

    if ($(re).val() != password ) {
        $("#pass-re-help").text("비밀번호가 다릅니다.");
        $("#pass-re-help").removeClass("text-success");
        $("#pass-re-help").addClass("text-danger");
        $("#passReCheck").val("false");
    } else {
        $("#pass-re-help").text("사용가능 한 비밀번호 입니다.");
        $("#pass-re-help").addClass("text-success");
        $("#pass-re-help").removeClass("text-danger");
        $("#passReCheck").val("true");
    }
}

function idCheck() {
    var data = {
      ci_token_newvid : token,
        id : $("#id").val()
    };

    if ( data.id.length < 4 ) {
        swal('','아이디는 4글자 이상 입력 해주세요.','warning');

        return;
    }

    if (data.id.length < 4 || data.id.length > 12)
    {
        swal("","아이디는 4~12자 이내로 입력 해주세요.","warning");
        return;
    }

    for (var i=0; i<data.id.length; i++)
    {
        var ch = data.id.charAt(i);

        if ( ( ch < "a" || ch > "z") && (ch < "A" || ch > "Z") && (ch < "0" || ch > "9" ) )
        {
            swal("","아이디는 영문 소문자로만 입력 가능 합니다","warning");
            return;
        }
    }

    if (!isNaN(data.id.substr(0,1)))
    {
        swal("","아이디는 숫자로 시작할 수 없습니다!","warning");
        return;
    }

    $.ajax({
        url : "/members/check/id",
        type : "GET",
        data : data,
        success : function (data) {
            try {
                data = Number(data);
                if ( data == 0 ) {
                    swal('','사용 가능 한 아이디 입니다.','success');
                    $("#id").attr("readonly",true);
                    $("#idCheckBtn").html("<li class='fa fa-check'></li>");
                    $("#idCheckBtn").addClass('disabled')
                    $("#idCheck").val("true");
                } else {
                    swal('','이미 사용중인 아이디 입니다.','warning');
                    $("#id_chk").val("false");
                }
            }catch(e) {
                swal('','서버에러','error');
            }
        }
    })
}
</script>
</body>
</html>
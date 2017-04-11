<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="alert alert-danger hide">
                <strong></strong>
            </div>
        </div>
    </div>
    <div class="page-header">
        <h2>로그인</h2>
        <?print_r($name);?>
    </div>
    <div class="row">
        <div class="col-md-2 hidden-sm hidden-xs">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="/users/login">로그인</a></li>
                <li role="presentation"><a href="/users/membership">회원가입</a></li>
            </ul>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <form method="post">
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-user"></i>
                        <label for="" class="control-label sr-only">아이디</label>
                        <input type="text" class="form-control input-lg input-block" name="id" placeholder="아이디">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-lock"></i>
                        <label for="" class="control-label sr-only">비밀번호</label>
                        <input type="password" class="form-control input-lg" name="password" placeholder="비밀번호">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group checks">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">자동로그인</label>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn btn-primary pull-right btn-lg" value="로그인" onclick="login();">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function login()
    {
        var data = {};

            data.submitUrl = "/users/login/login_start";
            data.id = $("input[name=id]").val();
            data.password = $("input[name=password]").val();
            data.remember = $("input[name=remember]").is(":checked");
            data.token = $.cookie('ci_cookie_newvid');

        /* 로그인 컨트롤러 ajax 호출 */

        $.ajax({
            url : data.submitUrl,
            type : "POST",
            data : {id : data.id, password : data.password, remember : data.remember,ci_token_newvid : data.token},
            success : function (data) {
                if ( data != true ) {
                    swal(data);
                } else {
                    window.location.href = "/";
                }
            }
        })


    }
</script>
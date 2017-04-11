<div class="container-fluid">
    <div class="page-header">
        <h2>
            회원가입

        </h2>
    </div>
    <div class="row">
        <div class="col-md-2 hidden-sm hidden-xs">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="/users/login">로그인</a></li>
                <li role="presentation" class="active"><a href="/users/membership">회원가입</a></li>
            </ul>
        </div>
        <div class="col-md-4 col-md-offset-2 col-sm-12">
            <form action="" method="post" id="newvid_membership_form">
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-check"></i>
                        <label for="" class="control-label sr-only">이름</label>
                        <input type="text" class="form-control input-lg" name="name" placeholder="(필수) 이름">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <label for="" class="control-label sr-only">아이디</label>
                        <i class="fa fa-check"></i>
                        <input type="text" class="form-control input-lg" name="id" placeholder="(필수) 아이디를 입력 해주세요." onblur="membership_id_check(this);" maxlength="10" autocomplete="false">
                        <p class="help-block hide"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-lock"></i>
                        <label for="" class="control-label sr-only">비밀번호</label>
                        <input type="password" id="pass_field" class="form-control input-lg" name="password" placeholder="(필수) 비밀번호를 입력 해주세요." onkeyup="membership_pass_check(this);" autocomplete="false">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-lock"></i>
                        <label for="" class="control-label sr-only">비밀번호 확인</label>
                        <input type="password" id="pass_confirm_field" class="form-control input-lg" name="re_password" placeholder="(필수) 비밀번호를 다시한번 입력 해주세요." onkeyup="membership_pass_confirm_check(this,'pass_field');" autocomplete="false">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
                        <i class="fa fa-envelope"></i>
                        <label for="" class="control-label sr-only">이메일</label>
                        <input type="email" class="form-control input-lg" name="email" placeholder="Email" autocomplete="false">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon left input-icon-lg">
						<i class="fa fa-phone"></i>
						<label for="" class="sr-only">연락처</label>
						<input type="tel" class="form-control input-lg" name="tel" placeholder="연락처" autocomplete="false"/>
						<p class="help-block"></p>
					</div>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-primary btn-lg" onclick="membership_submit();">
                        완료
                        <i class="fa fa-check"></i>
                    </button>
                    <button type="reset" class="btn btn-default btn-lg">
                        취소
                        <i class="fa fa-repeat"></i>
                    </button>
                </div>
                <input type="hidden" name="ci_token_newvid" value="<?=$_COOKIE['ci_cookie_newvid'];?>">
            </form>
			<input type="hidden" id="id_chk" value="false"/>
			<input type="hidden" id="pass_chk" value="false"/>
			<input type="hidden" id="pass_confirm_chk" value="false"/>
        </div>
    </div>
</div>
<nav class="nav navbar-default margin-bottom-30">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" onclick="mPanelOpener();">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">NEWSTORY</a>
            <p class="navbar-text hidden-sm hidden-xs">
                <i class="fa fa-bell"></i>
                뉴스토리 블로그가 개설되었습니다.
            </p>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <!-- aside 메뉴 -->
        <div class="col-md-3 aside_wrapper">
            <form action="/" method="get">
                <div class="input-group-block search-group">
                    <div class="input-icon left">
                        <i class="fa fa-search"></i>
                        <input type="search" name="search" class="form-control input-block"/>
                    </div>
                </div>
            </form>
            <div class="aside-panel-wrap">
                <div class="action-toggle margin-bottom-15 margin-top-15 text-right hidden-md hidden-lg">
                    <a href="javascript:void(0);" onclick="mPanelOpener();">
                        <i class="fa fa-times fa-2x"></i>
                    </a>
                </div>
                <hr>
                <?
                //로그인 안됐을때//
                if ($this->session->is_login == false) {
                    ?>
                    <?= form_open('/members/loginGo', array('class' => 'login-form clearfix')) ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID" autocomplete="off"
                               autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD"
                               autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block login-btn" onclick="login();">
                            Sign In
                            <i class="fa fa-sign-in"></i>
                        </button>
                    </div>
                    <?= form_close() ?>
                    <p class="text-primary">
                        <a href="/members/addMember">
                            회원으로 가입하세요. 매우 간단합니다.<br />
                            가입하기
                        </a>
                    </p>
                    <?
                } else {
                    //로그인 됐을 때//
                    ?>
                    <p class="text-muted">
                        <i class="fa fa-cog fa-spin"></i>
                        <span class="sr-only">Loading...</span>
                        <?= $this->session->sess_name ?> 님
                        <a href="javascript:void(0);" class="members btn btn-primary btn-xs pull-right"
                           onclick="logout();">로그아웃</a>
                        <a href="javascript:void(0);" class="members btn btn-primary btn-xs pull-right" disabled="true"
                           onclick="swal('서비스 준비중입니다.'); return false;">마이페이지</a>
                    </p>
                <? } ?>
                <hr>
                <div class="aside">
                    <nav class="gnb" id="gnb">
                        <div class="list-group">
                            <? if ($this->session->is_login == TRUE) { ?>
                                <a class="list-group-item <? if ($pagecode == 'A00000') {
                                    echo 'active';
                                } ?>" href="/main/write">글쓰기</a>
                            <? } ?>
                            <?
                            foreach ( $menu as $v ) {
                                $smidx = substr($v['idx'],0,2);
                                $seidx = substr($pagecode,0,2);
                                $path = ($smidx == '10') ? '/' : '/main/lists' . $v['path'];
                                ?>
                                <a href="<?=$path?>" class="list-group-item <? if($smidx == $seidx) echo 'active' ?>">
                                    <?=$v['name']?>
                                    <?php
                                    $result = $this->Main_m->getNew($v['idx']);
                                    $li_count = $result->num_rows();
                                    if ( $li_count > 0 ) {
                                    ?>
                                    <span class="badge"><?=$result->num_rows()?></span>
                                    <? } ?>
                                </a>
                            <? } ?>
                        </div>
                    </nav>
					<hr>											
					<a href="javascript:_chatFrameOpenner();" class="btn green-jungle btn-block">
						N-Chat v1.0.0
					</a>
                </div><!-- aside end -->
            </div>
        </div>
        <!-- aside end -->


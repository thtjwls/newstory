<?php $gnb = $this->category->Gnb(); ?>
<div class="page-container">
    <div class="container-fluid">
		<div class="m-panel-wrap" id="sidebar">
			<div class="m-panel-side-wrap">
                <!-- 모바일 로그인 -->
				<div class="clearfix margin-bottom-20 hidden-md hidden-lg hidden-sm">
                    <?php if ( ! get_cookie('is_login') ) { ?>
                        <a href="/users/login" class="btn top-margin">로그인</a>
                    <? } else { ?>
                        <a href="/users/login/logout" class="btn top-margin">로그아웃</a>
                    <? } ?>
					<a href="javascript:panel();" class="btn btn-default pull-right m-panel-close">
					<i class="fa fa-times"></i>
					</a>
				</div>
				<ul class="nav nav-tabs m-panel <? if ($pagecode == 'FFFFFF') echo 'hidden'?>">
                    <? foreach ( $gnb as $g ) { ?>
                        <li role="presentation" class="<? if (substr($pagecode,0,2) == substr($g[0],0,2)) { echo 'active'; }?>"><a href="<?=$g[3];?>"><?=$g[1];?></a></li>
                    <? } ?>
				</ul>
			</div>
		</div><!--  m-panel-wrap end -->
    </div><!-- container end -->
</div><!-- page-container end-->
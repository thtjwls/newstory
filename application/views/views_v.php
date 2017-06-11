<?
if( $vw['in_use'] == 0 ){
	alert('삭제된 글입니다.','/','error');

	exit;
}
?>
<div class="views-container margin-bottom-30">
    <ol class="breadcrumb">
        <li class="active"><?=$ca?></li>
    </ol>
    <h2 class="">
		<?=$vw['subject']?>
    </h2>
    <hr>
    <p class="text-info text-right">
        <span class="subject-info help-inline">작성 <?= substr($vw['regist'],0,16)?></span>
        <span class="subject-info help-inline">조회 <?=$vw['views']?></span>
    </p>
    <div class="views-contents-container clearfix">
        <div class="views-contents-tx">
            <?= $vw['contents']?>
        </div>
        <div class="views-content-action text-right">
            <a href="javascript:void(0);" class="likes-btn btn btn-lg btn-primary" onclick="onLike();">
                <i class="fa fa-thumbs-o-up"></i>
				<span id="vi-likes-count">
	                <?=$this->Main_m->getLike( $vw['idx'] )->num_rows()?>
				</span>
            </a>
        </div>
    </div>
    <hr>
    <? if ( $vw['writer'] == $this->session->sess_idx ) : ?>
    <div class="view-actions margin-bottom-30 text-right">
        <a href="javascript:void(0);" class="btn btn-danger" onclick="listDelete();" title="글 삭제">
            <i class="fa fa-trash"></i>
        </a>
        <a href="/main/getUpdate/<?=$this->uri->segment(4)?>" class="btn btn-info modify" title="글 수정">
            <i class="fa fa-wrench" aria-hidden="true"></i>
        </a>
    </div>
    <? endif; ?>
	<div class="re_tx_write clearfix">
		<?=form_open('/ajax/setComment/' . $vw['idx'],array('id' => 'form_co','class' => 'full-height'))?>
		<input type="hidden" class="writer" id="tx_writer" name="writer" value="<?=$this->session->sess_idx?>" placeholder="글쓴이"/>
        <div class="col-md-12 padding-0 margin-bottom-10">
            <textarea rows="4" placeholder="댓글을 입력 해주세요." name="contents" id="tx_co" class="form-control"></textarea>
        </div>
        <div class="actions text-right">
			<button type="reset" class="btn btn-default">취소</button>	
            <button type="button" class="btn btn-primary" href="javascript:void(0);" onclick="commnetInsert();">작성</button>
        </div>
		<?=form_close()?>
	</div>
    <hr>
    <div class="views-comment row" id="vw-comment-container">
		<!-- 커스텀 시작 -->
		<div class="col-md-12 clearfix bg-gray">
			<div class="comments">
				<div class="re_head">
					댓글&nbsp;·&nbsp;<?=$co->num_rows()?>&nbsp;개
				</div>
				<? foreach( $co_limit->result_array() as $v ) { ?>
				<div class="re_contents">
					<p class="re_info text-muted margin-bottom-10">
						<? ($v['nick'] == '') ? print($v['name']) : print($v['nick']); ?>
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<?=$v['regist']?>
					</p>
					<div class="re_tx margin-bottom-10">
						<?=$v['contents']?>
					</div>
					<div class="re_tx_date margin-bottom-10">
						<span class="re_tx_value">
							
						</span>
					</div>
					<?
						$re = $this->Main_m->getRe($v['idx']);
					?>
					<a href="javascript:void(0);" id="re_opener" class="re_btn margin-bottom-10 btn btn-default btn-sm" onclick="re_open(this);">
						답글 <?=$re->num_rows()?> 			
					</a>
					<div id="re_step_comment_container_full" class="well">
						<div class="re_step_comment" id="re_step_comment_container">
							<div class="re_tx_area clearfix margin-bottom-10">
								<?=form_open('/ajax/setRe/' . $v['idx'],array('id' => 're_tx_form'))?>
									<textarea name="re_contents" rows="4" class="form-control margin-bottom-10" id="re_contents_tx"></textarea>
									<div class="submit-btn">
										<a type="button" class="btn btn-sm btn-default" href="javascript:void(0);" onclick="commentReInsert();">작성</a>
									</div>
								<?=form_close()?>
							</div>
							<hr>
							<!-- loop -->
							<? foreach( $re->result_array() as $r) { ?>					
							<div class="re_step_container clearfix">						
								<span class="step_name"><i class="fa fa-share fa-flip-vertical"></i><?( $r['nick'] == '' ) ? print($r['name']) : print($r['nick']); ?></span>
								<span class="step_time"><?=$r['regist']?></span>
								<p class="re_step_tx"><?=$r['contents']?></p>
							</div>
							<hr>
							<? } ?>
							<!-- loop end -->
						</div>
					</div>
				</div>
				<hr>
				<? } ?>			
			</div><!-- comments box end -->
		</div>
		<!-- 커스텀 끝 -->        
    </div><!-- view end -->
	<div class="pagenation text-center">
		<ul class="pagenation-ul pagination">		
		<? for ($i = $co_paging['coStart_page']; $i <= $co_paging['coEnd_page']; $i++ ) { ?>
			<li class="<? if( $co_paging['coPage'] == $i ) echo 'active';?>"><a href="/main/views/hobby/<?=$this->uri->segment(4)?>?coPage=<?=$i?>"><?=$i?></a></li>
		<? } ?>		
		</ul>
	</div>
</div>
<input type="hidden" name="vw_idx" id="vw_idx" value="<?=$vw['idx']?>">
<input type="hidden" id="is_login" value="<?=$this->session->is_login?>">

<div class="lists_wrap">
    <ol class="breadcrumb">
        <li class="active"><? print_r($pageName);?></li>
    </ol>
	<?
	foreach ( $lt->result_array() as $v ) {	
		preg_match_all('/img src=\"(.[^"]+)"/i', $v['contents'], $src_location);
		$src = in_array( 0, $src_location[1] );
		?>	
	<hr />
	<a href="/main/views/<?=$this->uri->segment(3)?>/<?=$v['idx']?>" class="clearfix list-media-inner-wrap">
		<div class="media">
			<? if ( $src ) { ?>
			<div class="media-left" id="image-con">
				<img src="<?=$src_location[1][0]?>" alt="" class="media-image">
			</div>
			<? } ?>
			<div class="media-body">
				<h4 class="media-heading">
					<?=$v['subject']?>
					<div class="media-info pull-right">
						<span class="help-inline"><?=$v['regist']?></span>
						<span class="help-inline"><?=$v['nick']?></span>
						<span class="help-inline"><i class="fa fa-eye"></i><?=$v['views']?></span>
					</div>
				</h4>
			</div>
		</div>
	</a>
	<? } ?>
	<hr />
</div>
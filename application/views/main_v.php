<div class="main-box row margin-bottom-30">
    <div class="col-md-12">
        <!-- 배너 이미지 또는 텍스트-->
        <h2>뉴스토리 블로그에 오신것을 환영합니다.</h2>
    </div>
</div>

<div class="row main_grid">
    <!-- data loop start -->
    <?
    foreach ($lt as $v) {
        $is_image = strpos($v['contents'], $strpos);
        ?>
        <div class="col-md-12 grid-item">
            <a href="/main/views<?= $v['path'] ?>/<?= $v['idx'] ?>" class="thumbnail">
                <div class="caption">
                    <h3><?= $v['subject'] ?></h3>
                </div>
                <?
                //이미지가 있을때
                if ($is_image) {
                    preg_match_all('/src=\"(.[^"]+)"/i', $v['contents'], $src_location);
                    ?>
                <img src="<?= $src_location[1][0] ?>">
                <? } ?>
                <div class="caption padding-top-0">
                    <? 
                    //이미지가 존재하지 않을때
                    if (!$is_image) {
                        $tx = $v['contents'];
                        //if ( ! strpos($tx,'<code') ) { $tx = strip_tags( $tx ); }
                        //if ( strlen($tx) > 300 ) { $tx = kstring($tx,298); }
                    ?>
                        <div class="main-prev-container">
                        <?= $tx ?>
                        </div>
                    <? } ?>
                    <p class="text-primary">
                        <?= $v['nick'] ?> 님
                    </p>
                    <p class="text-muted clearfix">
				<span class="help-inline pull-left">
					<?= $v['name'] ?>
				</span>
                        <span class="help-inline pull-right">
					<i class="fa fa-comment-o"></i>
                            <?
                            /**
                             * 컨트롤러에서 쿼리를 생성 할 방법이 도저히 생각나지 안아 뷰에다 만듬
                             */
                            $sql = "SELECT idx FROM nb_comment WHERE pid = {$v['idx']}";
                            $query = $this->db->query($sql);
                            print_r($query->num_rows());
                            ?>
				</span>
                        <span class="help-inline pull-right">
					<i class="fa fa-heart-o"></i>
                            <?= $this->Main_m->getLike($v['idx'])->num_rows() ?>
				</span>
                    </p>
                </div>
            </a>
        </div>
    <? } ?>
</div>
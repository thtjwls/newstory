<div class="views-container col-md-12">
	<ol class="breadcrumb">
		<li class="active">글쓰기</li>
	</ol>
	<?=form_open_multipart('/ajax/update/'.$this->uri->segment(3),array('id' => 'upload_form'))?>
	<div class="form-group clearfix">
		<select name="nb_category" id="nb_category" class="form-control pull-left">
			<option value="NULL">선택</option>
			<? foreach($menu as $v) { if ($v['idx'] == 100000) continue; ?>
			<option value="<?=$v['idx']?>" <? if ($v['idx'] == $vw['FK_category']) echo 'selected';?>><?=$v['name']?></option>
			<? } ?>
		</select>		
		<input type="text" id="wr_subject" name="subject" value="<?=$vw['subject']?>" class="no-round form-control pull-right" placeholder="제목을 입력하세요."/>
	</div>
	<div class="form-group">
		<textarea name="ck_tx" id="ck_write" class="ck_write"><?=htmlspecialchars($vw['contents'])?></textarea>
	</div>
	<div class="form-group-last text-right">
		<button class="btn btn-primary" type="button" onclick="ckLoad();">작성</button>
	</div>
	<?=form_close()?>
</div>
<script type="text/javascript" src="/lib/ckeditor/ckeditor.js"></script>
<script>
	var token = $("input[name=ci_token_newvid]").val();


	CKEDITOR.replace('ck_write',{
		allowedContent:true,
		filebrowserUploadUrl : '/ajax/upload_receive',
		customConfig : '/lib/ckeditor/config.js',
		width: '100%',
		height: 700
	});

	CKEDITOR.on('dialogDefinition', function (ev) {
		var dialogName = ev.data.name;
		var dialog = ev.data.definition.dialog;
		var dialogDefinition = ev.data.definition;
		if (dialogName == 'image') {
			dialog.on('show', function (obj) {
				this.selectPage('Upload'); //업로드텝으로 시작
			});
			dialogDefinition.removeContents('advanced'); // 자세히탭 제거
			dialogDefinition.removeContents('Link'); // 링크탭 제거
		}
	});
		

	var ckLoad = function () {
		var ck_data = CKEDITOR.instances.ck_write.getData();
		var subject = $("#wr_subject").val();
		var cate = $("#nb_category").val();


		if ( cate == "NULL" ) {
			swal("","카테고리를 선택 해주세요..!","warning"); return;			
		}

		if ( subject == "" ) {
			swal("","제목을 입력 해주세요..!","warning"); return;
		}

		if ( ck_data == "" ) {
			swal("","본문내용을 입력 해주세요..!","warning"); return;
		}
		
		$("#upload_form").submit();
				
	}
	
</script>
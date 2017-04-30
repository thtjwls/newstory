/* 초기값 */
var token = $.cookie('ci_cookie_newvid');

//모바일 패널 open,hide 액션
var panel = function ()
{
	var panelDisplay = false;

	return function () {
		if ( panelDisplay === false )
		{
			$('.m-panel-wrap').addClass('open');
		} else {
		
			$('.m-panel-wrap').removeClass('open');
		}
		panelDisplay = !panelDisplay
	}
}()

//panel 바깥쪽 터치시 panel() 함수 트리거
$(function () {
	$('.m-panel-wrap').on('click touchstart',function (e) {
		var panelClass	= 'm-panel-wrap',
			spilt		= e.target.className.split(' ');

		if ( spilt.indexOf(panelClass) == 0 )
		{
			panel();
		}

	})
});

// .help-block 엘리먼트 컨트롤
$.fn.extend({
	helpText : function (text , status) {
		if ( status === false )
		{
			this.next('.help-block').addClass('text-danger');
			this.next('.help-block').removeClass('hide text-success');
			this.next('.help-block').text(text);
			this.focus();
		} else if ( status === true )
		{
			this.next('.help-block').addClass('text-success');
			this.next('.help-block').removeClass('hide text-danger');
			this.next('.help-block').text(text);
		} else if ( status == null )
		{
			this.next('.help-block').addClass('hide');
		}
	}
})

//아이디 체크
function membership_id_check(ele)
{
	//영문+숫자만 정규식
	var regType = /^[A-Za-z0-9+]*$/;

	var id = $(ele).val();


	if ( regType.test(id) == false )
	{
		$(ele).helpText('아이디에 한글 또는 특수문자 는 들어갈 수 없습니다.',false);
		$('#id_chk').val('false');
	} else if ( id.length < 4 ) {
		$(ele).helpText('아이디는 4글자 이상 입력 해주세요.',false);
		$('#id_chk').val('false');
	} else {
		/* ajax */
		var ajaxDataLoadingUrl = '/users/membership/idCheck';
		$.ajax({
			url : ajaxDataLoadingUrl,
			type : 'POST',
			data : {ci_token_newvid : token , id : id},
			success : function (data) {
				if ( data >= 1 )
				{
					$(ele).helpText(id + '는 사용 할 수 없는 아이디 입니다.',false);
					$('#id_chk').val('false');
				} else {
					$(ele).helpText('사용 가능 한 아이디 입니다.',true);
					$('#id_chk').val('true');
				}
			}
		})
	}	
}

/* 비밀번호 체크 */
function membership_pass_check(ele)
{
	/*
		1. 10자 이상
		2. 특수문자+영문+대문자 포함
	*/
	
	var reg = /^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{6,20}$/,
		dataValue = $(ele).val();
	
	if ( reg.test(dataValue) === false )
	{
		$(ele).helpText('비밀번호는 6~20자 특수문자 숫자를 포함해야 합니다.' , false);
		$('#pass_chk').val('false');
	} else {
		$(ele).helpText('' , null);
		$('#pass_chk').val('true');
	}	
}

/* 비밀번호 확인 체크 */
function membership_pass_confirm_check(ele,target)
{
	var targetValue = $('#' + target).val(),
		dataValue = $(ele).val();

	if ( targetValue != dataValue )
	{
		$(ele).helpText('비밀번호가 다릅니다.' , false);
		$('#pass_confirm_chk').val('false');
	} else {
		$(ele).helpText('' , false);
		$('#pass_confirm_chk').val('true');
	}
}

//최종 유저 추가
function membership_submit()
{
	if ( $("#newvid_membership_form input[name=name]").val() == "" ) {
		swal("이름을 입력 해주세요.");
	} else if ( $("#id_chk").val() == 'false' ) {
		swal("아이디를 확인 해 주세요..");
	} else if ($("#pass_chk").val() != "true" || $("#pass_confirm_chk") == "true") {
		swal("비밀번호를 확인 해주세요.");
	} else {
		var submitUrl = "/users/membership/add";

		$("#newvid_membership_form").attr("action",submitUrl);
        $("#newvid_membership_form").submit();

/*
		$.ajax({
			url : submitUrl,
			type:"POST",
			data :{$("#newvid_membership_form").serialize()},
			success : function (data) {
				console.log(data);
			}
		})
		*/
	}

}
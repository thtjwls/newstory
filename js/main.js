$(function () {
	$('.login-form input').on('keypress',function (e) {
		console.log(e.keyCode);
		if ( e.keyCode == 13 )
		{
			login();
		}
	});
})
	

function login()
{
	var id = $("#id"),
		password = $("#password"),
		token = $("input[name=ci_token_newvid]");

	if ( id.val() == "" ) {
		swal("","아이디를 입력 해주세요.","warning");

		return;
	   
	}

	if ( password.val() == "" ) {
		swal("","비밀번호를 입력 해주세요.","warning");            

		return;
	}


	$.ajax({
		url : "/members/loginGo",
		type : "post",
		data : {id : id.val(), password : password.val(), ci_token_newvid : token.val()},
		success : function (data) {
			try {
				var rData = Number(data);

				if ( rData == 3) {
					swal("","아이디가 존재하지 않습니다.","warning");
				} else if ( rData == 2) {
					swal("","비밀번호가 다릅니다.","warning");
				} else {
					window.location.reload(0);
				}
			} catch (e) { console.log(e); }
		}
	})
}

function logout() {
    swal({
            title: '',
            text: "정말 로그아웃 하시겠어요? ㅠㅠ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '응 나갈래',
            closeOnConfirm: false
        },
        function(){
            var httpRequest;
            if ( window.XMLHttpRequest ) {
                httpRequest = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }

            httpRequest.onreadystatechange = function() {
                if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                    swal(
                        '',
                        '성공적으로 로그아웃 되었습니다.',
                        'success'
                    );

                    setTimeout(function() {
                        window.location.reload(0);
                    },1300)

                    return;
                }

                if (httpRequest.readyState == 4 && httpRequest.status == 500) {
                    swal("처리중 심각한 위험이 도사렸습니다.","지금 당장 관리자에게 전화하세요!!<br>그는 매우 슬퍼 할 것입니다.(errcode : 500)","error");

                    return false;
                }
            }
            httpRequest.open("GET", "/members/logout", true);
            httpRequest.send();
        });
}

function re_open(ele) {		
	
	var cl = $(ele).hasClass('open');

	( cl == false ) ? $(ele).addClass('open') : $(ele).removeClass('open');
}

function write_re_check() {
	var tx_writer, tx_co;
	tx_writer	= $("#tx_writer");
	tx_co		= $("#tx_co");

	if ( tx_writer.val() == "" )
	{
		swal("","작성자를 입력 해주세요.","warning");
		
		return;
	}

	if ( tx_co.val() == "" )
	{ 
		swal("","내용을 입력 해주세요","warning");

		return;
	}
}

/**
 * 뷰에서 실행되는 함수들
 */
//좋아요
function onLike()
{
    var idx = $("#vw_idx").val();
    var lo = window.location.pathname;
	var like_area = $("#vi-likes-count");

    $.ajax({
        url : "/Ajax/putLike/" + idx,
        type : "GET",
        success : function (data) {
            if ( data != true )
            {
                swal("",data,"warning");
            } else {
                swal("","이글을 좋아합니다.","success");
                like_area.html(data);
            }
        }
    })

}

//댓글
function commnetInsert()
{
    var name, tx, is_login;
    name = $("#writer");
    tx = $("#tx_co");
    is_login = $("#is_login").val();
    submitPath = $("#form_co").attr('action');

    var lo = window.location.pathname;

    if ( is_login != true )
    {
        swal("","로그인 후 이용 해 주세요.","warning");
        return;
    }

    if ( name.val() == "" )
    {
        swal("","글쓴이를 입력 해 주세요.","warning");

        return;
    }

    if ( tx.val() == "" )
    {
        swal("","내용을 입력 해 주세요.","warning");
        return;
    }

    $.ajax({
        url : submitPath,
        type : "POST",
        data : $("#form_co").serialize(),
        success : function (data) {
            if (data == true)
            {
                swal("","댓글이 등록되었습니다.","success");
                $("#vw-comment-container").load(lo + " #vw-comment-container");
            } else {
                swal("",data,"error");
            }
        }
    })
}

//답글
function commentReInsert()
{
    var lo = window.location.pathname;

    var contents,is_login,container;
    is_login = $("#is_login");
    contents = $("#re_contents_tx");
    submitUrl = $("#re_tx_form").attr("action");
    container = $("#re_step_comment_container");

    if ( is_login.val() != true ) {
        swal("","로그인 후 이용 해 주세요.","warning");
        return;
    }

    if ( contents.val() == "" )
    {
        swal("","내용을 입력 해 주세요.","warning");
        return;
    }

    $.ajax({
        url : submitUrl,
        type : "POST",
        data : $("#re_tx_form").serialize(),
        success : function (data) {
            if ( data == true ) {
                swal("","등록되었습니다.","success");

                setTimeout(function () {
                    window.location.reload(0);
                },1300)
            } else {
                swal("","등록에 실패하였습니다. 잠시 후 다시 시도해주세요.","error");
                return false;
            }
        }
    })
}

function listDelete()
{
	var idx = $("#vw_idx").val();
	var dataUrl = "/ajax/viewDel/" + idx;

    swal({
        title: "정말 삭제하시겠어요?",
        text: "삭제 한 데이터는 복구 할 수 없습니다.",
        type: "warning",
        showCancelButton: true,
        cancelButtonText : "아니요",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "네 삭제할께요",
        closeOnConfirm: false
    },

    function(){
		$.ajax({
			url : dataUrl,
			type : "get",
			data : {idx : idx},
			success : function (data) {
				console.log(data);
				if ( data == true )
				{
					swal("", "게시물이 삭제되었습니다.", "success");

					setTimeout(function () {
						window.location.href = '/';
					},1300)
					
				} else {
					swal("","게시물 삭제에 실패하였습니다. 잠시 후 다시 시도해주세요.","error");
				}
			}
		})        
    });
}

/**
 * 뷰에서 실행되는 함수들 끝
 */
/* IE 에서 작동이 멈추는 버그가 생김 */
/*
function logout2() {
    swal({
        title: '',
        text: "정말 로그아웃 하시겠어요? ㅠㅠ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '응 나갈래'
    }).then(function () {

        var httpRequest;
        if ( window.XMLHttpRequest ) {
            httpRequest = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }

        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                swal(
                    '',
                    '성공적으로 로그아웃 되었습니다.',
                    'success'
                );

                setTimeout(function() {
                    window.location.reload(0);
                },1300)

                return;
            }

            if (httpRequest.readyState == 4 && httpRequest.status == 500) {
                swal("처리중 심각한 위험이 도사렸습니다.","지금 당장 관리자에게 전화하세요!!<br>그는 매우 슬퍼 할 것입니다.(errcode : 500)","error");

                return false;
            }
        }
        httpRequest.open("GET", "/members/logout", true);
        httpRequest.send();
    });
} */

/**
 * 상단 배너 close 토글
 *
 */
$(function () {

	$("#banner-close-btn-toggle").on("click",function () {		
		$(this).parent(".top-banner").addClass("close");
	
		$.cookie('top_banner' , false, {
			expires : 1,
			domain : 'newvid.co.kr'
		});
	});
})

function mPanelOpener()
{
    var aside = $(".aside-panel-wrap");
    var controller = aside.css("opacity");
    var opennerClass = "open";

    (controller == 0) ? aside.addClass(opennerClass) : aside.removeClass(opennerClass);	
		
}

function openChatService()
{
    var popUrl = "/chat";
    var popOption = "width=500, height=650, resizable=no, status=no;, left=20, top=20,menubar=no,toolber=no,location=no,directores=no,status=no";
    window.open(popUrl,"",popOption);

}

//채팅 프레임 활성/비활성
function _chatFrameOpenner()
{
	var title = 'N-chat';
	//컨테이터 속성 지정
	var oW = 330;
	var oH = 580;
	var option = 'fullscreen=no, location=no, menubar=no, resizable=no, scrollbars=no, titlebar=no, toolbar=no, width='+ oW +', height=' + oH;
	
	//타겟 url 지정
	var _chatURL = '//me.newvid.co.kr:3000?id=test';

	window.open(_chatURL, title, option);	
	
}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <p>주의 ! 관리자 외 이 페이지에서 어떠한 행위도 하지마십시오. 이곳에서는 해당서버의 무한한 경고를 일으킬 수도 있습니다.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-block btn-primary" href="javascript:void(0);" onclick="ajaxTableInit(0);">CI_TABLE 생성</a>
            <a class="btn btn-block btn-primary" href="javascript:void(0);" onclick="ajaxTableInit();">ci_table</a>
            <a class="btn btn-block btn-primary" href="javascript:void(0);" onclick="ajaxTableInit();">ci_table</a>
            <a class="btn btn-block btn-primary" href="javascript:void(0);" onclick="ajaxTableInit();">ci_table</a>
            <a class="btn btn-block btn-primary" href="javascript:void(0);" onclick="ajaxTableInit();">ci_table</a>
        </div>
        <div class="col-md-4">
            <div class="page-header">
                <h2>상태</h2>
            </div>
            <div id="status"></div>
        </div>
        <div class="col-md-5">
            <div class="page-header">
                <h2>결과</h2>
            </div>
            <div id="result"></div>
        </div>
    </div>
    <input type="hidden" id="test" name="test">
</div>

<script>
    function ajaxTableInit(queryNumber)
    {
        var token = $.cookie('ci_cookie_newvid');
        var testData = $("#test").val();
        var querySetUrl = null;
        var data = {
            ci_token_newvid:token,
            tData : testData
        };

        switch (queryNumber)
        {
            case 0 :

                querySetUrl = "/admin/setup/ci_sessionTable";
                break;
            case 1 :
                alert(queryNumber);
                break;
            default :
                alert(queryNumber);
        }

        if ( querySetUrl != null )
        {
            $.ajax({
                url:querySetUrl,
                type:"post",
                data:data,
                beforeSend: function () {
                    stringFormat('info','데이터 처리중...',$('#status'));
                },
                success: function (data) {
                    if ( data == true ) {
                        stringFormat('success','데이터가 성공적으로 처리 되었습니다.',$('#result'));
                    } else {
                        stringFormat('danger','데이터 처리에 실패하였습니다.' + data,$('#result'));
                    }
                },
                complete : function (data) {
                    stringFormat('success','Complete',$('#status'));
                },
                error : function (request, status, error) {
                    var str = '통신에 오류가 있습니다.' + request + status + error
                    stringFormat('danger',str,$('#result'));
                }
            });
        } else {
            return false;
        }




        function stringFormat(status,string,container)
        {
            var str = "<div class='alert alert-" + status + " role='alert'>";
            str += "<p>" + string +"</p>";
            str += "</div>";

            if ( container == $('#result'))
            {
                $(str).appendTo(container);
            } else {
                container.html(str);
            }
        }
    }
</script>
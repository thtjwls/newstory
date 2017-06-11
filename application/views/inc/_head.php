<!doctype html>
<html lang="ko">
<head>	
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?=$this->meta['title']?>">
	<meta property="og:description" content="<?=$this->meta['description']?>">
	<meta property="og:image" content="http://blog.newvid.co.kr/images/ci_img/logo_ci_main.jpg">
	<meta property="og:url" content="http://<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
	<meta name="description" content="<?=$this->meta['description']?>">
	<link rel="canonical" href="http://<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->meta['title']?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="/lib/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="/lib/assets/global/plugins/jquery-ui/jquery-ui.min.css">
    <!-- bootstrap -->
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="/css/components.css">-->
	<link rel="stylesheet" href="/lib/assets/global/css/components-md.min.css">
    <link rel="stylesheet" href="/css/layout.css">

    <!-- bootstrap end -->
    <link href="https://koriel.co/fonts/kopub/1.0/kopubbatang.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/lib/sweetalert/sweetalert.css">
    <script src="/lib/sweetalert/sweetalert.min.js"></script>
    <!--<link rel="stylesheet" href="/css/main.css?v=<?=date('YmdHis')?>">-->
    <!--<link rel="stylesheet" href="/css/mobile.css?v=<?=date('YmdHis')?>">-->
	<script type="text/javascript" src="/lib/ckeditor/ckeditor.js"></script>
    <script src="/js/main.js?v=<?=date('YmdHis')?>"></script>    	
	<script type="text/javascript" src="/lib/jquery.cookie.js"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- highlight -->
	<link rel="stylesheet" href="/lib/highlight/styles/dracula.css" />
	<script type="text/javascript" src="/lib/highlight/highlight.pack.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-9678563544294393",
		enable_page_level_ads: true
	  });
	</script>
    <!-- 임시 반응형 해제 -->
    <!--<link rel="stylesheet" href="/css/no-responsive.css">-->
	<link rel="stylesheet" href="/css/style.css?v=<?=date('YmdHid')?>">
	<link rel="shortcut icon" href="/images/favicon.ico">
</head>
<body>
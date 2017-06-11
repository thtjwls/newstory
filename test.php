<!DOCTYPE HTML>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<?
$str = '<br>안녕하세요<p>반갑습니다.</p>';

$replace = array(
        '<br>', '<p>', '</p>', '<code>', '</code>', '<pre>', '</pre>'
    );

    $string = $str;

    for ($i = 0; $i < count($replace); $i++) {
        $string = str_replace($replace[$i], ' ', $string);

        echo 'string : '. $string . '<hr>';
    }



//echo htmloutput($str);
?>
</body>
</html>
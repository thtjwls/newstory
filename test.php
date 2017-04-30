<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost','root','autoset','test');
if ( mysqli_connect_error() ) {
    exit('Connect Error ('. mysqli_connect_errno(). ') '.mysqli_connect_error());
}



/**
 * @return string
 * 하단에는 베이스 쿼리문
 */

function inserted() {
    $date = date('Y-m-d H:i:s');

    $query = "
        INSERT INTO testtable (Id,Regist_day) VALUES ('thtjwls','{$date}');
        INSERT INTO testtable (Id,Regist_day) VALUES ('newvid','{$date}');
        INSERT INTO testtable (Id,Regist_day) VALUES ('dayekim','{$date}');
        INSERT INTO testtable (Id,Regist_day) VALUES ('jihoon','{$date}');
        INSERT INTO testtable (Id,Regist_day) VALUES ('dev','{$date}');
    ";

    return $query;
}

function inserted2() {
    $date = date('Y-m-d H:i:s');
    
    $query = "
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (1,'첫번째 아이디의 글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (1,'첫번째 아이디의 2번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (1,'첫번째 아이디의 3번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (1,'첫번째 아이디의 4번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (2,'2번째 아이디의 1번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (2,'2번째 아이디의 2번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (2,'2번째 아이디의 3번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (3,'3번째 아이디의 1번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (3,'3번째 아이디의 2번글','{$date}');
        INSERT INTO test2Table (Fk_id,Contents,Regist_day) VALUE (4,'4번째 아이디의 1번글','{$date}');
    ";

    return $query;
}

function createTable() {
    $query[1] = "
    CREATE TABLE testTable(
      Idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      Id VARCHAR(10) NOT NULL UNIQUE KEY,
      Regist_day DATETIME NOT NULL
    )ENGINE=InnoDB DEFAULT CHAR SET = UTF8; 
    ";

    $query[2] = "
    CREATE TABLE test2Table(
      Idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      Fk_id INT NOT NULL,
      Contents TEXT NOT NULL,
      Regist_day DATETIME NOT NULL,
      FOREIGN KEY (`Fk_id`) REFERENCES `testTable` (`Idx`)
    )ENGINE=InnoDB DEFAULT CHAR SET = UTF8;
    ";

    return $query;
}
?>

<?php
$query = 'SELECT * FROM testtable left JOIN test2Table on testtable.Idx = test2Table.Fk_id';
$result = $mysqli->query($query);
?>

<table cellpadding="0" cellspacing="0" border="1">

</table>

</body>
</html>
<?php

header("content-type:text/html; charset=UTF-8");
include("../lib/db_connect.php");
$connect = dbconn();

$id = $_POST["id"];
$user_id = $_POST["user_id"];
$pws = $_POST["pw"];
$nick_name = $_POST["nick_name"];
$name = $_POST["name"];
$email = $_POST["email"];

if (!preg_match("/^(?=.*[a-z])(?=.*[0-9])(?=.*[@#|'<>.^*()%!-])[0-9A-Za-z$&+,:;=?@#|'<>.^*()%!-]{7,16}$/", $pws)) {
    Error("최소 1개의 소문자, 숫자, 특수문자를 포함한 8-16자리 비밀번호를 입력하세요");
}

if (strlen($name) < 6 or strlen($name) > 15) Error("이름은 2자에서 5자까지 허용합니다"); //한글은 1자당 3byte

$pw = md5($pws); // 비밀번호 암호화

$regdate = date("YmdHis", time()); // 날짜 시간
$ip = getenv("REMOTE_ADDR"); // ip

$query = "insert into member2(id, user_id, pw, nick_name, name, email, regdate, ip) values ('$id', '$user_id', '$pw', '$nick_name', '$name', '$email', '$regdate', '$ip')";
mysql_query("set names utf8", $connect);
mysql_query($query, $connect);
mysql_close($connect);

?>

<script>
    window.alert("회원가입이 완료 되었습니다");
    location.href = '../index.php';
</script>
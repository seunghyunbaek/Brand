<?php
ob_start();
header("content-type:text/html; charset=UTF-8"); 
// ob_start : 출력 버퍼링 함수, 출력문을 임시버퍼에 저장했다 헤더 쿠키 세션 함수진행이 끝나면 템프로 저장해둔 출력문을 출력합니다. 출력문이 있는 상단에 ob_start를 사용하면 충돌을 막을 수 있다
include("../lib/db_connect.php");
$connect = dbconn();

$user_id = $_POST['user_id'];
$pws = $_POST['pw'];

$pw = md5($pws);

// 나의 정보 데이터 가지고 오기!
$query = "select * from member2 where user_id='$user_id'";

mysql_query("set names utf8", $connect);
$result = mysql_query($query, $connect);
$member = mysql_fetch_array($result);

if(!$user_id) Error("아이디를 입력하세요");
elseif(!$member['user_id']) Error("존재하지 않는 회원 아이디입니다");


if(!$pw) Error("비밀번호를 입력하세요");
elseif($member['pw']!=$pw) Error("비밀번호가 같지 않습니다");

if($member['user_id'] and $member['pw']==$pw) {
    $tmp=$member['user_id']."//".$member['pw'];
    setcookie("COOKIES", $tmp, time()+60*60, "/"); // time은 초단위로 설정가능 60초*2 = 2분 동안 유효
}
?>

<script>
    location.href = "../index.php"
</script>
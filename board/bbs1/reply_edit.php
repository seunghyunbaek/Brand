<?php
header("content-type:text/html; charset=UTF-8");

$user_id = $_SESSEION['user_id'];

$id = $_POST['id'];
$bbs1_no = $_POST['bbs1_no']; //게시글 번호
$replys = $_POST['replys'];   // 코멘트 달글 번호
$memo = $_POST['memo']; //코멘트 내용

include('../../lib/db_connect.php');
$connect = dbconn(); //DB컨넥트
$member = member(); //회원정보

if (!$member[user_id]) Error('로그인 후 이용하세요');
if (!$memo) Error('내용을 입력 하세요');
if (!$bbs1_no) Error('접근이 잘못되었습니다');

$regdate = date("YmdHis", time()); //날짜/시간

$query="update bbs1_comment set memo='$memo' where bbs1_no='$bbs1_no' and id='$id' and no='$replys'";

if(!$result = mysql_query($query, $connect)) {
    echo "Errno: " . $connect->errno . "\n";
    echo "Error: " . $connect->error . "\n";
}

mysql_query($query, $connect);
?>

<script>
window.alert("댓글이 수정 되었습니다.");
location.href='./view.php?no=<?php echo $bbs1_no;?>&id=<?php echo $id;?>&lo_reply_1=#lo_reply_1';
</script>
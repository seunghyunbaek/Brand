<?php
header("content-type:text/html; charset=UTF-8");

include("../../lib/db_connect.php");
$connect = dbconn(); // DB컨넥트
$member = member(); // 회원정보


if (!$member['user_id']) Error("로그인 후 이용해주세요.");

$id = $_POST["id"]; // 게시판 ID
$bbs1_no = $_POST["bbs1_no"]; // 게시판 No

$up = $_POST["up"]; // up
$down = $_POST["down"]; // up

// 좋아요는 좋아요대로 추가 삭제
if ($up == 1) { // 좋아요 누름

    $query = "select * from bbs1_up where id='$id' and bbs1_no='$bbs1_no' and user_id='$member[user_id]'";
    $result = mysql_query($query, $connect);
    $data = mysql_fetch_array($result);

    if ($data[up] == 1) {
        // 좋아요 누른적 있음
        // 좋아요 취소하기 
        $query = "delete from bbs1_up where bbs1_no='$bbs1_no' and id='$id' and user_id='$member[user_id]'";
        $result = mysql_query($query, $connect);
    } else {
        // 좋아요 누른적 없음
        // 좋아요로 바꾸기
        $query = "insert into bbs1_up(id, bbs1_no, user_id, up) values('$id', '$bbs1_no', '$member[user_id]', '$up')";
        $result = mysql_query($query, $connect);
    }
}

if ($down == 1) { // 싫어요 누름

    $query = "select * from bbs1_down where id='$id' and bbs1_no='$bbs1_no' and user_id='$member[user_id]'";
    $result = mysql_query($query, $connect);
    $data = mysql_fetch_array($result);

    if ($data[down] == 1) {
        // 싫어요 누른적 있음
        $query = "delete from bbs1_down where bbs1_no='$bbs1_no' and id='$id' and user_id='$member[user_id]'";
        $result = mysql_query($query, $connect);
    } else {
        // 싫어요 누른적 없음
        $query = "insert into bbs1_down(id, bbs1_no, user_id, down) values('$id', '$bbs1_no', '$member[user_id]', '$down')";
        $result = mysql_query($query, $connect);
    }
}
?>

<script>
    location.href = './view.php?no=<?php echo $bbs1_no; ?>&id=<?php echo $id; ?>#updown';
</script>
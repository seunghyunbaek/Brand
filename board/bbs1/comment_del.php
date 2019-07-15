<?php
header("content-type:text/html; charset=UTF-8");

$user_id = $_SESSION['user_id'];

$no_s = $_GET['no_s']; //게시글 번호(1)
$bbs1_no = $_GET['bbs1_no']; // 게시글 번호(2)

$d_no = $_GET['d_no']; // 코멘트 순번
$replys = $_GET['replys']; // 코멘트 답글번호
$replys_all = $_GET['replys_all']; // 코멘트 삭제
$reply_rr = $_GET['reply_rr']; // 코멘트의 답글 삭제

$id = $_GET['id']; // 게시판 아이디

include("../../lib/db_connect.php");
$connect = dbconn(); // DB커넥트
$member = member(); // 회원정보


$query = "select * from bbs1_comment where user_id='$member[user_id]' and no='$d_no'";
$result = mysql_query($query, $connect);
$data = mysql_fetch_array($result);

if ($member['level'] != 1) {
    if ($member['user_id'] != $data['user_id']) {
        Error("자신의 글만 삭제 가능합니다.");
    }
}

if (!$no_s) Error("해당 게시물이 없습니다");

// 현재의 문제점 comment-1 이 반영이 안됨 그래서 comment의 개수를 직접 값으로 넣어줄 생각
// 답글의 총 개수 구하기
$q_count = "select count(*) from bbs1_comment where bbs1_no='$bbs1_no' and replys='$d_no' and id='$id'";
// $q_count = "select count(*) from bbs1_comment where bbs1_no='$bbs1_no' and id='$id'";
$r_count = mysql_query($q_count, $connect);
$count = mysql_fetch_array($r_count);
$total_comment = $count[0] + 1; // 현재 게시글의 답글 개수

// 코멘트와 답글 삭제 루틴
if ($replys_all == 'all') { // 코멘트와 답글 삭제하기
    // 댓글 삭제하기
    $query_1 = "delete from bbs1_comment where bbs1_no='$no_s' and no='$d_no' and id='$id'";
    $result_1 = mysql_query( $query_1, $connect);

    // 답글 삭제하기
    $query_2 = "delete from bbs1_comment where bbs1_no='$no_s' and replys='$d_no' and id='$id'";
    $result_2 = mysql_query($query_2, $connect);

    // 게시판 본문에도 삭제된 코멘트와 답글이 변경되어서 삭제된만큼 빼준다
    $query = "update bbs1 set comment=comment-$total_comment where no='$bbs1_no' and id='$id'";
    $result = mysql_query($query, $connect);
}

if ($reply_rr == 'rr') { // 답글만 삭제할 경우
    $query_1 = "delete from bbs1_comment where no='$d_no' and bbs1_no='$bbs1_no' and replys='$replys' and id='$id'"; // $replys는 코멘트의 답글 번호
    $result_1 = mysql_query($query_1, $connect);

    $query = "update bbs1 set comment=comment-1 where no='$bbs1_no' and id='$id'";
    $result = mysql_query($query, $connect);
}
?>

<?php if ($id == 'bbs0') { ?>
    <script>
        window.alert("댓글이 삭제되었습니다");
        location.href = "view3.php?no=<?php echo $bbs1_no; ?>&id=<?php echo $data['id']; ?>&lo_reply_1=#lo_reply_1";
    </script>
<?php } else { ?>
    <script>
        window.alert("댓글이 삭제되었습니다");
        location.href = "view.php?no=<?php echo $bbs1_no; ?>&id=<?php echo $data['id']; ?>&lo_reply_1=#lo_reply_1";
    </script>
<?php } ?>
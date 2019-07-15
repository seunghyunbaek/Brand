<?php
header("content-type:text/html; charset=UTF-8");

include("../../lib/db_connect.php");
$connect = dbconn(); // DB컨넥트
$member = member(); // 회원정보

if (!$member['user_id']) Error("로그인 후 이용해주세요.");

$no = $_GET['no'];
$id = $_GET['id'];

// where할때 no= 여기에서 '$no' 작은따옴표 안쓰면 제대로 쿼리 실행이 안됨... 
$query = "select * from bbs1 where no='$no' and user_id='$member[user_id]'";
mysql_query("set names utf8", $connect);
$result = mysql_query($query, $connect);
$data = mysql_fetch_array($result);

if ($data['file01']) {
    $del_file = "./data/" . $data['file01'];
    if ($data['file01'] && is_file($del_file)) { // 파일이 있는지 확인하기
        unlink($del_file); // 삭제하는 함수
    }
}

// 게시글 삭제하기
if($member['level'] == 1) {
    $query = "delete from bbs1 where no='$no' and id='$id'";
} else {
    $query = "delete from bbs1 where no='$no' and id='$id' and user_id='$member[user_id]'";
}
mysql_query($query, $connect);

// 댓글 삭제하기
$query_2 = "delete from bbs1_comment where bbs1_no='$no' and id='$id' ";
mysql_query($query_2, $connect);
?>

<?php if ($id == 'bbs0') { ?>
    <script>
        window.alert("게시글이 삭제되었습니다");
        location.href = "./broad.php";
    </script>
<?php } else { ?>
    <script>
        window.alert("게시글이 삭제되었습니다");
        location.href = "./<?php echo $id; ?>.php";
    </script>
<?php } ?>
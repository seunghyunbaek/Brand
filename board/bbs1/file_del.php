
<?php 
header("content-type:text/html; charset=UTF-8");

include("../../lib/db_connect.php");
$connect = dbconn(); // DB커넥트
$member=member(); // 회원정보

if(!$member['user_id']) Error("로그인 후 이용해 주세요");
$no = $_GET['no'];

// 앞에 페이지에서 파일명과 넘버값을 파라미터로 보내도 되지만 보안성을 위해서 이렇게 처리합니다

$query = "select * from bbs1 where no='$no' and user_id='$member[user_id]'";
$result = mysql_query($query, $connect);
$data = mysql_fetch_array($result);
if(!$result) die("연결에 실패 하였습니다".mysql_error($connect));

if($data['file01']) {

    $qy = "update bbs1 set file01='' where no='$no' and user_id='$data[user_id]'";
    mysql_query($qy, $connect);

    $del_file = "./data/".$data['file01'];
    if($data['file01'] && is_file($del_file)) unlink($del_file);
}

mysql_close($connect);
?>

<script language="JavaScript">
    alert('파일이 삭제 되었습니다');
    opener.location.reload();
    window.close();
</script>
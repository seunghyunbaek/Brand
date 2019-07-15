<?php
header("content-type:text/html; charset=UTF-8");
include("../lib/db_connect.php");
$connect = dbconn();
$user_id = $_GET[user_id];
$sql = "select * from member2 where user_id='$user_id'";
$rst = mysql_query($sql, $connect);
$cnt = mysql_num_rows($rst);

?>
<script type="text/javascript">
    function useID(v) {
        opener.document.all.checkid.value = 1;
        opener.document.all.user_id.value = v;
        window.close();
    }

    function chkId() {
        var user_id = document.all.user_id.value;
        if (user_id) {
            url = "idcheck.php?user_id=" + user_id;
            location.href = url;
        } else {
            alert("ID를 입력하세요!");
        }
    }
</script>
<?php if ($cnt) { ?>
    <?php echo $user_id; ?><?php echo "는 사용하실 수 없는 ID입니다<br/>"; ?>
    <form>
        <input type=text name="user_id">
        <input type=button value="ID중복확인" onClick="chkId();">
    </form>
<?php } else { ?>
    <?php
    if (!preg_match("/^[a-z]/i", $user_id)) {
        echo "아이디의 첫글자는 영문이어야 합니다 <br>";
    }
    if (!preg_match("/^[a-z0-9_-]\w{5,15}$/", $user_id)) {
        echo "아이디는 6-16자리의 영문, 숫자, _만 사용할 수 있습니다"; ?>
        <form>
            <input type=text name="user_id">
            <input type=button value="ID중복확인" onClick="chkId();">
        </form>
    <?php } else { ?>
        <?php echo $user_id; ?>는 사용가능한 ID입니다.<br />
        <a href="#" onClick="useID('<?php echo $user_id; ?>');">사용하기</a> <a href="#" onClick="window.close();">닫기</a>
    <?php }
} ?>
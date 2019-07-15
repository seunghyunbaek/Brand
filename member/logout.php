
<?php

header("content-type:text/html; charset=utf8");
setcookie("COOKIES", "", 0, "/"); // 쿠키명 쿠키값비우기 시간설정 적용범위  => 쿠키지우기 (로그아웃하기위해)

?>

<script>
    window.alert("로그아웃 되었습니다");
    location.href="../index.php";
</script>
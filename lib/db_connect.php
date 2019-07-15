<?php

function dbconn()
{
    $mysql_hostname = "localhost";
    $mysql_username = "back947";
    $mysql_password = "tmdgus!#24";
    $mysql_database = "back947";
    $mysql_port = "3306";
    $mysql_charset = "utf8";

    // $connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
    // mysqli_query("set names utf8", $connect);
    // if (!$connect) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }

    // $connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
    // $connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, $mysql_port);
    $connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
    mysql_query("set names utf8", $connect);
    mysql_select_db($mysql_database, $connect);
    if ($connect->connect_error) {
        die("connect fail");
    }

    return $connect;
}

function Error($msg)
{
    echo "
    <script>
    window.alert('$msg');
    history.back(1);
    </script>
    ";
    exit; // 위에 에러 메세지만 띄운다.
}

function member()
{
    // function안의변수와 밖의 변수에 대입해야할 때 global사용
    global $connect;
    $temps = $_COOKIE["COOKIES"];
    // explode("구분 기준문자", "처리할 내용"); // 기준문자를 분할하는 함수
    $cookies = explode("//", $temps); // 기준문자를 분할하는 함수

    // 아이디 $cookies[0];
    // 비밀번호 $cookies[1];

    /////// 회원정보 ///////
    $query = "select * from member2 where user_id='$cookies[0]'";
    mysql_query("set names utf8", $connect);
    $result = mysql_query($query, $connect);
    $member = mysql_fetch_array($result);
    return $member;
}

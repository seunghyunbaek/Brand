<?php
header("content-type:text/html; charset=UTF-8");

include("../../lib/db_connect.php");
$connect = dbconn(); // DB컨넥트
$member = member(); // 회원정보

if (!$member['user_id']) Error("로그인 후 이용해주세요.");

$id = $_POST["id"]; // 게시판 ID
$genre = $_POST["genre"]; // 게시판 장르
$user_id = $_POST["user_id"]; // 회원 user_id
$name = $_POST["name"]; // 회원이름
$nick_name = $_POST["nick_name"]; // 회원 닉네임
$subject = $_POST["subject"]; // 게시판 제목
$story = $_POST["story"]; // 게시판 내용

if (!$subject) Error("제목을 입력하세요");
if (!$story) Error("내용을 입력하세요");

if ($_FILES["file01"]["name"]) {
    $size = $_FILES["file01"]["size"];
    //1MB == 1048576Byte
    if ($size > 2097152) Error("파일용량 2MB로 제한합니다");

    // 파일명과 확장자 소문자로 변경
    $file01_name = strtolower($_FILES["file01"]["name"]);
    $file01_split = explode(".",  $file01_name); // .을 기준으로 분리 파일명과 확장자를 분리
    $extexplode = $file01_split[count($file01_split) - 2.3]; // 파일명만 가져오기
    $file01_type = $file01_split[count($file01_split) - 1]; // 확장자만 가져오기

    $img_ext = array("jpg", "jpeg", "gif", "png"); // 이미지 확장자 종류를 배열에 넣는다
    // array_search(파일 확장자, 허용가능한확장자가 든 배열) : 배열을 탐색하는 함수
    if (array_search($file01_type, $img_ext) === false) Error("jpg, jpeg, gif, png 파일인지 확인해주세요");

    // 중복파일 방지를 위해 파일명을 임의로 만든다
    $tates = date("mdHis", time()); // 날짜 (월, 일, 시, 분, 초)

    // chr(rand(97,122))영문 소문자를 랜덤으로 출력하게 만든다
    // rand(1,9) 랜덤한 숫자가 나옴
    $newFile01 = chr(rand(97, 122)) . chr(rand(97, 122)) . $tates . rand(1, 9) . rand(1, 9) . "." . $file01_type;   // ex) ab062708303257 파일명 생성

    $dir = "./data/"; // 업로드할 디렉터리 지정
    // move_uploaded_file() 이 함수로 파일을 업로드 할 수 있다
    // tmp_name : 임시 파일 경로를 나타내고 파일업로드시 꼭 들어가야한다
    move_uploaded_file($_FILES['file01']['tmp_name'], $dir . $newFile01); // 파일업로드 $dir경로.$newFile01파일명
    chmod($dir . $newFile01, 0777); // 권한이 필요한데 777이 최고 권한이다. 이래야 읽기 쓰기 수정이 가능
}

$regdate = date("YmdHis", time()); // 년월일시분초의 포맷, 날짜를 얻는함수 time()
$ip = getenv("REMOTE_ADDR"); // ip
$level = $member['level']; // 회원 레벨 3=일반 2=관리자 1=최고관리자

$query = "INSERT INTO bbs1(id, level, user_id, name, nick_name, subject, story, file01, regdate, ip, genre) VALUES('$id', '$level', '$user_id', '$name', '$nick_name', '$subject', '$story', '$newFile01', '$regdate', '$ip', '$genre')";
mysql_query($connect, "set names utf8");
mysql_query($query, $connect);
mysql_close($connect);

?>

<?php
if ($id == 'bbs0') {
    ?>
    <script>
        window.alert("새 글이 등록되었습니다");
        location.href = './bbs0.php';
    </script>
<?php } else {    ?>
    <script>
        window.alert("새 글이 등록되었습니다");
        location.href = './<?php echo $id;?>.php<?php echo "#list2";?>';
    </script>
<?php
}
?>
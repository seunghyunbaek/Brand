<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- 변경1 : 타이틀 이름 -->
    <title>블랙핑크 갤러리</title>

    <!-- 부트스트랩 -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fb35edaa94.js"></script>

    <style>
        a:link {
            color: #000000;
            text-decoration: none;
        }

        /*링크처음상태*/
        a:visited {
            color: #000000;
            text-decoration: none;
        }

        /*방문한적이 있는 상태*/
        a:active {
            color: #000000;
            text-decoration: none;
        }

        /*클릭되는순간*/
        a:hover {
            color: #000000;
            text-decoration: none;
        }
    </style>

    <?php
    include("../../lib/db_connect.php");
    $connect = dbconn();
    $member = member();
    ?>

</head>

<body>
    <?php
    $_search = $_GET["search"];
    if (!$_search) $_search = -1;
    $_catagory = $_GET["catgo"];
    if (!$_catagory) $_catagory = -1;

    $_page = $_GET["_page"];
    $view_total = 15; //한 페이지에 15개 게시글이  보인다
    $view_top = 10; //한 페이지에 10개 게시글이  보인다
    if (!$_page) $_page = 1; // 페이지 번호가 지정이 안되었을 경우
    $page = ($_page - 1) * $view_total;

    // 변경7 : id 경로 변경하기
    $query = "select count(*) from bbs1 where id='blackpink'";

    if ($_catagory == "title") {
        $query = "select count(*) from bbs1 where subject like '%$_search%' and id='tekken'";
    } elseif ($_catagory == "name") {
        $query = "select count(*) from bbs1 where name like '%$_search%' and id='tekken'";
    } elseif ($_catagory == "content") {
        $query = "select count(*) from bbs1 where story like '%$_search%' and id='tekken'";
    }

    mysql_query("set names utf8", $connect);
    $result = mysql_query($query, $connect);
    $temp = mysql_fetch_array($result);
    $total = $temp[0];
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- 변경2 : 갤러리 로고 이름 , 갤러리 경로 -->
            <a class="navbar-brand" href="./blackpink.php">블랙핑크 갤러리</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">갤러리들</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../../index_game.php">게임</a>
                            <a class="dropdown-item" href="../../index_enter.php">연예/방송</a>
                            <a class="dropdown-item" href="../../index_sports.php">스포츠</a>
                            <a class="dropdown-item" href="../../index_healing.php">여행/음식</a>
                            <a class="dropdown-item" href="../../index_life.php">취미/생활</a>
                        </div>
                    </li>
                </ul>

                <?php
                if ($member['user_id']) {
                    echo "<ul class='navbar-nav ml-md-auto'><li class=nav-item><a href=../../member/gallog.php class=nav-link> 갤로그 </a></li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<li class=nav-item><span class='nav-link active'>$member[name]($member[user_id]) 님 환영합니다</span></li></ul>";
                    echo "&nbsp; &nbsp; &nbsp; <a href=../../member/logout.php class='btn btn-outline-success my-2 my-sm-0'>Sign Out</a>";
                } else {
                    echo "<span class='navbar-nav ml-md-auto'>";
                    echo "<h6><a href=../../member/join2.php>Sign Up</a></h6>&nbsp; &nbsp; &nbsp;";
                    echo "<h6><a href=../../member/login2.php>Sign In</a></h6>";
                    echo "</span>";
                } ?>
            </div>
        </div>
    </nav>
    <!-- 헤더 끝 -->

    <div class="container">
        <div class="mx-auto; d-block;" style="width:500px; height:auto; margin:20px auto">
            <!-- 변경3 : 갤러리 메인 이미지  -->
            <img class="img-fluid" src="./blackpink.jpeg" alt="블랙핑크" style="max-height:700px">
        </div>
    </div>
    <!-- 이미지 끝 -->
    <br><br>

    <div class="container">
        <table class="table table-hover">
            <caption style="caption-side:top">
                <h6>인기글</h6>
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>이름</th>
                    <th>제목</th>
                    <th>날짜</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 변경4 : where id 갤러리 경로 변경하기
                $query = "select * from bbs1 where id='blackpink' order by hit desc limit $view_top"; // desc 내림차순 asc 오름차순
                $result = mysql_query($query, $connect);
                $cnt = 1;

                $today = date("Ymd");

                while ($data = mysql_fetch_array($result)) {

                    $date_y = substr($data['regdate'], 2, 2); // 2019 에서 19만 가져옴 연도
                    $date_m = substr($data['regdate'], 4, 2); // 월
                    $date_d = substr($data['regdate'], 6, 2); // 일
                    $date_h = substr($data['regdate'], 8, 2); // 시
                    $date_i = substr($data['regdate'], 10, 2); // 분

                    $date_today = substr($data['regdate'], 0, 8);

                    echo "<tr>";
                    echo "<td> $cnt </td>";
                    echo "<td> $data[nick_name] </td>";
                    
                    if ($data[file01] == '')
                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <a href='./view.php?no=$data[no]&id=$data[id]'><i class='far fa-comment-dots'></i> $data[subject]";
                    else
                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <a href='./view.php?no=$data[no]&id=$data[id]'><i class='fas fa-image'></i> $data[subject]";
                    echo "&nbsp; &nbsp;";
                    if ($data['comment'] >= 1) {
                        echo "[" . $data['comment'] . "]";
                    }

                    echo "</a> </div> </td>";
                    if ($today == $date_today) {
                        
                        echo "<td> $date_h:$date_i </td>";
                    } else {
                        echo "<td> $date_y.$date_m.$date_d </td>";
                    }
                    echo "<td> $data[hit] </td>";
                    echo "</tr>";
                    $cnt++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- 인기글 끝 -->
    <br><br>

    <div class="container">
        <table class="table table-hover">
            <caption style="caption-side:top">
                <?php if ($_search == -1) { ?>
                    <h6 id="list2">자유게시판</h6>
                <?php } else { ?>
                    <h5 id="list2"><strong>자유게시판 : <?php echo $_search . " 검색결과"; ?></strong></h5>
                <?php } ?>
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>글쓴이</th>
                    <th>제목</th>
                    <th>날짜</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 변경5 : where id 갤러리 경로로 변경 (tekken) 
                $query = "select * from bbs1 where id='blackpink' order by no desc limit $page, $view_total"; // desc 내림차순 asc 오름차순
                if ($_catagory == "title") {
                    $query = "select * from bbs1 where id='blackpink' and subject like '%$_search%' order by no desc limit $page, $view_total"; // desc 내림차순 asc 오름차순
                } elseif ($_catagory == "name") {
                    $query = "select * from bbs1 where id='blackpink' and name like '%$_search%' order by no desc limit $page, $view_total"; // desc 내림차순 asc 오름차순
                } elseif ($_catagory == "content") {
                    $query = "select * from bbs1 where id='blackpink' and story like '%$_search%' order by no desc limit $page, $view_total"; // desc 내림차순 asc 오름차순
                }

                $result = mysql_query($query, $connect);
                $cnt = 1;

                $today = date("Ymd");

                while ($data = mysql_fetch_array($result)) {

                    $date_y = substr($data['regdate'], 2, 2); // 2019 에서 19만 가져옴 연도
                    $date_m = substr($data['regdate'], 4, 2); // 월
                    $date_d = substr($data['regdate'], 6, 2); // 일
                    $date_h = substr($data['regdate'], 8, 2); // 시
                    $date_i = substr($data['regdate'], 10, 2); // 분

                    $date_today = substr($data['regdate'], 0, 8);

                    

                    echo "<tr>";
                    echo "<td>  $data[no] </td>";
                    echo "<td> $data[nick_name] </td>";
                    
                    if ($data[file01] == '')
                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <a href='./view.php?no=$data[no]&id=$data[id]'><i class='far fa-comment-dots'></i> $data[subject]";
                    else
                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <a href='./view.php?no=$data[no]&id=$data[id]'><i class='fas fa-image'></i> $data[subject]";
                    echo "&nbsp; &nbsp;";
                    if ($data['comment'] >= 1) {
                        echo "[" . $data['comment'] . "]";
                    }
                    echo "</a> </div> </td>";

                    if ($today == $date_today) {
                        
                        echo "<td> $date_h:$date_i </td>"; // 시:분  출력
                    } else {
                        echo "<td> $date_y.$date_m.$date_d </td>";
                    }
                    echo "<td> $data[hit] </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <!-- 변경 6 : 글쓰기 경로 id변경하기  -->
        <button type="button" class="btn btn-primary float-right"><a style="color:white;" href="./write.php?id=blackpink&genre=enter">글쓰기</a></button>
        
    </div>

    <?php include("./list_page2.php"); ?>
    <!-- 게시판 끝 -->
    <br><br>

    <!-- 검색 시작 -->
    <div class="container">
        <div class="row mx-auto">
            <!-- action의 페이지경로 변경 -->
            <form class="form-inline" style="margin:0 auto;" action='./blackpink.php<?php echo "#list2"; ?>' method="get">
                <select class="custom-select mr-sm-2" name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" class="form-control mr-sm-2" name="search" required="required" size="30" />
                <button type="submit" class="btn btn-primary my-2 my-sm-0 ">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- 검색 끝 -->
    <br><br>

    <div style="margin-bottom:100px;"></div>

    <!-- FOOTER -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="position: fixed; bottom:0; width:100%;">
        <div class="container text-center">
            <small>Copyright &copy; Brand</small>
        </div>
    </footer>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>
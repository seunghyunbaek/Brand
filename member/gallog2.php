<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Brand</title>

    <!-- 부트스트랩 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/index_tab.css" rel="stylesheet">

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

        /*마우스 올리면*/
    </style>
    <?php
    include("../lib/db_connect.php");
    $connect = dbconn();
    $member = member();
    ?>
</head>

<body style="overflow-x: hidden;">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="navbar-toggler-icon"></span>
                    </button> <a class="navbar-brand" href="../index.php">Brand</a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="../board/bbs1/make.php">갤러리 신청</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">갤러리들</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../index_game.php">게임</a>
                                    <a class="dropdown-item" href="../index_enter.php">연예/방송</a>
                                    <a class="dropdown-item" href="../index_sports.php">스포츠</a>
                                    <a class="dropdown-item" href="../index_healing.php">여행/음식</a>
                                    <a class="dropdown-item" href="../index_life.php">취미/생활</a>
                                </div>
                            </li>
                        </ul>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="text" />
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">
                                Search
                            </button>
                        </form>

                        <?php
                        if ($member['user_id']) {
                            echo "<ul class='navbar-nav ml-md-auto'><li class=nav-item><a href=./gallog.php class=nav-link> 갤로그 </a></li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "<li class=nav-item><span class='nav-link active'>$member[name]($member[user_id]) 님 환영합니다</span></li></ul>";
                            echo "&nbsp; &nbsp; &nbsp; <a href=./logout.php class='btn btn-outline-success my-2 my-sm-0'>Sign Out</a>";
                        } else {
                            echo "<span class='navbar-nav ml-md-auto'>";
                            echo "<h6><a href=./join2.php>Sign Up</a></h6>&nbsp; &nbsp; &nbsp;";
                            echo "<h6><a href=./login2.php>Sign In</a></h6>";
                            echo "</span>";
                        } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- 헤더 끝 -->
    <br><br>

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

    $query = "select count(*) from bbs1 where id='bbs1'";

    if ($_catagory == "title") {
        $query = "select count(*) from bbs1 where subject like '%$_search%' and id='bbs1'";
    } elseif ($_catagory == "name") {
        $query = "select count(*) from bbs1 where name like '%$_search%' and id='bbs1'";
    } elseif ($_catagory == "content") {
        $query = "select count(*) from bbs1 where story like '%$_search%' and id='bbs1'";
    }

    mysql_query("set names utf8", $connect);
    $result = mysql_query($query, $connect);
    $temp = mysql_fetch_array($result);
    $total = $temp[0];
    ?>

    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link" href="./gallog.php">갤로그 홈</a></li>
            <li class="nav-item"><a class="nav-link active" href="./gallog2.php">내 게시글</a></li>
            <li class="nav-item"><a class="nav-link" href="./gallog3.php">내 댓글</a></li>
            
        </ul>

        <br>
        <br>
        <br>

        <div class="tab-content">

            <!-- 2번탭 -->
            <div role="tabpanel" id="tab2" class="tab-pane fadein active">
                <div class="row">
                    <div class="container">
                        <table class="table table-hover">
                            <caption style="caption-side:top">
                                <h6>내 게시글</h6>
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
                                $view_total = 3; //한 페이지에 15개 게시글이  보인다
                                if (!$_page) $_page = 1; // 페이지 번호가 지정이 안되었을 경우
                                $page = ($_page - 1) * $view_total;

                                $query = "select count(*) from bbs1 where user_id='$member[user_id]'";
                                mysql_query("set names utf8", $connect);
                                $result = mysql_query($query, $connect);
                                $temp = mysql_fetch_array($result);
                                $total = $temp[0];

                                // $query = "select * from bbs1 where user_id='$member[user_id]' order by hit desc limit $view_total"; // desc 내림차순 asc 오름차순
                                $query = "select * from bbs1 where user_id='$member[user_id]' order by no desc limit $page, $view_total";
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
                                    echo "<td> $data[no] </td>";
                                    echo "<td> $data[nick_name] </td>";
                                    
                                    echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <a href='../board/bbs1/view.php?no=$data[no]&id=$data[id]'> $data[subject]";
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
                    <?php

                    include("../board/bbs1/list_page3.php");
                    ?>
                </div>
            </div>
            <!-- 2번탭 끝 -->

        </div>
    </div>


    <br><br>

    <div style="margin-bottom:100px;"></div>

    <!-- FOOTER -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="position: fixed; bottom:0; width:100%;">
        <div class="container text-center">
            <small>Copyright &copy; Brand</small>
        </div>
    </footer>


    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
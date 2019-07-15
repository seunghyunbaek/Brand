<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Brand</title>

    <!-- 부트스트랩 -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/index_tab.css" rel="stylesheet">
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

        li.list-group-item a:hover {
            color: #ffffff;
            text-decoration: none;
        }

        /*마우스 올리면*/
    </style>
    <?php
    include("./lib/db_connect.php");
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
                    </button>
                    <a class="navbar-brand" href="./index.php">Brand</a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="./board/bbs1/make.php">갤러리 신청</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">갤러리들</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="./index_game.php">게임</a>
                                    <a class="dropdown-item" href="./index_enter.php">연예/방송</a>
                                    <a class="dropdown-item" href="./index_sports.php">스포츠</a>
                                    <a class="dropdown-item" href="./index_healing.php">여행/음식</a>
                                    <a class="dropdown-item" href="./index_life.php">취미/생활</a>
                                </div>
                            </li>
                        </ul>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <form class="form-inline" action="./board/bbs1/total.php#list2" method="get">
                            <!-- 변경 : 토탈검색 장르 -->
                            <input type="hidden" name="genre" value="sports">
                            <input class="form-control mr-sm-2" type="text" required="required" size="30" name="search" />
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <?php
                        if ($member['user_id']) {
                            echo "<ul class='navbar-nav ml-md-auto'><li class=nav-item><a href=./member/gallog.php class=nav-link> 갤로그 </a></li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "<li class=nav-item><span class='nav-link active'>$member[name]($member[user_id]) 님 환영합니다</span></li></ul>";
                            echo "&nbsp; &nbsp; &nbsp; <a href=./member/logout.php class='btn btn-outline-success my-2 my-sm-0'>Sign Out</a>";
                        } else {
                            echo "<span class='navbar-nav ml-md-auto'>";
                            echo "<h6><a href=./member/join2.php>Sign Up</a></h6>&nbsp; &nbsp; &nbsp;";
                            echo "<h6><a href=./member/login2.php>Sign In</a></h6>";
                            echo "</span>";
                        } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- 헤더 끝 -->
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    $time = time();
                    $now = date("YmdHis", strtotime("now", $time));
                    $weekago = date("YmdHis", strtotime("-1 week", $time));

                    // 이미지가 있는 게시글중 상위 4개만 가져옵니다
                    // <!-- 변경 : 이미지 게시글 장르 -->
                    $query = "select * from bbs1 where genre='sports' and regdate between '$weekago' and '$now' and file01!='' order by hit desc limit 4";
                    if (!$result = mysql_query($query, $connect)) {
                        echo "Errno: " . $connect->errno . "\n";
                        echo "Error: " . $connect->error . "\n";
                    }

                    while ($data = mysql_fetch_array($result)) {
                        echo "<div class='col-md-3'>";
                        echo "<a href='./board/bbs1/view.php?no=$data[no]&id=$data[id]'>";
                        echo "<div class='card' style='height:18rem; overflow:hidden; border-bottom:none;'>";
                        echo "<img class='card-img-top' src='./board/bbs1/data/$data[file01]'>";
                        echo "</div>";
                        echo "<div class='card' style='border-top:none;'>";
                        echo "<p class='card-text'>";
                        echo "<h5 class='text-center'>$data[subject]</h5>";
                        echo "</p>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Thumbnail 끝 -->
    <br><br>

    <div class="container" style="border: 1px solid gray; border-radius: 20px;">
        <div class="row">
            <?php
            $time = time();
            $now = date("YmdHis", strtotime("now", $time)) . " 현재 <br>";
            $weekago = date("YmdHis", strtotime("-1 week", $time)) . " 일주일 전 <br>";
            $game_top_count = 0;
            // 게임장르 상위 10개 가져오기
            // <!-- 변경 : 인기글 장르 -->
            $query = "select * from bbs1 where genre='sports' and regdate between '$weekago' and '$now' order by hit desc limit 10";
            if (!$result = mysql_query($query, $connect)) {
                echo "Errno: " . $connect->errno . "\n";
                echo "Error: " . $connect->error . "\n";
            }

            while ($data = mysql_fetch_array($result)) {
                if ($game_top_count % 5 == 0) {
                    echo "<div class='col-md-6'>";
                    echo "<table class='table table-sm table-hover'>";
                    if ($game_top_count == 0) {
                        echo "<caption style='caption-side:top'>";
                        // <!-- 변경 : 테이블 캡션 -->
                        echo "<h5>스포츠 주간 인기 게시글</h5>";
                        echo "</caption>";
                    } else {
                        echo "<caption style='caption-side:top'>";
                        echo "<h5>&nbsp;</h5>";
                        echo "</caption>";
                    }
                    echo "<tbody>";
                }
                $query2 = "select name from bbs1_name where id='$data[id]'";
                if (!$result2 = mysql_query($query2, $connect)) {
                    echo "Errno: " . $connect->errno . "\n";
                    echo "Error: " . $connect->error . "\n";
                }
                $data2 = mysql_fetch_array($result);
                echo "<tr>";
                echo "<td>";
                
                if ($data[file01] == '')
                    echo "<li><a href='./board/bbs1/view.php?no=$data[no]&id=$data[id]'>[" . substr($data2[name], 0, 3) . "갤] <i class='far fa-comment-dots'></i> $data[subject] </a></li>";
                else
                    echo "<li><a href='./board/bbs1/view.php?no=$data[no]&id=$data[id]'>[" . substr($data2[name], 0, 3) . "갤] <i class='fas fa-image'></i> $data[subject] </a></li>";
                echo "</td>";
                echo "</tr>";
                $game_top_count++;
                if ($game_top_count % 5 == 0) {
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                }
            }
            if ($game_top_count % 5 != 0) {
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <!-- Table 끝 -->
    <br><br>

    <!-- 주간 흥한 갤러리 변경 -->
    <div class="container" style="border: 1px solid gray; border-radius: 20px;">
        <div class="row">
            <?php
            $time = time();
            $now = date("YmdHis", strtotime("now", $time)) . " 현재 <br>";
            $weekago = date("YmdHis", strtotime("-1 week", $time)) . " 일주일 전 <br>";
            $game_top_count = 0;
            // 연예/방송 장르 상위 10개 가져오기
            // <!-- 변경 : 장르 -->
            $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='sports' group by id order by sum(hit) desc limit 10";
            if (!$result = mysql_query($query, $connect)) {
                echo "Errno: " . $connect->errno . "\n";
                echo "Error: " . $connect->error . "\n";
            }

            while ($data = mysql_fetch_array($result)) {
                if ($game_top_count % 5 == 0) {
                    echo "<div class='col-md-6'>";
                    echo "<table class='table table-hover'>";
                    if ($game_top_count == 0) {
                        echo "<caption style='caption-side:top'>";
                        // <!-- 변경 : 테이블 캡션 -->
                        echo "<h5>스포츠 주간 흥한 갤러리</h5>";
                        echo "</caption>";
                    } else {
                        echo "<caption style='caption-side:top'>";
                        echo "<h5>&nbsp;</h5>";
                        echo "</caption>";
                    }
                    echo "<tbody>";
                }
                $query2 = "select name from bbs1_name where id='$data[id]'";
                if (!$result2 = mysql_query($query2, $connect)) {
                    echo "Errno: " . $connect->errno . "\n";
                    echo "Error: " . $connect->error . "\n";
                }
                $data2 =  mysql_fetch_array($result2);
                $game_top_count++;
                echo "<tr>";
                echo "<td>";
                
                echo "<a href='./board/bbs1/$data[id].php'>$game_top_count.&nbsp;&nbsp; $data2[name] </a>";
                echo "</td>";
                echo "</tr>";
                if ($game_top_count % 5 == 0) {
                    
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                }
            }
            if ($game_top_count % 5 != 0) {
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            
            ?>
        </div>
    </div>
    <br><br>
    <!-- 주간 흥한 갤러리 변경 -->




    <!-- 갤러리 목록 -->
    <div class="container" style="height: 257px; overflow-y:overlay; ">
        <div class="row">

            <!-- 변경 : 장르 -->
            <?php
            $query2 = "select * from bbs1_name where genre='sports' order by name"; // desc 내림차순 asc 오름차순
            if (!$result2 = mysql_query($query2, $connect)) {
                echo "Errno: " . $connect->errno . "\n";
                echo "Error: " . $connect->error . "\n";
            }

            while ($data2 = mysql_fetch_array($result2)) {

                if ($game_count % 4 == 0) {
                    echo "<div class='col-md-4' style='margin-bottom:26px;'>";
                    echo "<ul class='list-group'>";
                }

                echo "<li class='list-group-item btn btn-outline-success'> <a href='./board/bbs1/$data2[id].php'> $data2[name] </a></li>";
                $game_count++;
                if ($game_count % 4 == 0) {
                    echo "</ul>";
                    echo "</div>";
                }
            }
            if ($game_count % 4 != 0) {
                echo "</ul>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <!-- 갤러리 목록 -->

    <br><br>


    <div style="margin-bottom:100px;"></div>

    <!-- FOOTER -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="position: fixed; bottom:0; width:100%;">
        <div class="container text-center">
            <small>Copyright &copy; Brand</small>
        </div>
    </footer>


    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
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

        /*마우스 올리면*/
    </style>
    <?php
    include("./lib/db_connect.php");
    $connect = dbconn();
    $member = member();
    ?>
</head>

<body style="overflow-x: hidden;">
    <?php
    $view_top = 5; //한 페이지에 15개 게시글이  보인다
    ?>
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="navbar-toggler-icon"></span>
                    </button> <a class="navbar-brand" href="./index.php">Brand</a>
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
                            <input class="form-control mr-sm-2" type="text" name="search" required="required" size="30" />
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
                <div class="carousel slide" id="carousel-972227">
                    <ol class="carousel-indicators">
                        <li data-slide-to="0" data-target="#carousel-972227" class="active">
                        </li>
                        <li data-slide-to="1" data-target="#carousel-972227">
                        </li>
                        <li data-slide-to="2" data-target="#carousel-972227">
                        </li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" alt="Carousel Bootstrap First" src="globe.jpg" style="height: 60vh;" />
                            <div class="carousel-caption">
                                <h4>
                                    다양한 사람들과 소통해요
                                </h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" alt="Carousel Bootstrap Second" src="think.jpg" style="height: 60vh;" />
                            <div class="carousel-caption">
                                <h4>
                                    생각을 공유해요
                                </h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" alt="Carousel Bootstrap Third" src="monster.png" style="height: 60vh;" />
                            <div class="carousel-caption">
                                <h4>
                                    환영합니다
                                </h4>
                            </div>
                        </div>
                    </div> <a class="carousel-control-prev" href="#carousel-972227" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-972227" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- 이미지 롤링 -->
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-4" style="overflow-x:hidden;">
                <table class="table">
                    <caption style="caption-side:top">
                        <a href="./board/bbs1/bbs0.php">
                            <h5>공지사항 갤러리</h5>
                        </a>
                    </caption>
                    <tbody>
                        <?php
                        $query = "select * from bbs1 where id='bbs0' order by no desc limit 5"; // desc 내림차순 asc 오름차순
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
                            if ($data2[file01] == '')
                                echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view3.php?no=$data[no]&id=$data[id]'><i class='far fa-comment-dots'></i> $data[subject]";
                            else
                                echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view3.php?no=$data[no]&id=$data[id]'><i class='fas fa-image'></i> $data[subject]";
                            echo "</a></li> </div> </td>";
                            echo "</tr>";
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table table-hover">
                    <caption style="caption-side:top">
                        <h5>주간 흥한 갤러리</h5>
                    </caption>
                    <tbody>
                        <?php
                        $time = time();
                        $now = date("YmdHis", strtotime("now", $time)) . " 현재 <br>";
                        $weekago = date("YmdHis", strtotime("-1 week", $time)) . " 일주일 전 <br>";
                        $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' group by id order by sum(hit) desc limit 5";
                        $result = mysql_query($query, $connect);
                        $cnt = 1;

                        while ($data = mysql_fetch_array($result)) {
                            $query2 = "select name from bbs1_name where id='$data[id]'";
                            if (!$result2 = mysql_query($query2, $connect)) {
                                echo "Errno: " . $connect->errno . "\n";
                                echo "Error: " . $connect->error . "\n";
                            }
                            $data2 =  mysql_fetch_array($result2);

                            echo "<tr>";
                            echo "<td><div style='white-space: nowrap; width: 300px; overflow: hidden; text-overflow: ellipsis;'> <li><a href='./board/bbs1/$data[id].php'> $data2[0]";
                            echo "&nbsp; &nbsp;";
                            echo "</a></li></div></td>";
                            echo "</tr>";
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <table class="table table-hover">
                    <caption style="caption-side:top">
                        <a href="./board/bbs1/make.php">
                            <h5>갤러리 신청 갤러리</h5>
                        </a>
                    </caption>
                    <tbody>
                        <?php
                        // 변경 id=
                        $query = "select * from bbs1 where id='make' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                        $result = mysql_query($query, $connect);
                        $cnt = 1;

                        while ($data = mysql_fetch_array($result)) {
                            echo "<tr>";
                            
                            if ($data2[file01] == '')
                                echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data[no]&id=$data[id]'><i class='far fa-comment-dots'></i> $data[subject]";
                            else
                                echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data[no]&id=$data[id]'><i class='fas fa-image'></i> $data[subject]";
                            echo "&nbsp; &nbsp;";
                            echo "</a> </li> </div> </td>";
                            echo "</tr>";
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- 공지갤, 흥갤, 신청갤 -->
    <br><br>

    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" href="#tab1">게임</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" href="#tab2">연예/방송</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" href="#tab3">스포츠</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" href="#tab4">여행/음식</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" href="#tab5">취미/생활</a></li>
        </ul>

        <div class="tab-content">

            <div role="tabpanel" id="tab1" class="tab-pane fadein active">
                <div class="row">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row">
                                <?php
                                // 게임장르 상위 4개 가져오기
                                $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='game' group by id order by sum(hit) desc limit 4";
                                if (!$result = mysql_query($query, $connect)) {
                                    echo "Errno: " . $connect->errno . "\n";
                                    echo "Error: " . $connect->error . "\n";
                                }
                                $topgall = [];
                                while ($data = mysql_fetch_array($result)) {
                                    $topgall[] = $data[id];
                                }


                                // 테이블 만들기
                                foreach ($topgall as $topgall_id) { ?>

                                    <?php
                                    $query3 = "select name from bbs1_name where id='$topgall_id'";
                                    $result3 = mysql_query($query3, $connect);
                                    $data3 = mysql_fetch_array($result3);  ?>

                                    <div class="col-md-6">
                                        <table class="table table-sm table-hover">
                                            <caption style="caption-side:top"><a href="./board/bbs1/<?php echo $topgall_id; ?>.php"><?php echo $data3[0]; ?> &raquo;</a></caption>
                                            <tbody>
                                                <?php
                                                $query2 = "select * from bbs1 where id='$topgall_id' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                                                if (!$result2 = mysql_query($query2, $connect)) {
                                                    echo "Errno: " . $connect->errno . "\n";
                                                    echo "Error: " . $connect->error . "\n";
                                                }
                                                $cnt = 1;

                                                while ($data2 = mysql_fetch_array($result2)) {
                                                    echo "<tr>";
                                                    
                                                    // echo "<td> <div style='white-space: nowrap; width: 300px; overflow: hidden; text-overflow: ellipsis;'> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'> $data2[subject]";
                                                    if ($data2[file01] == '')
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='far fa-comment-dots'></i> $data2[subject]";
                                                    else
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='fas fa-image'></i> $data2[subject]";
                                                    echo "</a> </li> </div> </td>";
                                                    echo "</tr>";
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>

                                <!-- 게임장르 상위 4개 가져오기 끝 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="tab2" class="tab-pane fade">
                <div class="row">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row">
                                <?php
                                // 연예장르 상위 4개 가져오기
                                $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='enter' group by id order by sum(hit) desc limit 4";
                                if (!$result = mysql_query($query, $connect)) {
                                    echo "Errno: " . $connect->errno . "\n";
                                    echo "Error: " . $connect->error . "\n";
                                }
                                $topgall = [];
                                while ($data = mysql_fetch_array($result)) {
                                    $topgall[] = $data[id];
                                }


                                // 테이블 만들기
                                foreach ($topgall as $topgall_id) { ?>

                                    <?php
                                    $query3 = "select name from bbs1_name where id='$topgall_id'";
                                    $result3 = mysql_query($query3, $connect);
                                    $data3 = mysql_fetch_array($result3);  ?>

                                    <div class="col-md-6">
                                        <table class="table table-sm table-hover">
                                            <caption style="caption-side:top"><a href="./board/bbs1/<?php echo $topgall_id; ?>.php"><?php echo $data3[0]; ?> &raquo;</a></caption>
                                            <tbody>
                                                <?php
                                                $query2 = "select * from bbs1 where id='$topgall_id' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                                                if (!$result2 = mysql_query($query2, $connect)) {
                                                    echo "Errno: " . $connect->errno . "\n";
                                                    echo "Error: " . $connect->error . "\n";
                                                }
                                                $cnt = 1;

                                                while ($data2 = mysql_fetch_array($result2)) {
                                                    echo "<tr>";
                                                    
                                                    if ($data2[file01] == '')
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'><li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='far fa-comment-dots'></i> $data2[subject]";
                                                    else
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li><a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='fas fa-image'></i> $data2[subject]";
                                                    echo "</a></li></div> </td>";
                                                    echo "</tr>";
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- 연예장르 상위 4개 가져오기 끝 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="tab3" class="tab-pane fade">
                <div class="row">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row">

                                <?php
                                // 스포츠장르 상위 4개 가져오기
                                $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='sports' group by id order by sum(hit) desc limit 4";
                                if (!$result = mysql_query($query, $connect)) {
                                    echo "Errno: " . $connect->errno . "\n";
                                    echo "Error: " . $connect->error . "\n";
                                }
                                $topgall = [];
                                while ($data = mysql_fetch_array($result)) {
                                    $topgall[] = $data[id];
                                }


                                // 테이블 만들기
                                foreach ($topgall as $topgall_id) { ?>

                                    <?php
                                    $query3 = "select name from bbs1_name where id='$topgall_id'";
                                    $result3 = mysql_query($query3, $connect);
                                    $data3 = mysql_fetch_array($result3);  ?>

                                    <div class="col-md-6">
                                        <table class="table table-sm table-hover">
                                            <caption style="caption-side:top"><a href="./board/bbs1/<?php echo $topgall_id; ?>.php"><?php echo $data3[0]; ?> &raquo;</a></caption>
                                            <tbody>
                                                <?php
                                                $query2 = "select * from bbs1 where id='$topgall_id' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                                                if (!$result2 = mysql_query($query2, $connect)) {
                                                    echo "Errno: " . $connect->errno . "\n";
                                                    echo "Error: " . $connect->error . "\n";
                                                }
                                                $cnt = 1;

                                                while ($data2 = mysql_fetch_array($result2)) {
                                                    echo "<tr>";
                                                    
                                                    if ($data2[file01] == '')
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='far fa-comment-dots'></i> $data2[subject]";
                                                    else
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='fas fa-image'></i> $data2[subject]";
                                                    echo "</a></li></div> </td>";
                                                    echo "</tr>";
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- 스포츠장르 상위 4개 가져오기 끝 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="tab4" class="tab-pane fade">
                <div class="row">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row">

                                <?php
                                // 여행음식 장르 상위 4개 가져오기
                                $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='healing' group by id order by sum(hit) desc limit 4";
                                if (!$result = mysql_query($query, $connect)) {
                                    echo "Errno: " . $connect->errno . "\n";
                                    echo "Error: " . $connect->error . "\n";
                                }
                                $topgall = [];
                                while ($data = mysql_fetch_array($result)) {
                                    $topgall[] = $data[id];
                                }


                                // 테이블 만들기
                                foreach ($topgall as $topgall_id) { ?>

                                    <?php
                                    $query3 = "select name from bbs1_name where id='$topgall_id'";
                                    $result3 = mysql_query($query3, $connect);
                                    $data3 = mysql_fetch_array($result3);  ?>

                                    <div class="col-md-6">
                                        <table class="table table-sm table-hover">
                                            <caption style="caption-side:top"><a href="./board/bbs1/<?php echo $topgall_id; ?>.php"><?php echo $data3[0]; ?> &raquo;</a></caption>
                                            <tbody>
                                                <?php
                                                $query2 = "select * from bbs1 where id='$topgall_id' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                                                if (!$result2 = mysql_query($query2, $connect)) {
                                                    echo "Errno: " . $connect->errno . "\n";
                                                    echo "Error: " . $connect->error . "\n";
                                                }
                                                $cnt = 1;

                                                while ($data2 = mysql_fetch_array($result2)) {
                                                    echo "<tr>";
                                                    
                                                    if ($data2[file01] == '')
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='far fa-comment-dots'></i> $data2[subject]";
                                                    else
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='fas fa-image'></i> $data2[subject]";
                                                    echo "</a></li></div> </td>";
                                                    echo "</tr>";
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- 여행음식 장르 상위 4개 가져오기 끝 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="tab5" class="tab-pane fade">
                <div class="row">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row">

                                <?php
                                // 취미생활 장르 상위 4개 가져오기
                                $query = "select id, sum(hit) as total_hit from bbs1 where regdate between '$weekago' and '$now' and genre='life' group by id order by sum(hit) desc limit 4";
                                if (!$result = mysql_query($query, $connect)) {
                                    echo "Errno: " . $connect->errno . "\n";
                                    echo "Error: " . $connect->error . "\n";
                                }
                                $topgall = [];
                                while ($data = mysql_fetch_array($result)) {
                                    $topgall[] = $data[id];
                                }

                                // 테이블 만들기
                                foreach ($topgall as $topgall_id) { ?>

                                    <?php
                                    $query3 = "select name from bbs1_name where id='$topgall_id'";
                                    $result3 = mysql_query($query3, $connect);
                                    $data3 = mysql_fetch_array($result3);  ?>

                                    <div class="col-md-6">
                                        <table class="table table-sm table-hover">
                                            <caption style="caption-side:top"><a href="./board/bbs1/<?php echo $topgall_id; ?>.php"><?php echo $data3[0]; ?> &raquo;</a></caption>
                                            <tbody>
                                                <?php
                                                $query2 = "select * from bbs1 where id='$topgall_id' order by hit desc limit 5"; // desc 내림차순 asc 오름차순
                                                if (!$result2 = mysql_query($query2, $connect)) {
                                                    echo "Errno: " . $connect->errno . "\n";
                                                    echo "Error: " . $connect->error . "\n";
                                                }
                                                $cnt = 1;

                                                while ($data2 = mysql_fetch_array($result2)) {
                                                    echo "<tr>";
                                                    
                                                    if ($data2[file01] == '')
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='far fa-comment-dots'></i> $data2[subject]";
                                                    else
                                                        echo "<td> <div style='white-space: nowrap; width: 400px; overflow: hidden; text-overflow: ellipsis;'> <li> <a href='./board/bbs1/view.php?no=$data2[no]&id=$data2[id]'><i class='fas fa-image'></i> $data2[subject]";
                                                    echo "</a></li></div> </td>";
                                                    echo "</tr>";
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- 취미생활 상위 4개 가져오기 끝 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 탭메뉴 끝 -->
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
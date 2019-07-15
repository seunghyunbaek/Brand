<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

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

    /*마우스 올리면*/
  </style>

  <?php
  include("../../lib/db_connect.php");
  $connect = dbconn();
  $member = member();

  $no = $_GET['no'];
  $id = $_GET['id'];

  $re_wt = $_GET['re_wt']; // 코멘트 답글 입력란 생성 값이 (Y)일때
  $lo_reply_1 = $_GET['lo_reply_1']; // 페이지 로케이션
  $d_no = $_GET['d_no'];

  $r_e = $_GET['re'];
  $rq = $_GET['rq'];
  $d_2no = $_GET['d_2no'];

  $bbs1 = $no;
  if ($no != $_COOKIE['hit_bbs1_' . $no]) {
    $_query = "update bbs1 set hit=hit+1 where no='$no'";
    mysql_query("set names utf8", $connect);
    mysql_query($_query, $connect);
    setcookie("hit_bbs1_" . $no, $no, time() + 60, "/");
  }

  $query = "select * from bbs1 where no='$no' and id='$id'";
  mysql_query("set names utf8", $connect);
  $result = mysql_query($query, $connect);
  $data = mysql_fetch_array($result);

  $query_view_title = "select * from bbs1_name where id='$id'";
  $result_view_title = mysql_query($query_view_title, $connect);
  $data_view_title = mysql_fetch_array($result_view_title);
  ?>
  <title><?php echo $data['subject']; ?></title>
</head>

<body>
  <!-- 헤더 시작 -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- <a class="navbar-brand" href="./list2.php">독서중독자들 갤러리</a> -->
      <a class="navbar-brand" href="./<?php echo $data_view_title['id']; ?>.php"><?php echo $data_view_title['name']; ?></a>
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

  <!-- 게시글 보기 -->
  <div class="container" style="margin: 5% auto 0 auto">
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <?php
                $date_y = substr($data['regdate'], 2, 2); // 2019 에서 19만 가져옴 연도
                $date_m = substr($data['regdate'], 4, 2); // 월
                $date_d = substr($data['regdate'], 6, 2); // 일
                $date_h = substr($data['regdate'], 8, 2); // 시
                $date_i = substr($data['regdate'], 10, 2); // 분

                echo "<div><h5>$data[subject]</h5></div>";
                // 닉네임만 보이기
                echo "<div>$data[nick_name](".substr($data[user_id],0,2)."****)&nbsp;&#124;&nbsp;&nbsp;$date_y.$date_m.$date_d&nbsp;$date_h:$date_i<div style='float:right;'> 조회수 $data[hit] </div> </div>";
                ?>
              </td>
            </tr>
            <tr>
              <td>
                <?php
                echo "<div style='width: 600px; height: auto; margin:3% 0'>";
                if ($data['file01']) {
                  echo "<img src='./data/$data[file01]' style='max-width: 100%; height: auto;'>";
                }
                echo "<br><br>$data[story]";
                echo "</div>";
                ?>

              </td>
            </tr>
            <tr>
              <td style="border-top:none;" id="updown">
                <?php
                $query1 = "select count(*) from bbs1_up where bbs1_no='$no'";
                $result1 = mysql_query($query1, $connect);
                $data1 = mysql_fetch_array($result1);
                $query2 = "select count(*) from bbs1_down where bbs1_no='$no'";
                $result2 = mysql_query($query2, $connect);
                $data2 = mysql_fetch_array($result2);
                ?>
                <form action="./updown_post.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="bbs1_no" value="<?php echo $no; ?>">
                  <div class="d-lg-table mx-auto">
                    <button type="submit" name="up" value="1" class="btn btn-primary ml-1 mr-1"><i class="far fa-thumbs-up" style="font-size:1.3rem;"></i><br><?php echo $data1[0]; ?></button>
                    <button type="submit" name="down" value="1" class="btn btn-primary ml-1 mr-1"><i class="far fa-thumbs-down" style="font-size:1.3rem;"></i><br><?php echo $data2[0]; ?></button>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td>
                <!-- 댓글 테이블 -->
                <table class="table" style="margin-bottom: -1.5rem">
                  <?php
                  // 전체 댓글 수 알아보기
                  $q_count = "select count(*) from bbs1_comment where bbs1_no='$data[no]'";
                  $r_count = mysql_query($q_count, $connect);
                  $count = mysql_fetch_array($r_count);
                  $total_count = $count[0]; //코멘트 총개수
                  ?>

                  <tr>
                    <?php
                    echo "<td style='border-top: none; border-bottom: none;'>";
                    echo "<button class='btn btn-primary' style='display: inline-block'> <a href='./$data_view_title[id].php' style='color:white'> 전체글 </a></button>";
                    ?>
                    <?php
                    // 게시글 수정, 글삭제, 글쓰기 버튼
                    if ($member['user_id'] == $data['user_id']) {
                      echo "<button class='btn btn-primary' style='display: inline-block; margin-left: 20px;'> <a href='./edit.php?no=$data[no]&id=$data[id]' style='color:white'> 글수정 </a></button>";
                    }
                    if ($member['user_id'] == $data['user_id'] or $member['level'] == 1) {
                      echo "<button class='btn btn-primary' style='display: inline-block; margin-left: 20px;'> <a href='./del.php?no=$data[no]&id=$data[id]' style='color:white'>";
                      ?>
                      <font onclick="return confirm('정말로 삭제 하시겠습니까?')">
                        <?php
                        echo "글삭제 </font></a></button>";
                      }
                      if ($member['user_id']) {
                        echo "<button class='btn btn-primary' style='display: inline-block; margin-left: 20px;'> <a href='./write.php?id=$data_view_title[id]&genre=$data_view_title[genre]' style='color:white'> 글쓰기 </a></button>";
                      }
                      echo "</td>";
                      echo "<td style='border-top: none; border-bottom: none;' align='right'><font color='#9c9a9a'>댓글 개수:&nbsp;$total_count</font></td>";
                      ?>
                  </tr>

                  <!-- 작성자 작성일 출력 댓글 출력하기-->
                  <?php
                  $q = "select * from bbs1_comment where bbs1_no='$data[no]' and replys='0' order by regdate asc, no asc";
                  $r = mysql_query($q, $connect);
                  // $d : 댓글
                  while ($d = mysql_fetch_array($r)) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<span style='font=size:9pt; font-family:Tahoma; color:#727371'>";

                    if ($d['nick_name']) {
                      echo $d['nick_name'];
                    } else {
                      echo $d['name']; //이름 출력
                    }

                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    $d_Y = substr($d[regdate], 0, 4) . ".";
                    $d_m = substr($d[regdate], 4, 2) . ".";
                    $d_d = substr($d[regdate], 6, 2) . "&nbsp;";
                    $d_h = substr($d[regdate], 8, 2) . ":";
                    $d_i = substr($d[regdate], 10, 2); // 시간 출력

                    echo $d_Y . $d_m . $d_d . $d_h . $d_i;
                    echo "</span> <br>";
                    // 댓글 내용 출력
                    echo "<font color='#073c62'>";
                    echo "&nbsp;&nbsp;&nbsp;";
                    echo nl2br($d[memo]);
                    echo "</font>";
                    echo "</td>";

                    if ($data[comment] > 0) {
                      echo "<td align='right' style='border-bottom: none'>";
                    } else {
                      echo "<td align='right' style='border-bottom: 1px solid #dee2e6'>";
                    }
                    // 댓글 수정, 댓글달기 버튼 출력
                    if ($member['user_id'] == $d['user_id']) {
                      echo "<a href='./view.php?id=$id&no=$data[no]&d_no=$d[no]&re=Y&rq=Y&#lo_reply_3' onfocus='this.blur()'><span style='font-size:;9pt; font-family:Tahoma; color:#727371' align='right'>수정</span></a> &nbsp; &nbsp;";
                    }
                    if ($member['user_id']) {
                      echo "<a href='./view.php?id=$id&re_wt=Y&no=$data[no]&d_no=$d[no]&#lo_reply_2' onfocus='this.blur()'>";
                      echo "<span style='font-size:;9pt; font-family:Tahoma; color:#727371' align='right'>댓글달기</span></a> &nbsp;<br>";
                    }
                    ?>

                    <!-- 댓글 삭제버튼 출력 -->
                    <?php if ($member['user_id'] ==  $d['user_id'] or $member['level'] == 1) { ?>
                      <a href="./comment_del.php?d_no=<?php echo $d['no']; ?>&no_s=<?php echo $data['no']; ?>&bbs1_no=<?php echo $d['bbs1_no']; ?>&replys_all=all&id=<?php echo $id; ?>" onfocus="this.blur()">
                        <font color='tomato' onclick="return confirm('정말로 삭제 하시겠습니까?')">삭제&nbsp;&nbsp;</font>
                      </a>
                    <?php }
                    echo "</td>"; ?>
                    <!-- 댓글 삭제버튼 출력 끝 -->

                    <!-- 댓글의 댓글 출력 -->
                    <?php
                    $q_2 = "select * from bbs1_comment where bbs1_no='$data[no]' and replys='$d[no]' order by regdate asc";
                    $r_2 = mysql_query($q_2, $connect);
                    // $d_2 : 댓글의 댓글
                    while ($d_2 = mysql_fetch_array($r_2)) {

                      echo "<tr>";
                      echo "<td style='border-style: none; padding: 0 .75rem'>";
                      echo "<table class='table table-sm' style='margin-bottom:.5rem;'>";
                      echo "<tr>";
                      echo "<td style='background-color:#dcdcdc88; border-style:none;'>&nbsp;</td>";
                      echo "<td style='background-color:#dcdcdc88; border-style:none;'>";
                      echo "<span style='font-size:11pt; color:#8a8a88'>└</span>";
                      echo "</td>";
                      echo "<td style='background-color:#dcdcdc88; border-style:none;'>";
                      echo "<span style='font-size:11pt; color:#8a8a88'>";
                      if ($d_2[nick_name]) {
                        echo $d_2[nick_name];
                      } else {
                        echo $d_2[name];
                      }
                      echo "&nbsp; &nbsp; &nbsp; &nbsp;";

                      echo $d_2_Y = substr($d_2[regdate], 0, 4) . ".";
                      echo $d_2_m = substr($d_2[regdate], 4, 2) . ".";
                      echo $d_2_d = substr($d_2[regdate], 6, 2) . "&nbsp;";
                      echo $d_2_h = substr($d_2[regdate], 8, 2) . ":";
                      echo $d_2_i = substr($d_2[regdate], 10, 2);

                      echo "<br>";
                      echo nl2br($d_2['memo']);
                      echo "</span>&nbsp;&nbsp;";

                      echo "</td>";
                      ?>

                      <!-- 댓글의 댓글 삭제하기 -->
                      <td style='background-color:#dcdcdc88; border-style:none;'>
                        <?php if ($member['user_id'] == $d_2['user_id']) { ?>
                          <div align="right">
                            <a href="./view.php?id=<?php echo $id; ?>&no=<?php echo $data[no]; ?>&d_no=<?php echo $d[no]; ?>&d_2no=<?php echo $d_2[no]; ?>&re=Y&rq=N&#lo_reply_3"><span style='font-size:;9pt; font-family:Tahoma; color:#727371' align='right'>수정</span></a> &nbsp; &nbsp;
                          <?php
                          }
                          if ($member['user_id'] == $d_2['user_id'] or $member['level'] == 1) { ?>
                            <a href="./comment_del.php?d_no=<?php echo $d_2['no']; ?>&no_s=<?php echo $data['no']; ?>&bbs1_no=<?php echo $d_2['bbs1_no']; ?>&replys=<?php echo $d_2['replys']; ?>&reply_rr=rr&id=<?php echo $id; ?>" onfocus="this.blur()">
                              <span style='font-size:10pt; color:tomato' onclick="return confirm('정말로 삭제 하시겠습니까?')">
                                삭제
                              </span>
                            </a>
                          <?php } ?>
                          &nbsp; &nbsp; &nbsp;
                        </div>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";

                        ?>
                        <!-- 댓글의 댓글 수정하기 -->
                        <?php
                        if ($r_e == 'Y' and $d_no == $d['no'] and $rq == 'N' and $d_2no == $d_2['no']) {
                          ?>
                          <form action="./reply_edit.php" name="reply_edit" method="post">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                            <input type="hidden" name="bbs1_no" value="<?php echo $data['no']; ?>">
                            <input type="hidden" name="replys" value="<?php echo $d_2['no']; ?>">

                            <tr>
                              <td id="lo_reply_3" style="border-style: none;">
                                <span style="font-size:11px; color:#8a8a88">└</span> &nbsp;&nbsp;
                                <div style="display:inline-block; width:95%;">
                                  <textarea name="memo" style="width:100%; height:auto; resize: none;"><?php echo $d_2['memo']; ?></textarea>
                                </div>
                              </td>

                              <td style="border-style: none;">
                                <div style="float:left;">
                                  <input class="btn btn-primary" type="submit" value="수정" style="width:80px; height:auto">
                                </div>
                              </td>
                            </tr>
                          </form>
                        <?php
                        }
                        ?>
                        <!-- 댓글의 댓글 수정하기 끝 -->

                      <?php
                      }
                      ?>
                      <!-- 코멘트 댓글의 댓글 출력 끝 -->

                      <!-- 코멘트 댓글의 댓글 입력하기 -->
                      <?php
                      if ($re_wt == 'Y' and $d_no == $d['no']) {
                        ?>
                        <form action="./comment_write.php" name="replys" method="post">
                          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                          <input type="hidden" name="bbs1_no" value="<?php echo $data['no']; ?>">
                          <input type="hidden" name="replys" value="<?php echo $d['no']; ?>">

                          <tr>
                            <td id="lo_reply_2" style="border-style: none;">
                              <span style="font-size:11px; color:#8a8a88">└</span> &nbsp;&nbsp;
                              <div style="display:inline-block; width:95%;">
                                <textarea name="memo" style="width:100%; height:auto; resize: none;"></textarea>
                              </div>
                            </td>

                            <td style="border-style: none;">
                              <div style="float:left;">
                                <input class="btn btn-primary" type="submit" value="등록" style="width:80px; height:auto">
                              </div>
                            </td>
                          </tr>
                        </form>
                      <?php
                      }
                      ?>
                      <!-- 댓글의 댓글 입력 끝 -->

                      <!-- 댓글 수정하기 -->
                      <?php
                      if ($r_e == 'Y' and $d_no == $d['no'] and $rq == 'Y') {
                        ?>
                        <form action="./reply_edit.php" name="reply_edit" method="post">
                          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                          <input type="hidden" name="bbs1_no" value="<?php echo $data['no']; ?>">
                          <input type="hidden" name="replys" value="<?php echo $d['no']; ?>">

                          <tr>
                            <td id="lo_reply_3" style="border-style: none;">
                              <span style="font-size:11px; color:#8a8a88">└</span> &nbsp;&nbsp;
                              <div style="display:inline-block; width:95%;">
                                <textarea name="memo" style="width:100%; height:auto; resize: none;"><?php echo $d['memo']; ?></textarea>
                              </div>
                            </td>

                            <td style="border-style: none;">
                              <div style="float:left;">
                                <input class="btn btn-primary" type="submit" value="수정" style="width:80px; height:auto">
                              </div>
                            </td>
                          </tr>
                        </form>
                      <?php
                      }
                      ?>
                      <!-- 댓글 수정하기 끝 -->

                    <?php
                    } // while 최종, 댓글 관련 끝
                    ?>

                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
                <!-- 댓글 테이블 끝 -->

                <!-- 코멘트 (입력) -->
                <?php
                if ($member[user_id]) { // 회원아이디가 있으면 실행
                  ?>
                  <table class="table table-sm">
                    <tr>
                      <form action="comment_write.php" name="replys" method="post">
                        <input type="hidden" name="bbs1_no" value="<?php echo $data['no']; ?>" title="게시판글 번호">
                        <input type="hidden" name="replys" value="0"> <!-- 일반 코멘트 입력 -->
                        <input type="hidden" name="id" value="<?php echo $data['id']; //게시판번호아이디 
                                                              ?>">

                        <td style="border-style:none">&nbsp;</td>

                        <td style="border-style: none;">
                          <?php
                          if ($member['nick_name']) {
                            echo $member['nick_name'];
                          } else {
                            echo $member['name'];
                          } ?></td>

                        <td style="border-style: none; width: 66%; height: 88px; float:left">
                          <textarea name='memo' cols=80 rows=3 style='max-width:100%; max-height: 100%; resize: none;' placeholder="댓글을 입력하세요"></textarea>
                        </td>
                        <td style="border-style: none; float: left;"> <input class="btn btn-primary" type=submit value='등록' style="float:left;"></td>

                      </form>
                    </tr>
                  </table>
                <?php } //회원아이디가 있으면 여기까지 
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- 게시글 보기 끝 -->


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
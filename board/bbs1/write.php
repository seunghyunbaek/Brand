<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- 부트스트랩 -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <title>게시판 글쓰기</title>

    <?php
    include("../../lib/db_connect.php");
    $connect = dbconn();
    $member = member();
    if (!$member['user_id']) Error("로그인 후 이용해주세요.");

    $id = $_GET['id'];
    $genre = $_GET['genre'];
    ?>
    <script type="text/javascript" src="../../SmartEditor2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
    <style>
        body {
            margin: 10px;
        }

        .where {
            display: block;
            margin: 25px 15px;
            font-size: 11px;
            color: #000;
            text-decoration: none;
            font-family: verdana;
            font-style: italic;
        }

        .filebox input[type="file"] {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .filebox label {
            display: inline-block;
            padding: .5em .75em;
            color: #999;
            font-size: inherit;
            line-height: normal;
            vertical-align: middle;
            background-color: #fdfdfd;
            cursor: pointer;
            border: 1px solid #ebebeb;
            border-bottom-color: #e2e2e2;
            border-radius: .25em;
        }

        /* named upload */
        .filebox .upload-name {
            display: inline-block;
            padding: .5em .75em;
            font-size: inherit;
            font-family: inherit;
            line-height: normal;
            vertical-align: middle;
            background-color: #f5f5f5;
            border: 1px solid #ebebeb;
            border-bottom-color: #e2e2e2;
            border-radius: .25em;
            -webkit-appearance: none;
            /* 네이티브 외형 감추기 */
            -moz-appearance: none;
            appearance: none;
        }

        /* imaged preview */
        .filebox .upload-display {
            margin-bottom: 5px;
        }

        @media(min-width: 768px) {
            .filebox .upload-display {
                display: inline-block;
                margin-right: 5px;
                margin-bottom: 0;
            }
        }

        .filebox .upload-thumb-wrap {
            display: inline-block;
            width: 54px;
            padding: 2px;
            vertical-align: middle;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .filebox .upload-display img {
            display: block;
            max-width: 100%;
            width: 100% \9;
            height: auto;
        }

        .filebox.bs3-primary label {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
    </style>
</head>

<body>
    <!-- 헤더 시작 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <?php
            $query_title = "select * from bbs1_name where id='$id'";
            $result_title = mysql_query($query_title, $connect);
            $data_title = mysql_fetch_array($result_title);
            ?>
            <a class="navbar-brand" href="./<?php echo $data_title[id];?>.php"><?php echo $data_title[name]; ?></a>
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

    <br><br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody>
                        <form action="./write_post.php" name="write" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="genre" value="<?php echo $genre; ?>">
                            <input type="hidden" name="user_id" size="15" value="<?php echo $member['user_id']; ?>" readonly='readonly'>
                            <input type="hidden" name="name" size="15" value="<?php echo $member['name']; ?>" readonly="readonly">
                            <input type="hidden" name="nick_name" size="15" value="<?php echo $member['nick_name']; ?>" readonly="readonly">

                            <tr>
                                <td>
                                    <li>제목 : &nbsp; <input type="text" name="subject" style="width:500px; height:30px">
                                </td>
                                </li>
                            </tr>

                            <tr>
                                <td>
                                    <textarea id="ir1" name="story" style="width:100%; height:400px;"></textarea>
                                </td>
                            </tr>

                            <script type="text/javascript">
                                var oEditors = [];

                                var sLang = "ko_KR"; // 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR

                                // 추가 글꼴 목록
                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                nhn.husky.EZCreator.createInIFrame({
                                    oAppRef: oEditors,
                                    elPlaceHolder: "ir1",
                                    sSkinURI: "../../SmartEditor2/SmartEditor2Skin.html",
                                    fCreator: "createSEditor2"
                                });

                                function submitContents(elClickedObj) {
                                    oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.

                                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                    try {
                                        elClickedObj.form.submit();
                                    } catch (e) {}
                                }
                            </script>

                            <tr>
                                <td>
                                    <!-- <input type="file" name="file01"> -->
                                    <!-- <div class="filebox"> <label for="ex_file">업로드</label> <input type="file" id="ex_file"> </div> -->

                                    <div class="filebox bs3-primary preview-image">
                                        <input class="upload-name" value="파일선택" disabled="disabled" style="width: 200px;">

                                        <label for="input_file">업로드</label>
                                        <input type="file" id="input_file" class="upload-hidden" name="file01">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="전송" onclick="submitContents()" style="float:right">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <!-- 푸터 시작 -->
    <div style="margin-bottom:100px;"></div>

    <!-- FOOTER -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="position: fixed; bottom:0; width:100%;">
        <div class="container text-center">
            <small>Copyright &copy; Brand</small>
        </div>
    </footer>
    <!-- 푸터 끝 -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="../../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var fileTarget = $('.filebox .upload-hidden');

            fileTarget.on('change', function() {
                if (window.FileReader) {
                    // 파일명 추출
                    var filename = $(this)[0].files[0].name;
                } else {
                    // Old IE 파일명 추출
                    var filename = $(this).val().split('/').pop().split('\\').pop();
                };

                $(this).siblings('.upload-name').val(filename);
            });

            //preview image 
            var imgTarget = $('.preview-image .upload-hidden');

            imgTarget.on('change', function() {
                var parent = $(this).parent();
                parent.children('.upload-display').remove();

                if (window.FileReader) {
                    //image 파일만
                    if (!$(this)[0].files[0].type.match(/image\//)) return;

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var src = e.target.result;
                        parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img src="' + src + '" class="upload-thumb"></div></div>');
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(this)[0].select();
                    $(this)[0].blur();
                    var imgSrc = document.selection.createRange().text;
                    parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img class="upload-thumb"></div></div>');

                    var img = $(this).siblings('.upload-display').find('img');
                    img[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\"" + imgSrc + "\")";
                }
            });
        });
    </script>
</body>

</html>
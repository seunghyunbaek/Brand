<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>회원가입</title>

    <!-- 부트스트랩 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        video {
            position: fixed;
            top: 0;
            left: -10vw;
            width: auto;
            height: 100vh;
            z-index: -1;
        }

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
    <script type="text/javascript">

        function openCheckId() {
            var user_id = document.all.user_id.value;
            if (user_id) {
                url = "idcheck.php?user_id=" + user_id;
                window.open(url, "chkid", "width=500,height=300,menubar=no,toolbar=no");
            } else {
                alert("ID를 입력하세요!");
            }
        }

        function chkForm() {
            var checkid = document.all.checkid.value;
            if (checkid == 0) {
                alert("ID 중복체크를 하세요!");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <!-- 배경 영상 시작 -->
    <video autoplay loop>
        <!-- 담비 -->
        <source src="./bom_dia_hello.mp4" type="video/mp4">
    </video>
    <!-- 배경 영상 끝 -->

    <!-- 헤더 시작 -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Brand <span class="sr-only">(current)</span></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class='navbar-nav ml-md-auto'>
                    <h6><a href=./login2.php>Sign In</a> </h6> </span> </div> </div> </nav> <!-- 헤더 끝 -->

                            <!-- 아이디, 비밀번호, 닉네임, 이름, 이메일 -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5" style="margin:2% auto; background-color:#ffffff00">
                                        <form role="form" action="./join_post2.php" method="post" onSubmit="return chkForm();">

                                            <input type="hidden" name="checkid" value=0>

                                            <h4 class="text-center">회원가입</h4> <br>

                                            <input type="hidden" name="id" value="member">
                                            <div class="form-group">

                                                <label for="exampleInputID">
                                                    아이디
                                                </label>
                                                <input class="btn btn-outline-primary m-2" type="button" value="ID중복확인" onClick="openCheckId();">
                                                <input type="text" id="exampleInputID" name="user_id" class="form-control" placeholder="아이디 12자리 영문소문자+숫자" required="required" />
                                            </div>
                                            <div class="form-group">

                                                <label for="exampleInputPassword1">
                                                    비밀번호
                                                </label>
                                                <input type="password" id="exampleInputPassword1" name="pw" class="form-control" placeholder="비밀번호 8-16자리 영문+숫자+특수문자 조합(필수)" required="required" style="font-size:0.98rem;" />
                                            </div>
                                            <div class="form-group">

                                                <label for="exampleInputNickName">
                                                    닉네임
                                                </label>
                                                <input type="text" id="exampleInputNickName" name="nick_name" class="form-control" placeholder="닉네임을 입력하세요" required="required" />
                                            </div>
                                            <div class="form-group">

                                                <label for="exampleInputName">
                                                    이름
                                                </label>
                                                <input type="text" id="exampleInputName" name="name" class="form-control" placeholder="이름을 입력하세요(2-5자)" required="required" />
                                            </div>
                                            <div class="form-group">

                                                <label for="exampleInputEmail1">
                                                    이메일
                                                </label>
                                                <input type="email" id="exampleInputEmail1" name="email" class="form-control" placeholder="이메일을 입력하세요" required="required" />
                                            </div>
                                            <button type="submit" class="btn btn-outline-primary" style="float:right;">
                                                가입하기
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                            
                            <script src="../js/bootstrap.min.js"></script>
</body>

</html>
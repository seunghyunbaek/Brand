<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>로그인</title>

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
                <h6><a href=./join2.php>Sign Up</a></h6>
            </span>
        </div>
    </div>
</nav>

<!-- 헤더 끝 -->


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5> <br>
                        <form class="form-signin" action="./login_post2.php" method="post">
                            <div class="form-gruop">
                                <label for="id">아이디</label>
                                <input type="text" id="id" name="user_id" class="form-control" placeholder="ID" required autofocus>
                            </div>
                            <br>
                            <div class="form-gruop">
                                <label for="inputPassword">비밀번호</label>
                                <input type="password" id="inputPassword" name="pw" class="form-control" placeholder="Password" required>
                            </div>
                            <br>
                            <div class="custom-control custom-checkbox mb-3">
                                <!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->
                                <!-- <label class="custom-control-label" for="customCheck1">Remember password</label> -->
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
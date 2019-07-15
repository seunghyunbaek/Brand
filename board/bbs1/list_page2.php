<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

<div class="container">
    <ul class="pagination justify-content-center">
        <?php
        // 총 게시물 $total
        // 한 페이지에 나타낼 게시글 수 $view_total
        $rr = ceil($total/$view_total);
        

        // 이전 페이지 구하기
        $before = $_page-1; // 현재 페이지수 에서 -1을 준다
        if($before < 1) $before = 1;

        // 다음 페이지 구하기
        $next = $_page + 1;
        if($next > $rr) $next = $rr;

        // 그룹페이지 구성
        // (처음)
        if($_page%10) {
            $goto = $_page-$_page%10+1; // 한 그룹당 10개 페이지를 지정 '10'을 넘기면 1을 증가.
        } elseif($goto=$_page-9); // '10'을 넘지 않으면 -9
        // (끝)


        // 그룹펭지 구성 (끝)
        $last = $goto + 10; // 예) $goto='1'이라면 $last='11'이 되어야 합니다.

        // 이전페이지 그룹 출력
        $before_group = $goto-1;
        if($bofore_group < 1) { 
            $before_group = 1;
        }
        // if($_page != 1) echo ("<li class=page-item><a class=page-link href=$PHP_SELF?_page=$before_group$href>◀ $goto : $before_group</a></li> &nbsp;"); // 이전페이지 그룹출력 // PHP_SELF: 현재 자신의 페이지에서 페이지 이름을 리턴해주는 역할
        if($_page != 1) echo ("<li class=page-item><a class=page-link href=$PHP_SELF?_page=$before_group$href>◀ $goto : $before_group</a></li> &nbsp;"); // 이전페이지 그룹출력 // PHP_SELF: 현재 자신의 페이지에서 페이지 이름을 리턴해주는 역할

        // 페이지 번호 출력
        for($e=$goto; $e < $last; $e++) { // 현재 페이지가 전체페이지보다 작으면 페이지를 증가
            if($e > $rr) break; // 총 나타낼 페이지 번호보다 크면 멈추고 다음을 실행
            if($e == $_page) echo ("<li class=page-item><a class=page-link href=javascript:void(0); style='cursor:default;'><strong>$e</strong></a></li>"); // $e와 페이지 번호가 서로 같으면
            else echo("&nbsp; <li class=page-item><a class=page-link href=$PHP_SELF?_page=$e$href>$e</a></li>&nbsp;"); // $e와 $_page번호가 서로 같지 않으면...
        }

        // 다음페이지 그룹 출력
        $next_group = $last;
        if($next_group > $rr) {
            $next_group = $rr; // $next_group은 $rr보다 크면 $rr은 $next_group이 된다.
        }
        if($_page != $rr && $total > 0) echo ("&nbsp; <li class=page-item><a class=page-link href=$PHP_SELF?_page=$next_group$href>▶</a></li>");

        // echo $rr.":".$total.":".$_page;
        ?>
    </ul>
</div>
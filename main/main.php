<!--커뮤니티 순위-->
<div id="community_hot">
    <h1>Real-time</br>COMMUNITY</h1>
    <div id= "rank">

<!--php 연동-->
<?php
    $con = mysqli_connect("localhost", "root", "1234", "login");
    $sql = "select * from board order by hit desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        $i = 0;
        while( $row = mysqli_fetch_array($result) )
        {
            $i++;
            $num[$i] = $row["num"];
            $subject[$i] = $row["subject"];
        }
    }
?>

    <div id= "box">
        <li class="num" style="padding:5px;">1</li>
        <li class="txt"><a href="board_view.php?num=<?=$num[1]?>&page=1"><?=$subject[1]?></a></li>
    </div>
    <div id="line"></div>
    <div id= "box">
        <li class="num">2</li>
        <li class="txt"><a href="board_view.php?num=<?=$num[2]?>&page=1"><?=$subject[2]?></a></li>
    </div>
    <div id="line"></div>
    <div id= "box">
        <li class="num">3</li>
        <li class="txt"><a href="board_view.php?num=<?=$num[3]?>&page=1"><?=$subject[3]?></a></li>
    </div>
    <div id="line"></div>
    <div id= "box">
        <li class="num">4</li>
        <li class="txt"><a href="board_view.php?num=<?=$num[4]?>&page=1"><?=$subject[4]?></a></li>
    </div>
    <div id="line"></div>
    <div id= "box">
        <li class="num">5</li>
        <li class="txt"><a href="board_view.php?num=<?=$num[5]?>&page=1"><?=$subject[5]?></a></li>
    </div>
    <div id="line"></div>
    </div>
</div>

<!--기사-->
<div id="article">
    <h1>Article</h1>
    <div id= "rank">
    <div id= "box"><li><a href="https://www.digitaltoday.co.kr/news/articleView.html?idxno=210586" target="blank">편의점 4캔 만원 행사에 국내 대형 맥주 업계 주춤…</a></li></div>
    <div id= "box"><li><a href="https://www.gukjenews.com/news/articleView.html?idxno=2448273" target="blank">충북 영동 포도의 고장 와인 축제 열려…</a></li></div>
    <div id= "box"><li><a href="https://health.chosun.com/site/data/html_dir/2012/12/07/2012120701828.html" target="blank">폭탄주 일명 “쏘맥”, 섞어마시면 숙취 40% 상승, 치매 위험…</a></li></div>
    </div>
</div>

<!--사진-->
<div id="photo_box">
    <div id="photo"><a href="board_view.php?num=11&page=1"><img src="./img/new/막걸리/세로_나루생.jpg"></a></div>
    <div id="photo"><a href="board_view.php?num=10&page=1"><img src="./img/new/막걸리/세로_택이.jpg"></a></div>
    <div id="photo"><a href="board_view.php?num=22&page=1"><img src="./img/new/소주/세로_토끼소주.jpg"></a></div>
    <div id="photo"><a href="board_view.php?num=29&page=1"><img src="./img/new/와인/너브내스파클링.jpg"></a></div>
    <div id="photo2"><a href="board_view.php?num=35&page=1"><img src="./img/new/맥주/세로_버드나무.jpg"></a></div>
</div>


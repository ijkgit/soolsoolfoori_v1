<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>술술푸리 > 막걸리 </title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
<link rel="stylesheet" type="text/css" href="./css/board2.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>
<div id="bbox">
	<h1>TOP Seller</h1>
	<div id="photo_box">
		<div id="photo"><a href="board_view.php?num=8&page=1"><img src="./img/new/막걸리/세로_술취한원숭이.jpg"></a></div>
		<div id="photo"><a href="board_view.php?num=9&page=1"><img src="./img/new/막걸리/세로_복순도가.jpg"></a>	</div>
		<div id="photo"><a href="board_view.php?num=10&page=1"><img src="./img/new/막걸리/세로_택이.jpg"></div>
	</div>
	<div id="hashtag">
	<a href="board_view.php?num=30&page=1"><div id="h4box">#제주 페일에일</div></a>
		<a href="board_view.php?num=18&page=1"><div id="h2box">#원소주</div></a>
		<a href="board_view.php?num=17&page=1"><div id="h4box">#콜라보레이션</div></a>
		<a href="board_view.php?num=25&page=1"><div id="h3box">#와인축제</div></a>
		<a href="board_view.php?num=15&page=1"><div id="h2box">#문배주</div></a>
		<a href="board_view.php?num=23&page=1"><div id="hbox">#우포의 아침</div></a>
		<a href="board_view.php?num=16&page=1"><div id="h3box">#이강주</div></a>
		<a href="board_view.php?num=24&page=1"><div id="hbox">#매실 원주</div></a>
	</div>
	
	<div id="newbox">
	<h1>NEW!!</h1>
		<div id="newphoto"><a href="board_view.php?num=8&page=1"><img src="./img/new/막걸리/가로_술취한원숭이.jpg"><h2>술 취한 원숭이</h2></a></div>
		<div id="newphoto"><a href="board_view.php?num=6&page=1"><img src="./img/new2.png"><h2>설빙 인절미 순희</a></h2></div>
		<div id="newphoto"><a href="board_view.php?num=7&page=1"><img src="./img/new/막걸리/가로_핑크서울.jpg"><h2>핑크 서울</a></h2></div>
	</div>

<section>
   	<div id="board_box">
	    <h3>
	    	막걸리 게시판 > 목록보기
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col6">조회</span>
					<span class="col5">등록일</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost", "root", "1234", "login");
	$sql = "select * from board where (category=1) order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num         = $row["num"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $hit         = $row["hit"];
	  $check	   = $row["ischeck"];
	  $category    = $row["category"];
	  
	  $sql4 = "create table if not exists reply_{$num} (
		num int not null auto_increment,
		id char(15) not null,
		name char(10) not null,
		content text not null,
		regist_day char(20) not null,
		primary key(num),
		ischeck int
		);";
	
		mysqli_query($con, $sql4);

	  $sql3 = "select * from reply_$num";
	  $result3 = mysqli_query($con, $sql3);
	  $reply_num = mysqli_num_rows($result3); // 전체 댓글 수
	  
	 
	  if($check) $name = "익명";
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col22"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?>&nbsp;<span style="color:red">[<?=$reply_num?>]</span></a></span>
					<span class="col3"><?=$name?></span>
					
					<span class="col6"><?=$hit?></span>
					<span class="col5"><?=$regist_day?></span>
				</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
				
			<ul class="buttons">
				<li><button onclick="location.href='board_list.php'">목록</button></li>

<?php 
    if($userid) {
?>			
			<form name="insert" method="post" action="board_form.php">
			<li><button onclick="location.href='board_form.php'">글쓰기</button>
			<input type="hidden" name="category" value="<?=$category?>">
			</form>
			
				
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
				
			</ul>
			
	</div> <!-- board_box -->
	
</section>
</div>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>

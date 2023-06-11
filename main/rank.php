<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>술술푸리 > 랭킹</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/rank.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="message_box">
	    <h3>RANK</h3>
	    <div id = "view_rank">
	    	<ul id="message">
				<li>
					<span class="col1">순위</span>
					<span class="col2">이름</span>
                    <span class="col3">게시글수</span>
					<span class="col4">점수</span>
					<span class="col5">가입일</span>
				</li>
<?php
    $page = 1;
	$con = mysqli_connect("localhost", "root", "1234", "login");
	$sql = "select * from members order by point desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 사람 수

	$scale = 100;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1;
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = 1;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num    = $row["num"];
	  $id     = $row["id"];
      $point  = $row["point"];
      $regist_day = $row["regist_day"];	
      
      $sql2 = "select * from board where (id='$id');";
      $result2 = mysqli_query($con, $sql2);
      $post_num = mysqli_num_rows($result2);

?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><?=$id?></span>
                    <span class="col3"><?=$post_num?></span>
					<span class="col4"><?=$point?></span>
					<span class="col5"><?=$regist_day?></span>
				</li>	
<?php
   	   $number++;
   }
   mysqli_close($con);
?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>술술푸리 > 막걸리 게시판</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board2.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
<?php
	date_default_timezone_set('Asia/Seoul');
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "1234", "login");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];
	$check = $row["ischeck"];
	$category = $row["category"];

	if($check) $name = "익명";
	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	if ($category == 1) $title = '막걸리';
	else if ($category == 2) $title = '소주';
	else if ($category == 3) $title = '와인';
	else $title = '맥주';

?>

   	<div id="board_box">
	    <h3 class="title">
			<a href="board<?php if($category != 1) echo $category; ?>_list.php"> <?=$title?> 게시판 > 내용보기</a>
		</h3>
<?php

	$sql = "create table if not exists reply_{$num} (
		num int not null auto_increment,
		id char(15) not null,
		name char(10) not null,
		content text not null,
		regist_day char(20) not null,
		primary key(num),
		ischeck int
		);";
	
	mysqli_query($con, $sql);

	$new_hit = $hit + 1;
	$sql = "update board set hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					// function resize_image($file, $newfile, $w, $h) {
					// 	list($width, $height) = getimagesize($file);
					// 	if(strpos(strtolower($file), ".jpg"))
					// 	   $src = imagecreatefromjpeg($file);
					// 	else if(strpos(strtolower($file), ".png"))
					// 	   $src = imagecreatefrompng($file);
					// 	else if(strpos(strtolower($file), ".gif"))
					// 	   $src = imagecreatefromgif($file);
					// 	$dst = imagecreatetruecolor($w, $h);
					// 	imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
					// 	if(strpos(strtolower($newfile), ".jpg"))
					// 	   imagejpeg($dst, $newfile);
					// 	else if(strpos(strtolower($newfile), ".png"))
					// 	   imagepng($dst, $newfile);
					// 	else if(strpos(strtolower($newfile), ".gif"))
					// 	   imagegif($dst, $newfile);
					// }
					
					// resize_image("./data/".$file_copied, "./data/".$file_name, 200, 100);
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				
				
				if($file_name) {
					?>
				<img src="<?=$file_path?>" style="width:300px; height:auto;">
				<?php
				}
				?>
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
				<?php
				if($_SESSION["userid"] == $id) {
					?>
				<li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
					<?php
					} // 본인만 글 삭제 가능
					?>
				<li><button onclick="location.href='board_form.php'">글쓰기</button></li>
		</ul>

<?php
	$con = mysqli_connect("localhost", "root", "1234", "login");
	$sql = "select * from reply_{$num}";
	$result = mysqli_query($con, $sql);

	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;
	
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 30;

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
	
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$content    = $row["content"];
	$check = $row["ischeck"];
	if($check) $name = "익명";

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);
?>
		 <ul id="view_comment">
			
			<li><?=$name?> | <?=$regist_day?></li>
			<ul class= content><b>내용 : <?=$content?> </b></ul>
			
<?php $number--; 
} 
mysqli_close($con);
?>
</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='board_view.php?num=$num&page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=2; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_view.php?num=$num&page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='board_view.php?num=$num&page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
	<div id="commentbox">
		<form name ="reply_form" method="post" action="reply_insert.php?num=<?=$num?>" enctype=multipart/form-data">
			<div id="checkbox">
				<div id="check"><input type="checkbox" name="check"><h1>익명으로 작성하기</h1></input></div>
			</div>
			<div id="input">
				<div id="textbox"><textarea name="content" placeholder="내용을 입력하세요."></textarea></div>
				<div id="buttons"><button onclick="location.href='reply_insert.php?num=<?=$num?>'">등록</button></div>
			</div>
		</form>			   	
	</div> <!-- reply -->
</div> <!-- board_box -->
</div>
</section>

<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>술술푸리 > 메세지 작성</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
<script>
  function check_input() {
  	  if (!document.message_form.rv_id.value)
      {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<?php
	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>
<section>
   	<div id="message_box">
	    <h3 id="write_title">
	    		SEND
		</h3>
		<!-- <ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
				<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
		</ul> -->
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>">
	    	<div id="write_msg">
	    	    <ul>
				<!-- <li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span>
				</li>	 -->
				<li id ="a">
					<span class="col2"><input name="rv_id" type="text" placeholder="수신자"></span>
				</li>	
	    		<li id ="a">
	    			<span class="col2"><input name="subject" type="text" placeholder="제목"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col2">
	    				<textarea name="content" placeholder="내용" style="resize:none"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
				<ul class="b">
	    	    <button type="button" onclick="check_input()">보내기</button>
				<button type="button" style="display:block; margin-top: -20px;" onclick="location.href='message_box.php?mode=rv'">뒤로가기</button>
				</ul>
	    	</div>	    	
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>

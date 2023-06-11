<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>술술푸리 > 정보 수정</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
<script type="text/javascript" src="./js/member_modify.js"></script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
<?php    
   	$con = mysqli_connect("localhost", "root", "1234", "login");
    $sql    = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];

    // $email = explode("@", $row["email"]);
	$email = $row["email"];
    $email1 = $email;

    mysqli_close($con);
?>
	<section>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" method="post" action="member_modify.php?id=<?=$userid?>">
			    <h2>Modify</h2>
    		    	<!-- <div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<?=$userid?>
				        </div>                 
			       	</div> -->
			       	<div class="clear"></div>

			       	<div class="form">
				        <!-- <div class="col1">비밀번호</div> -->
				        <div class="col2">
							<input type="password" name="pass"  placeholder="변경할 비밀번호">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <!-- <div class="col1">비밀번호 확인</div> -->
				        <div class="col2">
							<input type="password" name="pass_confirm"  placeholder="비밀번호 확인">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <!-- <div class="col1">이름</div> -->
				        <div class="col2">
							<input type="text" name="name" value="<?=$name?>" placeholder="이름">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <!-- <div class="col1">이메일</div> -->
				        <div class="col2">
							<input type="text" name="email1" value="<?=$email1?>" placeholder="이메일">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
                  		<!-- <img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif"
                  			onclick="reset_form()"> -->
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>


<meta charset="utf-8">
<?php
date_default_timezone_set('Asia/Seoul');
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    if ( !$userid )
    {
        echo("
                    <script>
                    alert('댓글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }

    $content = $_POST["content"];
	$num = $_GET["num"];

	$content = htmlspecialchars($content, ENT_QUOTES);

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	
	$con = mysqli_connect("localhost", "root", "1234", "login");

	if(isset($_POST["check"])) $check = 1; 
	else $check = 0;
	
	$sql = "insert into reply_{$num} (id, name, content, regist_day, ischeck) ";
	$sql .= "values('$userid', '$username', '$content', '$regist_day', '$check');";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	// 포인트 부여하기
  	$point_up = 100;

	$sql = "select point from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_point = $row["point"] + $point_up;
	
	$sql = "update members set point=$new_point where id='$userid'";
	mysqli_query($con, $sql);

	mysqli_close($con);                // DB 연결 끊기

	echo "
	   <script>
	   history.go(-1);
	   </script>
	";
?>

  

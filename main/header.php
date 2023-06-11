<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>
<div id="sidemenu">
    <li><h1>Real-Time</br>Popular</h1></li>
    <li><a href="board_view.php?num=18&page=1">원소주</a></li>
    <li><a href="board_view.php?num=9&page=1">복순도가</a></li>
    <li><a href="board_view.php?num=20&page=1">서울의 밤</a></li>
    <li><a href="board_view.php?num=7&page=1">핑크 서울</a></li>
    <li><a href="board_view.php?num=30&page=1">제주 페일에일</a></li>
</div>

<div id="top">
    <div id= "topbox">
    <a href="index.php"><img src="./img/new/로고02.png"></img></a>
    </div>
    <ul id="top_menu">
<?php
    if(!$userid) {
?>              
                <li><a href="rank.php" style="color:red;" >Rank</a></li>
                <li><a href="login_form.php">Login</a></li>
                <li><a href="member_form.php">Sign Up</a> </li>
    </ul>
<?php
    }
    else if($userlevel==1) {
?>
                <li><a href="admin.php" style="color:red;">AdminMode</a></li>
                <li><a href="rank.php" style="color:red;" >Rank</a></li>
                <li><a href="message_box.php?mode=rv.php"  >Message</a></li>
                <li><a href="logout.php" >Logout</a> </li>
                <li><a href="member_modify_form.php" >Modify</a></li>
    </ul>
    <div id="login_info"><h1>Hello,<br><?=$username?></h1>&nbsp;님<br>Level:&nbsp;<?=$userlevel?><br>Point:&nbsp;<?=$userpoint?></div>
<?php
    }
    else {
?>              
                <li><a href="rank.php" style="color:red;" >Rank</a></li>
                <li><a href="message_box.php?mode=rv.php" >Message</a></li>
                <li><a href="logout.php" >Logout</a> </li>
                <li><a href="member_modify_form.php" >Modify</a></li>
            </ul>
        
 
<div id="login_info"><h1>Hello,<br><?=$username?></h1>&nbsp;님<br>Level:&nbsp;<?=$userlevel?><br>Point:&nbsp;<?=$userpoint?></div>

</div>               
<?php
    }
?>
</div>


<div id="menu_bar">
    <li><a href="board_list.php">Makgeolli</a></li>
    <li><a href="board2_list.php">Soju</a></li>
    <li><a href="board3_list.php">Wine</a></li>
    <li><a href="board4_list.php">Brew</a></li>
</div>        
</div>
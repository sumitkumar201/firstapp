<?php
ob_start();

if(array_key_exists('logout',$_GET))
{
	session_start();
	unset($_SESSION['userdata']);
	session_destroy();
	
	setcookie("myusers_email",$mail,time()-(24*60*60*30));//myusers email cookie deleted
	
	echo "<h2 style='color:blue' align='center'>Thanks for stopping by!</h2>";
	echo "<div align='center'>";
	echo "<br>Click below to return login page<br>";
	echo "<a href='http://127.0.0.1/twitterapp/index.php'>log in again</a>";

	echo "</div>";
	}
?>
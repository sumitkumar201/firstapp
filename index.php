<?php
//start session
ob_start();
session_start();

if(!isset($_COOKIE["myusers_email"]) && $_SESSION['userdata']) {
    header("location:login.php");
} else {
   
// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)
include_once("config.php");
include_once("inc/twitteroauth.php");

//bhai log 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login with Twitter using PHP by CodexWorld</title>
    <style type="text/css">
	.wrapper{width:600px; margin-left:auto;margin-right:auto;}
	.welcome_txt{
		margin: 20px;
		background-color: #EBEBEB;
		padding: 10px;
		border: #D6D6D6 solid 1px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}
	.tweet_box{
		margin: 20px;
		background-color: #FFF0DD;
		padding: 10px;
		border: #F7CFCF solid 1px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}
	.tweet_box textarea{
		width: 500px;
		border: #F7CFCF solid 1px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}
	.tweet_list{
		margin: 20px;
		padding:20px;
		background-color: #E2FFF9;
		border: #CBECCE solid 1px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}
	.tweet_list ul{
		padding: 0px;
		font-family: verdana;
		font-size: 12px;
		color: #5C5C5C;
	}
	.tweet_list li{
		border-bottom: silver dashed 1px;
		list-style: none;
		padding: 5px;
	}
	</style>
</head>
<body>
<?php
	if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') 
	{
		//Retrive variables
		$screen_name 		= $_SESSION['request_vars']['screen_name'];
		$twitter_id			= $_SESSION['request_vars']['user_id'];
		$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
		$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
		
		//site title
		
		echo "<div align='center' style='background-color:white;padding:20px;'><h1 style='color:Blue;'>Twitter Campaign Test </h1></div>";
		
		
		
		//Show welcome message
		echo '<div class="welcome_txt">Welcome <strong>'.$screen_name.'</strong> (Twitter ID : '.$twitter_id.'). <a href="logout.php?logout">Logout</a>!</div>';
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
		
		/*
		//If user wants to tweet using form.
		if(isset($_POST["updateme"])) 
		{
			//Post text to twitter
			$my_update = $connection->post('statuses/update', array('status' => $_POST["updateme"]));
			die('<script type="text/javascript">window.top.location="index.php"</script>'); //redirect back to index.php
		}
		
		//show tweet form
		echo '<div class="tweet_box">';
		echo '<form method="post" action="index.php"><table width="200" border="0" cellpadding="3">';
		echo '<tr>';
		echo '<td><textarea name="updateme" cols="60" rows="4"></textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Tweet" /></td>';
		echo '</tr></table></form>';
		echo '</div>';
		
		//Get latest tweets
		$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $screen_name, 'count' => 5));
		
		echo '<div class="tweet_list"><strong>Latest Tweets : </strong>';
		echo '<ul>';
		foreach ($my_tweets  as $my_tweet) {
			echo '<li>'.$my_tweet->text.' <br />-<i>'.$my_tweet->created_at.'</i></li>';
		}
		echo '</ul></div>';
		*/
		//Show List

		$my_lists = $connection->get('lists/list',array('screen_name'=>$screen_name,'count'=>5));
		print_r($my_lists);
		foreach ($my_lists  as $my_list) {
			
			// explode($my_list);
			//echo '<li>'.$my_list->text.' <br />-<i>'.$my_list->created_at.'</i></li>';
		}
		echo '</ul></div>';
		$baseUrl = accessTokenURL();
	   $oauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

$url = $baseUrl;
do {
    $oauth->fetch($url);
    $buf = $oauth->getLastResponse();
    $data = json_decode($buf, true);
    foreach ($data['users'] as $user) {
        echo $user['screen_name'], PHP_EOL;
    }
    $url = $baseUrl . '?cursor=' . $data['next_cursor'];
} while (!empty($data['next_cursor']));
			
	}else{
		//Display login button
		echo "<div align='center' style='background-color:white;padding:20px;'><h1 style='color:blue;'>Twitter Campaign Test </h1></div>";
		echo  "<div align='center'><h1>Sign In </h1></div>";
		
		echo "<div align='center' style='padding:10px;'><a href='login.php'>Log in with Twitter campaign</a></div>";
		
		echo "<div align='center' style='padding:10px;'><a href='register.php'>Register in Twitter campaign</a></div>";
		echo '<hr><a href="process.php"><div align="center"><img src="images/sign-in-with-twitter.png" width="200" height="30" border="0px;" /></div></a>';
	}
	

//cookie else ends here	
}	
?>  
</body>
</html>
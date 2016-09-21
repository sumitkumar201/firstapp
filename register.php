<?php ob_start(); ?>
<?php

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = "";
$firstname = $lastname = $email = $password = "";

if (isset($_POST['submit'])){
	
	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

	if (empty($_POST["firstname"])) {
    $firstnameErr = "Name is required";
  } else {
    $firstname = test_input($_POST["firstname"]); 
	
	// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
      $firstnameErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["lastname"])) {
    $lastnameErr = "Name is required";
  } else {
    $lastname = test_input($_POST["lastname"]); 
	
	// check if last name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
      $lastnameErr = "Only letters and white space allowed"; 
    }
  }
	
	
	if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
	
	$password=$_POST['password'];
	
	if($_POST['password']==""){
		$passwordErr="password can not be empty";
	}
	
	
	
	
	include 'includes/functions.php';
	
	$ip=getIp();
	
	/*
	echo $firstname."<br>";
	echo $lastname."<br>";
	echo $email."<br>";
	echo $password."<br>";
	*/
	
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("tcp",$con);
	
	
	
	mysql_query("insert into myusers(firstname,lastname,email,password,ip,date,time) values('$firstname','$lastname','$email','$password','$ip',now(),now())",$con);
	
	if(mysql_affected_rows()>0){
		header("location:login.php");
	}
	else{
		echo "Registration failed";
	}
	
}	


?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Forms</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/datepicker3.css" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../assets/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->


</head>

<body>
	
<?php //include 'navbar.php';  ?>	
<?php //include 'sidebar.php';  ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Register</h1>
			</div>
		</div><!--/.row-->
				
		<?php //echo $firstname.$lastname.$s_email.$s_password; // for testing purpose?>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Please Register here!</div>
					<div class="panel-body">
						<div class="col-md-6">
						
							<form role="form" method="post" action="register.php" >
							
								<div class="form-group">
									<label>First name</label>
									<input type="text" name="firstname" class="form-control" placeholder="Enter First name" value="<?php echo $firstname;?>">
									<span class="error"> <?php echo $firstnameErr;?></span>
								</div>
								
								<div class="form-group">
									<label>Last name</label>
									<input type="text" name="lastname" class="form-control" placeholder="Enter Last name" value="<?php echo $lastname;?>">
									<span class="error"> <?php echo $lastnameErr;?></span>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $email;?>">
									<span class="error"> <?php echo $emailErr;?></span>
								</div>
																
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="password" class="form-control" value="<?php echo $password;?>">
									<span class="error"> <?php echo $passwordErr;?></span>
								</div>
								
								<div class="form-group checkbox">
								  <label>
								    <input type="checkbox">Remember me</label>
								</div>
								
								
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-default">Reset </button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
<!--
	<script src="..assets/js/jquery-1.11.1.min.js"></script>
	<script src="..assets/js/bootstrap.min.js"></script>
	<script src="..assets/js/chart.min.js"></script>
	<script src="..assets/js/chart-data.js"></script>
	<script src="..assets/js/easypiechart.js"></script>
	<script src="..assets/js/easypiechart-data.js"></script>
	<script src="..assets/js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
-->
</body>

</html>

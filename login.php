<?php
require_once 'class/User.php';
?>
<!DOCTYPE html>
<html>


<head>
	<title>Login</title>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<!-- Meta_tag_Keywords -->
	<link href="css/login.css" rel="stylesheet" type="text/css" media="all">
	<!--style_sheet-->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<!--font_awesome_icons-->

<body>
	<div class="form">
		<h1>Connective Login Form</h1>
		<div class="form-content">
			<form action="" method="post">
				<div class="form-info">
					<h2>Login</h2>
					<!---728x90--->

				</div>
				<div class="email-w3l">
					<span class="i1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
					<input class="email" type="email" name="email" placeholder="Email" required="">
				</div>
				<div class="pass-w3l">
					<span class="i2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
					<input class="pass" type="password" name="password" placeholder="Password" required="">
				</div>
				<div class="form-check">
					<div class="left">
						<input type="checkbox" value="Remember me">Remember me
					</div>
					<div class="right">
						<a href="#">Forgot Password?</a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="submit-agileits">
					<input class="login" name="login" type="submit" value="login">
				</div>
			</form>
		</div>
	</div>
	<!---728x90--->
	<footer>&copy; 2018 Connective login form. All rights reserved | Design by <a href="#">W3layouts</a></footer>
	<!---728x90--->

</body>

</html>

<?php
  if(isset($_POST['login'])){
    $email = $_POST['email'];
		$password = $_POST['password'];
		$user = new User;
    $user->login($email, $password);
  }

?>
<?php
require_once "class/User.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign up</title>

  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Space Register Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
  <!-- //Meta-Tags -->

  <!-- css files -->
  <link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
  <!-- css files -->

  <!-- Online-fonts -->
  <link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese"
    rel="stylesheet">
  <!-- //Online-fonts -->

</head>

<body>
  <!-- Main Content -->
  <div class="main">
    <div class="main-w3l">
      <h1 class="logo-w3">Space Register Form</h1>
      <!---728x90--->
      <div class="w3layouts-main">
        <h2><span>Register now</span></h2>
        <form action="" method="post">
          <input placeholder="Full Name" name="name" type="text" required="">
          <input placeholder="Email" name="email" type="email" required="">
          <input placeholder="Phone Number" name="phone" type="text" required="">
          <input placeholder="Password" name="pass" type="password" id="password1" required="">
          <input placeholder="Confirm Password" name="conpass" type="password" id="password2" required="">
          <input type="submit" value="Get Started" name="submit">
        </form>
      </div>
      <?php
        if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        $conpass = $_POST['conpass'];

        $user = new User;

        $user->insert($name, $email, $phone, $pass, $conpass);
        }
      ?>
      <!-- //main -->
      <!-- password-script -->
      <!-- //password-script -->
      <!---728x90--->
      <!--footer-->
      <div class="footer-w3l">
        <p>&copy; 2018 Space Register Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
      </div>
      <!--//footer-->
      <!---728x90--->
    </div>
  </div>
  <!-- //Main Content -->

</body>

</html>
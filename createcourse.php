<?php
session_start();
$login_id = $_SESSION['login_id'];

require_once 'class/User.php';
require_once 'class/Course.php';

$user = new User;
$course = new Course;
$row = $user->get_user_id($login_id);
$user_id = $row['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags -->
  <title>Apps Login Form a Simple Login form Responsive Widget :: w3layouts</title>
  <meta name="keywords" content="Apps Login Form Responsive widget, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- stylesheets -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/addcourse.css">
  <link href="css/header.css" rel="stylesheet">
  <!-- google fonts  -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <!-- Main Stylesheet File -->

  <header id="header" class="bg">
    <div class="container">
      <div id="logo" class="pull-left">
        <h1><a href="index.php" class="scrollto">Coursemach</a></h1>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
          <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="home.php#about">Profile</a></li>
          <li><a href="home.php#more-features">My Course</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
</head>

<body>
  <div class="agile-login">
    <h1>Add Course</h1>
    <div class="wrapper">
      <h2>Add</h2>
      <div class="w3ls-form">
        <form action="" method="post">
          <div class="row">
            <label>name</label>
            <input type="text" name="name" placeholder="class name" required />
            <label>description</label>
            <textarea type="text" name="description" placeholder="descripton" required></textarea>
          </div>
          <input type="submit" name="submit" value="Add" />
        </form>
      </div>
    </div>
  </div>
</body>
<?php
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $course->insert($name, $description, $login_id,$user_id);
  }

?>

</html>
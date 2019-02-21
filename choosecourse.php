<?php
require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
$login_id = $_SESSION['login_id'];
$user = new User;
$course = new Course;
$row = $user->get_user_id($login_id);
$user_id = $row['user_id'];

$row = $course->get_course_id($user_id);
$user_course_course_id = $row['course_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>List</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
</head>

<body>
  <link href="css/style.css" rel="stylesheet">
  <header id="header" class="bg">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="home.php" class="scrollto">Coursemach</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
          <li class="menu-active"><a href="home.php">Home</a></li>
          <li><a href="home.php#about">Profile</a></li>
          <li><a href="home.php#my-course">My Course</a></li>
          <!-- <li><a href="#contact">Contact Us</a></li> -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
  </head>

  <main id="main">

    <!--==========================
      More Features Section
    ============================-->
    <section id="my-course" class="section-bg mt-5">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Choose Couse</h3>
          <span class="section-divider"></span>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
            doloremque</p>
        </div>
        <div class="row">
          <?php
            if(isset($_POST['search'])){
              $coursepart = $_POST['coursepart'];
              $result = $course->search_course_name($coursepart);
            }
            
            if($result){
              foreach($result as $row){

              $course_id = $row['course_id'];
              echo "<div class='col-lg-4'>";
              echo "<div class='box wow fadeInLeft'>";
              echo "<h4><a href=''>".$row['course_name']."</a></h4>";
              echo "<h4><a href=''>".$row['course_time']." class</a>  <a href=''>".$row['course_days']."</a></h4>";
              echo "<p class='description'>".$row['course_description']."</p>";

              if($course_id != $user_course_course_id){
                echo "<a href='increcourse.php?id=$course_id' class='square_btn'>CHOOSE</a>";

              }else{
                echo "<a class='square_btn disabled'>DONE</a>";
              }
              
              echo "</div>";
              
              echo "</div>";
              }
            }
          ?>
        </div>
      </div>
      <!-- <h3 class="addc"><a href="addcourse.php">Add Course</a></h3> -->
      </div>
    </section><!-- #my-course -->
  </main>

</body>

</html>
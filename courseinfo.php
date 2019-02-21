<?php
require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
$course_id = $_GET['course_id'];
$day_id = $_GET['day_id'];
$time = $_GET['time'];
$login_id = $_SESSION['login_id'];
$user = new User;
$course = new Course;
$row = $user->get_user_id($login_id);
$user_id = $row['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>CourseInfo</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
</head>

<body>
  <link href="css/courseinfo.css" rel="stylesheet">
  <header id="header" class="bg">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="home.php" class="scrollto">Coursematch</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
          <li class="menu-active"><a href="home.php">Home</a></li>
          <li><a href="home.php#about">Profile</a></li>
          <li><a href="home.php#more-features">My Course</a></li>
          <!-- <li><a href="#contact">Contact Us</a></li> -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
  </head>

  <main id="main">

    <!--==========================
      Course Info Section
    ============================-->
    <section id="courseinfo" class="section-bg-courseinfo mt-5">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Couse Information</h3>
          <?php
          // echo $user_id;
          // echo $course_id;
          // echo $day_id;
          // echo $time;

           $total = $course->get_total_course_id($user_id, $course_id, $day_id,$time);
           $total_id = $total['total_id'];
          ?>
          
          <span class="section-divider"></span>
          <div class="unenroll mb-4">
          <a href="unenroll.php?total_id=<?php echo $total_id ?>" class="btn-square-emboss text-center w-25">unenroll</a>
          </div>
        </div>
        <div class="courseinfo">
          <?php
          $course_info = $course->get_courseinfo($course_id, $day_id);
          echo "<h2>".$course_info['course_name']."</h2>";
          echo "<h3>".$course_info['course_description']."</h3>";
          echo "<h3>".$course_info['day']." : ".$time."</h3>";
          ?>
        </div>
      </div>
      </div>
    </section><!-- #more-features -->

    <section id="more-features" class="section-bg mt-0">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Couse Students</h3>
          <span class="section-divider mb-5"></span>
        </div>
        <div class="row">
          <?php
          $result = $course->get_userinfo1($course_id, $day_id, $time);
          // print_r($result);
          foreach($result as $row){
            $user_id = $row['user_id'];
            echo "<div class='col-lg-4'>";
            echo "<div class='box wow fadeInLeft'>";
            echo "<h4><a href='student.php?id=$user_id'>".$row['user_name']."</a></h4>";
            echo "<h4><a>".$row['user_grade']."</a></h4>";
            echo "<h4><a>".$row['user_major']."</a></h4>";
            echo "<p class='description'>".$row['user_intro']."</p>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
      <!-- <h3 class="addc"><a href="addcourse.php">Add Course</a></h3> -->
      </div>
    </section><!-- #more-features -->
  </main>

</body>

</html>
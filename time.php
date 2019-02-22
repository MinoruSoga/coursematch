<?php
session_start();
$login_id = $_SESSION['login_id'];
require_once 'class/User.php';
require_once 'class/Course.php';

$user = new User;
$course = new Course;
$row = $user->get_user_id($login_id);
$user_id = $row['user_id'];
$course_id = $_GET['id'];

$row= $user->get_user_course_id($user_id, $course_id);
$user_course_id = $row['user_course_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>addcourseinfo time</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
</head>

<body>
  <!-- css -->
  <link href="css/addcourseinfo.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dayform.css">

  <header id="header" class="bg">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="home.php" class="scrollto">Coursemach</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
          <li class="menu-active"><a href="home.php">Home</a></li>
          <li><a href="home.php#about">Profile</a></li>
          <li><a href="home.php#my-course">My Course</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  </head>
  <main id="main">
    <!--==========================
      More Features Section
    ============================-->
    <section id="more-features" class="section-bg mt-5">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Couse Info</h3>
          <span class="section-divider"></span>
          <p class="section-description"></p>
        </div>
      </div>
      <h1 class="card-title text-center">Choose Time</h1>
      <div class="addform justify-content-center">
        <div class="card-time">
          <form action="" method="post">
            <div class="card-body">
              <div class="cp_ipcheck">
                <ul class="mb-0">
                  <?php
                $days = $_POST['day'];
                 foreach($days as $day_id){
                  echo "<div class='div-time'>";
                   echo "<input type='hidden' name='schedule[]' value='$day_id'>";
                   $row = $course->get_dayname($day_id);
                   echo "<h2>";
                   echo $row['day'];
                   echo "</h2>";
                   echo "<select name='time[]' class='form-control timeselect container'>";
                   for($i = 1; $i <= 7; $i++){
                     echo "<option>".$i."</option>";
                   }
                   echo "</select>";
                   echo "<br>";
                 }
                 echo "</div>";
                 echo "<button type='submit' name='submit' class='ard-link1 btn'>Save</button>";
              ?>
                </ul>
              </div>

            </div>
          </form>
        </div>
      </div>
      <?php
        if(isset($_POST['submit'])){

        $schedule = $_POST['schedule'];
        $time = $_POST['time'];
        echo "<br>";
        $course->time($schedule, $time, $course_id, $user_id); 
        }
      ?>

    </section><!-- #more-features -->
  </main>

</body>

</html>
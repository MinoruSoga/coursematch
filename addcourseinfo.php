<?php
session_start();
$login_id = $_SESSION['login_id'];
require_once 'class/User.php';
require_once 'class/Course.php';

$user = new User;
$course = new Course;
$row = $user->get_user_id($login_id);
$user_id = $row['user_id'];
// $row = $course->get_course_id($user_id);
// $user_course_course_id = $row['course_id'];
$course_id = $_GET['id'];
// echo "<h1>".$user_id."   ".$course_id."</h1>";

$row= $user->get_user_course_id($user_id, $course_id);
$user_course_id = $row['user_course_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>addcourseinfo</title>
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
          <li><a href="home.php#more-features">My Course</a></li>
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
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
            doloremque</p>
        </div>
      </div>

      <div class="addform justify-content-center">
        <div class="card">
          <form action="time.php?id=<?php echo $course_id ?>" method="post">
            <div class="card-body">
              <h1 class="card-title text-center">Choose Day</h1>
              <div class="cp_ipcheck">
                <ul class="mb-0">
                  <?php
                  $sched = $user->get_sched();
                  foreach($sched as $day){
                    $schedule = $day['day'];
                    $day_id = $day['day_id'];
                    echo "<li class='list_item'>";
                    echo "<label><input type='checkbox' class='option-input05' name='day[]' value='$day_id'>$schedule</label>";
                    echo "</li>";
                  }
                  ?>
                </ul>
              </div>

              <p class="footer" id="cardfooter">
                <button type="submit" name="next" class="card-link1 btn" id="button">NEXT</button>
              </p>
            </div>
          </form>
        </div>
      </div>
    </section><!-- #more-features -->
  </main>

</body>

</html>
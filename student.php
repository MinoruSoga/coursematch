<?php
require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
// $login_id = $_SESSION['login_id'];
$user_id = $_GET['id'];
$user = new User;
$row = $user->get_user_byid($user_id);
$course = new Course;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>

  <!-- Main Stylesheet File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/table.css" rel="stylesheet">
  <link href="css/student.css" rel="stylesheet">

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
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
</head>

<body>

  <section id="student" class="section-bg mt-5">
    <div class="container-fluid">
      <div class="section-header">
        <h3 class="section-title">Profile</h3>
        <span class="section-divider"></span>
        <form action="" method="post" enctype="multipart/form-data">
      </div>
      <div class="row">
        <div class="col-lg-6 student-img wow fadeInLeft">
          <img src="img/amuro.jpg" alt="">
        </div>

        <div class="col-lg-6 content wow fadeInRight">
          <h2>
            <?php echo $row['user_name']; ?>
          </h2>
          <p>Grades:
            <?php echo $row['user_grade'] ?>
          </p>
          <p>Major:
            <?php echo $row['user_major'] ?>
          </p>
          <p>Blood type:
            <?php echo $row['user_blood'] ?>
          </p>
          <p>Height:
            <?php echo $row['user_height'] ?>
          </p>
          <p>Hobby:
            <?php echo $row['user_hobby'] ?>
          </p>
          <p>Self-introduction
          </p>
          <p>
            <?php echo $row['user_intro'] ?>
          </p>
        </div>
      </div>
      </form>
    </div>
  </section><!-- #about -->

  <section id="my-course" class="section-bg">
    <div class="container">

      <div class="section-header">
        <h3 class="section-title">Couse</h3>
        <span class="section-divider"></span>
      </div>
      <div class="row">
        <?php
          echo "
          <table class='table'>
          <thead>
            <tr>
              <th scope='col'></th>
              <th scope='col'>Monday</th>
              <th scope='col'>Tuesday</th>
              <th scope='col'>Wednesday</th>
              <th scope='col'>Thursday</th>
              <th scope='col'>Friday</th>
            </tr>
          </thead>
          <tbody>
        ";
        ?>
        <?php
      $days = $course->get_days();
      
        for($i = 1; $i <= 6; $i++){
          echo "<tr>";
          echo "<th scope='row'>".$i."</th>";
          
          foreach($days as $row){
            $day_id = $row['day_id'];
            $result = $course->get_my_courses($user_id, $day_id, $i);
            
            $course_id = $result['course_id'];
              $day_id = $result['day_id'];
              $time = $result['time'];
              echo "<td>";
              echo "<div class='card'>";
              echo "<div class='card-body'>";
              echo "<h3><a href='courseinfo.php?course_id=$course_id&day_id=$day_id&time=$time'>".$result['course_name']."</a></h3>";
              echo "</div>";
              echo "</div>";
            echo "</td>";
        }
        echo "</tr>";
      }
      ?>
        <?php
      echo "
      </tbody>
      </table>";
      ?>
      </div>
    </div>
    </div>
  </section><!-- #my-course -->
</body>

</html>
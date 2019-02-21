<?php

require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
$login_id = $_SESSION['login_id'];

$user = new User;
$course = new Course;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Coursematch</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
</head>

<body>
  <?php include 'header.php'?>
  <link href="css/table.css" rel="stylesheet">
  <!-- example -->
  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-text">
      <h2>Welcome to Coursematch</h2>
      <p>A web service that allows you to view profiles of students taking the same lesson</p>
      <a href="#profile" class="btn-get-started scrollto">Get Started</a>
    </div>
    <!-- photo -->
    <!-- <div class="product-screens">
      <div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">
        <img src="img/product-screen-1.png" alt="">
      </div>
      <div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">
        <img src="img/product-screen-2.png" alt="">
      </div>
      <div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">
        <img src="img/product-screen-3.png" alt="">
      </div>
    </div> -->
    <!-- #photo -->
  </section><!-- #intro -->

  <main id="main">
    <!--==========================
      Profile Us Section
    ============================-->
    <?php
    $userinfo = $user->get_user($login_id);
    ?>
    <section id="profile" class="section-bg">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Profile</h3>
          <span class="section-divider"></span>
          <p class="section-description">
          </p>
        </div>
        <div class="row">
          <div class="col-lg-6 profile-img wow fadeInLeft">
            <!-- <img src="img/amuro.jpg" alt=""> -->
            <img src="<?php echo $userinfo['user_pic'] ?>" alt="">
          </div>

          <div class="col-lg-6 content wow fadeInRight">
            <h2>
              <?php echo $userinfo['user_name'] ?>
            </h2>
            <p>
              Grades:
              <?php echo $userinfo['user_grade'] ?>
            </p>
            <p>
              Major:
              <?php echo $userinfo['user_major'] ?>
            </p>
            <p>
              Blood type:
              <?php echo $userinfo['user_blood'] ?>
            </p>
            <p>
              Height:
              <?php echo $userinfo['user_height'] ?>
            </p>
            <p>
              Hobby:
              <?php echo $userinfo['user_hobby'] ?>
            </p>
            <p>
              Self-introduction
            </p>
            <?php echo $userinfo['user_intro'] ?>
          </div>
        </div>
        <h3 class="section-title pedit"><a href="profile_edit.php">Edit</a></h3>
      </div>
    </section><!-- #profile -->
    <!--==========================
      My course Section
    ============================-->
    <section id="my-course" class="section-bg">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">My Course</h3>
          <span class="section-divider"></span>
          <p class="section-description"></p>
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
      $userID = $userinfo['user_id'];
      $days = $course->get_days();
      
        for($i = 1; $i <= 6; $i++){
          echo "<tr>";
          echo "<th scope='row'>".$i."</th>";

          // print_r($result);
          
          foreach($days as $row){
            $day_id = $row['day_id'];
            $result = $course->get_my_courses($userID, $day_id, $i);
            
            // echo $result['course_name'];
            $course_id = $result['course_id'];
              $day_id = $result['day_id'];
              $time = $result['time'];
              // echo "<div class='col-lg-4'>";
              // echo "<div class='box wow'>";
              // echo "<h4><a href='courseinfo.php?course_id=$course_id&day_id=$day_id&time=$time'>".$result['course_name']."</a></h4>";
              // echo "<p class='description'>".$row['course_description']."</p>";
              // echo "<p class='description'>".$row['day']."</p>";
              // echo "<p class='description'>".$row['time']."</p>";
              echo "<td>";
              echo "<div class='card'>";
              echo "<div class='card-body'>";
              // echo "<h5 class='card-title'>Special title treatment</h5>";
              // echo "<p class='card-text'><h3>".$result['course_name']."</h3></p>";
              echo "<h4><a href='courseinfo.php?course_id=$course_id&day_id=$day_id&time=$time'>".$result['course_name']."</a></h4>";
              // echo "<a href='#' class='btn btn-primary'>Go somewhere</a>";
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
      <h3 class="addc"><a href="createcourse.php">Add Course</a></h3>
      <h3 class="addc mt-3"><a href="courselist.php">Choose Course</a></h3>
      </div>

  </main>
  <?php include 'footer.php'?>

</body>

</html>
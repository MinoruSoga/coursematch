<?php
require_once 'class/User.php';
session_start();
$login_id = $_SESSION['login_id'];

$user = new User;
$row = $user->get_user($login_id);
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
  <link href="css/style.css" rel="stylesheet">
  <header id="header" class="bg">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="home.php" class="scrollto">Coursemach</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
          <li class="menu-active"><a href="home.php">Home</a></li>
          <li><a href="#about">Profile</a></li>
          <li><a href="#more-features">My Course</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
</head>

<body>

  <section id="edit" class="section-bg mt-5">
    <div class="container-fluid">
      <div class="section-header">
        <h3 class="section-title">Profile</h3>
        <span class="section-divider"></span>
        <form action="" method="post" enctype="multipart/form-data">
      </div>
      <div class="row">
        <div class="col-lg-6 edit-img wow fadeInLeft">
          <img src="<?php echo $row['user_pic'] ?>" alt="">

          <div class="form-group mt-2">
            <label>Photo</label>
            <input type="file" name="profilepic" class="">
          </div>
          <button class="peupdate" type="submit" name="submit">Update</button>
        </div>

        <div class="col-lg-6 content wow fadeInRight">
          <h2>Namie Amuro
            <?php echo $row['user_name']; ?>
          </h2>
          <p>
            Grades: <input class="sm" type="text" placeholder="Grades" required="required" name="user_grade" value="<?php echo $row['user_grade'] ?>">
          </p>
          <p>
            Major:<input class="md" type="text" placeholder="Major" required="required" name="user_major" value="<?php echo $row['user_major'] ?>">
          </p>
          <p>
            Blood type:<input class="sm" type="text" placeholder="blood" required="required" name="user_blood" value="<?php echo $row['user_blood'] ?>">
          </p>
          <p>
            Height:<input class="sm" type="text" placeholder="height" required="required" name="user_height" value="<?php echo $row['user_height'] ?>">
          </p>
          <p>
            Hobby:<input class="md" type="text" placeholder="hobby" required="required" name="user_hobby" value="<?php echo $row['user_hobby'] ?>">
          </p>
          <p>
            Self-introduction
          </p>
          <textarea class="" placeholder="Self-introduction" required="required" name="user_intro" id="" cols="20" rows="5"><?php echo $row['user_intro'] ?></textarea>
        </div>
      </div>
      </form>
    </div>
  </section><!-- #about -->

  <?php
            if(isset($_POST['submit'])){
                $user_grade = $_POST['user_grade'];
                $user_major = $_POST['user_major'];
                $user_blood = $_POST['user_blood'];
                $user_height = $_POST['user_height'];
                $user_hobby = $_POST['user_hobby'];
                $user_intro = $_POST['user_intro'];
                //file upload
                $target_dir = "images/";
                $target_file = basename($_FILES['profilepic']['name']);
                $tmp_name = $_FILES['profilepic']['tmp_name'];
                // $image_name = $_FILES['image']['name'] ;
                // $target_file = "../uploads/$image_name";
                // $targetFileForItem = "uploads/$image_name";
                move_uploaded_file($tmp_name, "$target_dir/$target_file");
                // echo $target_dir;
                // echo $target_file;
                // $user_pic = $target_dir.$target_file;
                // echo $user_pic;
                $user = new User;
                echo $user->update($user_grade, $user_major, $user_blood, $user_height, $user_hobby, $user_intro, $target_dir, $target_file, $tmp_name, $login_id);

            }
        ?>
</body>

</html>
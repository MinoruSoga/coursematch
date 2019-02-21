<?php

require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
// $login_id = $_SESSION['login_id'];
// $user = new User;
$course = new Course;
$total_id = $_GET['total_id'];
// $row = $user->get_user_id($login_id);
// $user_id = $row['user_id'];

$course->unenroll($total_id);

// $course->insert_course($user_id, $course_id);









  ?>
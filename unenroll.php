<?php

require_once 'class/User.php';
require_once 'class/Course.php';
session_start();
$course = new Course;
$total_id = $_GET['total_id'];
$course->unenroll($total_id);

  ?>
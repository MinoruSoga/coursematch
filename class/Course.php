<?php
require_once 'Config.php';

class Course extends Config{
  // private $globalcourse_id;

  public function insert($name,$description, $login_id,$user_id){

    $sql = "INSERT INTO course(course_name, course_description) VALUES('$name', '$description')";
    $result = $this->conn->query($sql);

    $globalcourse_id = $this->conn->insert_id;
    
    // $this->globalcourse_id($globalcourse_id);
    // $this->globalcourse_id = $globalcourse_id;


    // global $globalcourse_id;$globalcourse_id = "globaltest1";
    // = $this->conn->insert_id;

    if($result){
      $course_id = $this->conn->insert_id;
      $sql = "INSERT INTO user_course(user_id, course_id) VALUES('$user_id', '$course_id')";
      $result = $this->conn->query($sql);
      session_start();
      $_SESSION['globalcourse_id'] = $globalcourse_id;
      $this->redirect_js('addcourseinfoforadd.php');
      return true;
    }else{
      echo "Error in inserting record " .$this->conn->error;
    }
  }
  public function user_course($name, $day, $time, $description, $login_id,$user_id){

    $course_id = $this->conn->insert_id;
    $sql = "INSERT INTO user_course(user_id, course_id) VALUES('$user_id', '$course_id')";
    $result = $this->conn->query($sql);
    
    if($result){
      
      // echo "<script>window.locatin.replace('categories.php)</script>";
      // header("Location: categories.php");
      $this->redirect_js('increcourse.php');
      return true;
      
    }else{
      echo "Error in inserting record " .$this->conn->error;
    }
  }
  public function get_course(){
    //query
    $sql = "SELECT * FROM course";
    $result = $this->conn->query($sql);

    //initialize an array
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }
    else{
      return $this->conn->error;
    }
  }

  public function get_course_not_enrol($user_id){
    //query
    $sql = "SELECT * FROM course WHERE course_id NOT IN(SELECT course_id FROM user_course WHERE user_id=$user_id)";
    $result = $this->conn->query($sql);

    //initialize an array
    $rows = array();
    
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }
    else{
      return $this->conn->error;
    }
  }
  public function get_mycourse($user_id){
    $sql = "SELECT * 
    FROM course, days, total_course_id
    WHERE total_course_id.user_id=$user_id and total_course_id.course_id=course.course_id and total_course_id.day_id=days.day_id";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  } 
  // public function get_mycourse($user_id){
  //   $sql = "SELECT * FROM user_course INNER JOIN course ON user_course.course_id=course.course_id
  //   WHERE user_course.user_id=$user_id";
  //   $result = $this->conn->query($sql);
  //   $rows = array();
  //   if($result->num_rows > 0){
  //     while($row = $result->fetch_assoc()){
  //       $rows[] = $row;
  //     }
  //     return $rows;
  //   }else{
  //     return $this->conn->error;
  //   }
  // } 
  public function search_course_name($course_name){
    $sql = "SELECT * FROM course WHERE course_name LIKE '%$course_name%'";
    $result = $this->conn->query($sql);

    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  }
  public function insert_user_course($user_id, $course_id){

    $sql = "INSERT INTO user_course(user_id, course_id) VALUES('$user_id', '$course_id')";
    $result = $this->conn->query($sql);
    
    if($result){
      $this->redirect_js('home.php#more-features');
      return true;
      
    }else{
      echo "Error in inserting record " .$this->conn->error;
    }
  }
  public function get_total_course_id($user_id, $course_id, $day_id,$time){

    $sql = "SELECT * FROM total_course_id
     WHERE user_id=$user_id and course_id=$course_id and day_id=$day_id and time=$time";
    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row;
    }else{
      return $this->conn->error;
    }
  }
  public function unenroll($total_id){

    $sql = "DELETE FROM total_course_id WHERE total_id=$total_id";

    $result = $this->conn->query($sql);
    if($result){
      $this->redirect_js('home.php#my-course');
    }
    else{
        echo "Error: ".$this->conn->error;
    }
  }
  public function get_courseinfo($course_id, $day_id){

    $sql = "SELECT * FROM course, days
     WHERE course.course_id=$course_id and days.day_id=$day_id";
    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row;
    }else{
      return $this->conn->error;
    }
  }



  public function get_userinfo($course_id, $day_id, $time){
    $sql = "SELECT * FROM users, total_course_id
    WHERE total_course_id.course_id=$course_id and total_course_id.day_id=$day_id and total_course_id.time=$time and total_course_id.user_id=users.user_id";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  } 
  public function get_userinfo1($course_id, $day_id, $time){
    $sql = "SELECT * FROM users INNER JOIN total_course_id ON users.user_id=total_course_id.user_id
    WHERE total_course_id.course_id=$course_id and total_course_id.day_id=$day_id and total_course_id.time=$time
    ";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  } 

  public function get_course_id($user_id){
    $sql = "SELECT * FROM user_course WHERE user_id=$user_id";
    $result = $this->conn->query($sql);

    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  }
  public function add_day($days ,$user_id,$course_id){
    $sql = "INSERT INTO user_course(user_id, course_id) VALUES('$user_id', '$course_id')";
    $result = $this->conn->query($sql);
    if($result){
      $user_course_id = $this->conn->insert_id;

    foreach($days as $val){
      $sql = "INSERT INTO user_course_day(day_id, user_course_id) VALUES('$val', '$user_course_id')";
      $result = $this->conn->query($sql);

    }
    if($result){
      $this->redirect_js('home.php#more-features');
      return true;
    }
    else{
      return $this->conn->error;
    }
    }}

  public function add_dayforadd($days ,$user_id,$course_id){
    $sql = "INSERT INTO user_course(user_id, course_id) VALUES($user_id, $course_id)";
    $result = $this->conn->query($sql);
    if($result){
      $user_course_id = $this->conn->insert_id;

    foreach($days as $val){
      $sql = "INSERT INTO user_course_day(day_id, user_course_id) VALUES($val, $user_course_id)";
      $result = $this->conn->query($sql);

    }
    if($result){
      unset($_SESSION['globalcourse_id']);
      $this->redirect_js('home.php#more-features');
      return true;
    }
    else{
      return $this->conn->error;
    }
    }
  }
  public function get_timeline(){
    $sql = "SELECT * FROM timeline";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
    
  }
  public function get_dayname($day_id){
    $sql = "SELECT * FROM days WHERE day_id=$day_id";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
  }
  public function time($schedule, $time, $course_id, $user_id){
    $count = count($schedule);
    echo $count;
    // print_r($time);
      for($i = 0; $i < $count; $i++){
        $days = $schedule[$i];
        $final_time = $time[$i];
        $sql = "INSERT INTO total_course_id(user_id, course_id, day_id, time) VALUES($user_id, $course_id, $days, '$final_time')";
        $result = $this->conn->query($sql);
      }
        if($result){
          $this->redirect_js('home.php#my-course');
          return true;
        }else{
          echo "------time------";
          echo "Error in inserting record " .$this->conn->error;
        }
        echo $days;
  }

  // public function get_course_1($user_id){
  //   $sql = "SELECT * 
  //   FROM course, days, total_course_id
  //   WHERE total_course_id.user_id=$user_id and total_course_id.course_id=course.course_id and total_course_id.day_id=days.day_id and total_course_id.time=1  ";
  //   $result = $this->conn->query($sql);
  //   if($result->num_rows > 0){
  //     $row = $result->fetch_assoc();
  //     return $row;
  //   }else{
  //     return $this->conn->error;
  //   }
  // }

  // public function get_user($login_id){
  //   $sql = "SELECT * FROM users WHERE login_id=$login_id";
  //   $result = $this->conn->query($sql);

  //   if($result->num_rows > 0){
  //     $row = $result->fetch_assoc();
  //     return $row;
  //   }else{
  //     return $this->conn->error;
  //   }
  // }
  // and total_course_id.time=1 
  public function get_course_1($user_id){
    $sql = "SELECT * 
    FROM course, days, total_course_id
    WHERE total_course_id.user_id=$user_id and total_course_id.course_id=course.course_id and total_course_id.day_id=days.day_id and total_course_id.time=1
    ORDER BY total_course_id.day_id asc";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  } 

  public function get_my_courses($userID, $day_id, $i){
    $sql = "SELECT * FROM total_course_id as tid
            INNER JOIN course ON tid.course_id=course.course_id
            WHERE user_id = $userID AND day_id = $day_id AND time = $i";
    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row;
    }else{
      return $this->conn->error;
    }
  }

  public function get_days(){
    $sql = "SELECT * FROM days";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  } 




}

?>
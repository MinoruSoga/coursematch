<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">

<?php
  require_once "Config.php";

  class User extends Config{

    public function insert($name, $email, $phone, $pass, $conpass){   

      $sql1 = "SELECT * FROM users WHERE user_name = '$name' ";

      if($this->conn->query($sql1)->num_rows > 0){
        echo "<h3 class = 'container text-center mt-3 text-danger'>'Username is already taken'</h3>";

      }
      elseif($pass != $conpass){
        echo "<h3 class = 'text-white'>alart</h3>";
      }
      $sql = "INSERT INTO login(email, password,status) VALUES('$email', '$pass','admin')";
      $result = $this->conn->query($sql);
      $login_id = $this->conn->insert_id;
      if($result){
        $sql1 = "INSERT INTO users(user_name, user_phone, login_id) VALUES('$name', '$phone', $login_id)";
        session_start();
        $result = $this->conn->query($sql1);
        if($result){
          $_SESSION['login_id'] = $login_id;
          header("Location: home.php");
        
        }else{
          echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
        }
      }
    }
    
    

    public function login($email, $password){
      $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
      $result=$this->conn->query($sql);
      if($result->num_rows > 0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['login_id'] = $row['login_id'];
        // $this->redirect_js("../index.php");
        header("Location: home.php");
        // if($row['permission'] == 'admin'){
        //   $this->redirect_js("admin/index.php");
        //   // echo $_SESSION['user_id'];
        // }
        // elseif($row['permission'] == 'user'){
        //   $this->redirect_js('user/index.php');
        //   // echo $_SESSION['user_id'];
        // }
      }
      else{
        echo "Invalid Username or Password";
      }
    } 
    public function logout(){
      session_start();
      session_destroy();
      $this->redirect_js('login.php');
    }

    public function get_user($login_id){
      $sql = "SELECT * FROM users WHERE login_id=$login_id";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
    }
    public function update($user_grade, $user_major, $user_blood, $user_height, $user_hobby, $user_intro, $target_dir, $target_file, $tmp_name, $login_id){

      // $sql = "SELECT * FROM users WHERE item_name = '$name' AND item_id != $id";
      // $result = $this->conn->query($sql);
      // if($result->num_rows > 0){
        // echo "Username is already taken";
      // }
      // else{
        $user_pic = $target_dir.$target_file;
        echo $user_pic;
        $sql = "UPDATE users SET user_grade=$user_grade, user_major='$user_major', user_blood='$user_blood', user_height=$user_height, user_hobby='$user_hobby', user_intro='$user_intro', user_pic='$user_pic' WHERE login_id=$login_id";
        
        $result = $this->conn->query($sql);
  
        if($result){
          $this->redirect_js('home.php#about');
        }
        else{
          echo "Error: ".$this->conn->error;
        }
      // }
    }
    public function get_user_id($login_id){
      $sql = "SELECT * FROM users WHERE login_id=$login_id";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
    }

    public function get_user_byid($user_id){
      $sql = "SELECT * FROM users WHERE user_id=$user_id";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
    }
    
    public function get_sched(){
      $sql = "SELECT * FROM days";
      $result = $this->conn->query($sql);

      // $sched = $result->fetch_assoc();


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


    public function get_user_course_id($user_id, $course_id){
      $sql = "SELECT * FROM user_course WHERE user_id=$user_id AND course_id=$course_id ";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
    }
    
  }
?>
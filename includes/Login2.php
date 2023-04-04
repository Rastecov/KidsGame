<?php
if(isset($_POST['login-submit'])){
    require 'database_handler.php';
     // get the form data
     $username = $_POST['username'];
     $password = $_POST['pwd'];
 
        
     if (empty($username) || empty($password)) {

      header("Location: ../index.php?error=emptyfields&uid=" . $username);

      exit();
    }
        
        // query the database for the user
        $sql = "SELECT * FROM users WHERE userName='$username' AND userpassword='$password'";
        $result = mysqli_query($conn, $sql);
        
        // check if the user was found
        if (mysqli_num_rows($result) == 1) {
          // log the user in
          session_start();
          $_SESSION['username'] = $username;
          header("Location: ../Level 1.php");
          exit();
        } else {
          // display an error message
          
          header("Location: ../index.php?error=Invalid ID or Password");
          
        }
        
        mysqli_close($conn);
      }
    
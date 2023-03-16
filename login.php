<?php
if (isset($_POST['connect'])) {
  // get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // connect to the database
  $servername = "localhost";
  $dbusername = "yourusername";
  $dbpassword = "yourpassword";
  $dbname = "yourdatabase";
  
  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // query the database for the user
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  
  // check if the user was found
  if (mysqli_num_rows($result) == 1) {
    // log the user in
    session_start();
    $_SESSION['username'] = $username;
    header("Location: welcome.php");
    exit();
  } else {
    // display an error message
    echo "Invalid username or password";
  }
  
  mysqli_close($conn);
}
?>
<?php
if (isset($_POST['login-submit'])) {
    require 'database_handler.php';

    $username = $_POST['username'];
    $password = $_POST['pwd'];


    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&uid=" . $username);
        exit();
}
else{

    $sql ="SELECT * FROM users WHERE userName=? OR email =?";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql))
    {
        
        header("Location: ../index.php?error=sqlerror");

    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    }
    $result = mysqli_stmt_get_result($stmt);

    if($row = $mysqli_fetch_assoc($result)){
        $passwordCheck = password_verify($password, $row['userpassword']);
        if($passwordCheck == false){
            header("Location: ../index.php?error=WrongPassword");
            exit();


        }
        else if($passwordCheck == true){

            session_start();
            $_SESSION['userId']=$row['userId'];
            $_SESSION['userName']=$row['userName'];
            header("Location: ../index.php?Login=Sucess");
            exit();
        }
        else{
            header("Location: ../index.php?error=WrongPassword");
            exit();
        }

    }
    else{
        
        header("Location: ../index.php?error=NOUSER");
    }

}
}
else{
    header("Location: ../index.php");
    exit();

}

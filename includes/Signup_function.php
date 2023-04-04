<?php
if (isset($_POST['signup-submit'])) {
    require 'database_handler.php';


    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $firstName = $_POST['fName'];
    $lastname = $_POST['lName'];
    $password = $_POST['pwd'];
    $ConfirmPassword = $_POST['Cpwd'];


    if (empty($username) || empty($email) || empty($firstName) || empty($lastname) || empty($password) || empty($ConfirmPassword)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidusernameMail=&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidMail&uid=" . $username . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&mail=" . $email . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if ($password !== $ConfirmPassword) {
        header("Location: ../signup.php?error=NotTheSamePassword&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else {

        $sql = "SELECT userName FROM users WHERE userName=? ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=" . $email . "&firstname=" . $firstName . "&lastName=" . $lastname);
                exit();
            } else {

                $sql = "INSERT INTO users (userName, email, firstname, lastname, userpassword) VALUES (?, ?, ?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {

                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    //$hashedpassword = password_hash($password, PASSWORD_DEFAULT);


                    mysqli_stmt_bind_param($stmt, "sssss", $username, $email,$firstName,$lastname, $password);
                     mysqli_stmt_execute($stmt);
                     header("Location: ../signup.php?Signup=success");
                    exit();
                     
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../signup.php");
    exit();

}

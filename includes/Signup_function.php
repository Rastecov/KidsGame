<?php
if (isset($_POST['signup-submit'])) {
    require 'database_handler.php';


    $username = $_POST['uid'];
    $current_dateTime = date('Y-m-d H:i:s');
    $firstName = $_POST['fName'];
    $lastname = $_POST['lName'];
    $password = $_POST['pwd'];
    $ConfirmPassword = $_POST['Cpwd'];


    if (empty($username) || empty($firstName) || empty($lastname) || empty($password) || empty($ConfirmPassword)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername" . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else if (is_numeric($firstName[0])) {

        header("Location: ../signup.php?error=invalidfirstname");
    } else if (is_numeric($lastname[0])) {

        header("Location: ../signup.php?error=invalidlastname");
    } else if ($password !== $ConfirmPassword) {
        header("Location: ../signup.php?error=NotTheSamePassword&uid=" . $username . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else {

        if ($conn->query("DESC player;") == true && $conn->query("DESC authenticator;") == true) {

            $result = $conn->query("SELECT * FROM player WHERE userName='$username'");
            $count_row = $result->num_rows;
            if ($count_row > 0) {
                header("Location: ../signup.php?error=usertaken&mail=" . "&firstname=" . $firstName . "&lastName=" . $lastname);
                exit();
            } else {
               
                $conn->query("INSERT INTO player(fName, lName, userName, registrationTime) VALUES ('$firstName', '$lastname', '$username', '$current_dateTime')");
                $user_rank_result = $conn->query("SELECT player.registrationOrder FROM player");
                $user_rank = $user_rank_result->fetch_assoc()['registrationOrder'];
                $conn->query("INSERT INTO authenticator(passCode,registrationOrder) VALUES('$password', '$user_rank')");
                header("Location: ../signup.php?Signup=success");
                exit();
            }
        } else {

            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
    }

    $conn->close();
} else {
    header("Location: ../signup.php");
    exit();
}

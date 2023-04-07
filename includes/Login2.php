<?php
require 'database_handler.php';

if (isset($_POST['login-submit'])) {

    // get the form data
    $username = $_POST['username'];
    $password = $_POST['pwd'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&uid=" . $username);
        exit();
    }

    // query the database for the user
    $sql = "SELECT player.userName, authenticator.passCode
            FROM player
            INNER JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder
            WHERE player.userName = '$username' AND authenticator.passCode = '$password'";
    $result = mysqli_query($conn, $sql);

    // check if the user was found
    if ($result->num_rows > 0) {
        // log the user in
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../Level 1.php");
        exit();
    } else {
        // display an error message
        header("Location: ../index.php?error=Invalid ID or Password");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}

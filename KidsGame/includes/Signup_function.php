<?php
//add the file name database_handler.php
// this file contains the connection to the database
require 'database_handler.php';

// check if the user submitted the signup form
if (isset($_POST['signup-submit'])) {
    

 // get the form data
    $username = $_POST['uid'];
    $current_dateTime = date('Y-m-d H:i:s');
    $firstName = $_POST['fName'];
    $lastname = $_POST['lName'];
    $password = $_POST['pwd'];
    $ConfirmPassword = $_POST['Cpwd'];


    // check if any of the fields are empty
    if (empty($username) || empty($firstName) || empty($lastname) || empty($password) || empty($ConfirmPassword)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
        
    }// check if the username is valid 
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername" . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
        
    }// check if the first name starts with a number
     else if (is_numeric($firstName[0])) {

        header("Location: ../signup.php?error=invalidfirstname");
    }// check if the last name starts with a number 
    else if (is_numeric($lastname[0])) {

        header("Location: ../signup.php?error=invalidlastname");
    }     // check if the both passwords are the same

    else if ($password !== $ConfirmPassword) {
        header("Location: ../signup.php?error=NotTheSamePassword&uid=" . $username . "&firstname=" . $firstName . "&lastName=" . $lastname);
        exit();
    } else {

        $dbHandler = DataBaseHandler::DbConnection();
            $dbHandler->DbOpenConnection();
            $dbHandler->connectToDB("kidsgamesdb");
            $conn = $dbHandler->getDataBase();
               

        // check if the player and authenticator tables exist in the database

        if ($conn->query("DESC player;") == true && $conn->query("DESC authenticator;") == true) {
            // query to see if we already have a player with this username
            $result = $conn->query("SELECT * FROM player WHERE userName='$username'");
            $count_row = $result->num_rows;
            //if yes return an error message else insert into the database
            if ($count_row > 0) {
                header("Location: ../signup.php?error=usertaken" . "&firstname=" . $firstName . "&lastName=" . $lastname);
                exit();
            } else {

                
                $conn->query("INSERT INTO player(fName, lName, userName, registrationTime) VALUES ('$firstName', '$lastname', '$username', '$current_dateTime')");
                //get the maximum registration order from the player table as the user rank
                $registration_result = $conn->query("SELECT MAX(registrationOrder) AS max_order FROM player");
                //fetch the row as an associative array
                $registration = $registration_result->fetch_assoc()['max_order'];
                 // hash the password using bcrypt and encode it in base64
                $password = base64_encode(password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]));
                $conn->query("INSERT INTO authenticator(passCode) VALUES('$password')");
                $conn->query("UPDATE authenticator SET registrationOrder='$registration' WHERE passCode='$password'");
                    // redirect to the signup page with a success message
                header("Location: ../signup.php?Signup=success");
                exit();
            }
        } else {
                    //The table don't exist
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
    }

    $conn->close();
} else {
    //redirect to the signup page if the form was not submitted
    header("Location: ../signup.php");
    exit();
}


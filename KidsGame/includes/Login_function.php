<?php
//add the file name database_handler.php
// this file contains the connection to the database
require 'database_handler.php';
$dbHandler = DataBaseHandler::DbConnection();
            $dbHandler->DbOpenConnection();
            $dbHandler->connectToDB("kidsgamesdb");
            $conn = $dbHandler->getDataBase();







//create database  kidsgamesdb if it does not exist
$conn->query("CREATE DATABASE IF NOT EXISTS kidsgamesdb;");
mysqli_select_db($conn, 'kidsgamesdb');

//create table  player if it does not exist

$conn->query("CREATE TABLE IF NOT EXISTS player( 
    fName VARCHAR(50) NOT NULL, 
    lName VARCHAR(50) NOT NULL, 
    userName VARCHAR(20) NOT NULL UNIQUE,
    registrationTime DATETIME NOT NULL,
    id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
    registrationOrder INTEGER AUTO_INCREMENT,
    PRIMARY KEY (registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
");
    //create table  authenticator if it does not exist

$conn->query(" CREATE TABLE IF NOT EXISTS authenticator(   
    passCode VARCHAR(255) NOT NULL,
    registrationOrder INTEGER, 
    FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
");
    //create table  score if it does not exist

$conn->query(" CREATE TABLE IF NOT EXISTS score( 
    scoreTime DATETIME NOT NULL, 
    result ENUM('success', 'failure', 'incomplete'),
    livesUsed INTEGER NOT NULL,
    registrationOrder INTEGER, 
    FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
");

    //create view  history if it does not exist

$conn->query(" CREATE VIEW IF NOT EXISTS history  AS
SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
FROM player p, score s
WHERE p.registrationOrder = s.registrationOrder;
");




//check if the user submitted the login form

if (isset($_POST['login-submit'])) {

    // get the form data
    $username = $_POST['username'];
    $password = $_POST['pwd'];
// check if any of the fields are empty
    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&uid=" . $username);
        exit();
    }

    //select the player userName and password from the database where player registrationOrder is equal to 
    //authenticator registrationOrder and player username is equal to the username that the user entered
    $sql = "SELECT player.userName, authenticator.passCode
    FROM player
    INNER JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder
    WHERE player.userName = '$username'";
    $result = mysqli_query($conn, $sql);
    // check if the user was found
    if ($result->num_rows > 0) {
        //fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);
        // decode the password from base64 to a string hash
        $hash =  base64_decode($row['passCode']);
        //verify that the password matches the hash
        if (password_verify($password, $hash)) {
              // start a session and store the username in it
            session_start();
            $_SESSION['username'] = $username;
            //redirect to Level 1 of the Game
            header("Location: ../Level 1.php");
            exit();        
        } else {
            // redirect to the index page with an error message
            header("Location: ../index.php?error=InvalidPassword");
            exit();        
        }
    } else {
        // display an error message that there is no user with this username entered
        header("Location: ../index.php?error=NoUser");
        exit();
    }

    // close the database connection
    mysqli_close($conn);
} else {
     // redirect to the index page if the form was not submitted
    header("Location: ../index.php");
    exit();
}

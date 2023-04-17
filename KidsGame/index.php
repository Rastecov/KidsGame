<?php

//add the file name database_handler.php
// this file contains the connection to the database
  require "includes/database_handler.php"; 

$dbHandler = DataBaseHandler::DbConnection();
$dbHandler->DbOpenConnection();      
$conn = $dbHandler->getDataBase();
//create database  kidsgamesdb if it does not exist
$conn->query("CREATE DATABASE IF NOT EXISTS kidsgamesdb;");

 $dbHandler->connectToDB("kidsgamesdb");
            




//select kidsgamesdb database
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




?>


<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
            

            

            require "header.php";
          

            
            //checks if any errors or success messages has passed through the URL parameters then return the appropriated message              
            if(isset($_GET['error'])){

                if ($_GET['error'] == "emptyfields") {
                    //Message for empty fields
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">You must fill all fields!!</div></div>';
                }
                if ($_GET['error'] == "NoUser") {
                    //Message error for when the username wasn't found in the database
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">Sorry, you entered a wrong Username or Password!</div></div>';
                }
                //Message error for the username is found in the database but the password is incorrect
                if ($_GET['error'] == "InvalidPassword") {
                    echo '<div class="toast alert-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Alert</strong></div><div class="toast-body"></div></div>';
                    echo'<a href="includes/Forgotten_Password.php">Forgotten? Please, change your password.</a>';

               
                }

               
                
            }
               
            //checks  success messages has passed through the URL parameters then return the appropriated message              

        
            if(isset($_GET['success'])){
            if ($_GET['success'] == "Passchanged") {
                echo '<div class="toast success-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Success</strong></div><div class="toast-body">Password changed successfully</div></div>';
            }
        }
                    
          
            
            ?>
           
        <form action="includes/Login_function.php " method ="post">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login-submit">Connect</button>
        </form>

         <form action="signup.php " method ="post">
        <button type="submit" name="signup">Sign-Up</button>
        </form>
            
            
        </section>
    </div>
</main>
<?php

require "footer.php";


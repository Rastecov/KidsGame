
<link rel ="stylesheet" href="../style.css">



<?php

//add the file name database_handler.php
require 'database_handler.php';



//check if the user submitted the forgotten password form
if (isset($_POST['forgottenPass-submit'])) {
    $Newpassword = $_POST['Newpwd'];
    $username= $_POST['username'];
    $ConfirmPassword = $_POST['Cpwd'];

// check if any of the fields are empty
    if (empty($username)|| empty($Newpassword) || empty($ConfirmPassword)) {
        header("Location: Forgotten_Password.php?error=emptyfields");
        exit();
    }
// check if the new password and confirm password are not the same
    else if ($Newpassword !== $ConfirmPassword) {
        header("Location: Forgotten_Password.php?error=NotTheSamePassword");
        exit();
    }else{

 // query the database to see if the username of the user exist 
 $sql2= "SELECT player.userName
 FROM player
 WHERE player.userName = '$username'";
$result2= mysqli_query($conn, $sql2);
//check if the query returned any rows
 if($result2->num_rows > 0 ){
             // get the registration order of the user from the player table
        $registrationOrder_result = $conn->query("SELECT player.registrationOrder FROM player WHERE player.userName = '$username'");
        if ($registrationOrder_result->num_rows > 0) {
            //fetch the row as an associative array
            $registrationOrder = $registrationOrder_result->fetch_assoc()['registrationOrder'];
             // Encrypt the new password
            $Newpassword = base64_encode(password_hash($Newpassword, PASSWORD_BCRYPT, ["cost" => 12]));
             // Update the authenticator table with the new password
            $conn->query("UPDATE authenticator SET passCode='$Newpassword' WHERE registrationOrder='$registrationOrder'");
            // close the database connection
            mysqli_close($conn);
            // Redirect to the home page with a success message
            header("Location: ../index.php?success=Passchanged");
            exit();
        } 
       
    
    
   
}

else{
// Redirect to the forgotten password page with an error message if the username is invalid
    header("Location:Forgotten_Password.php?error=UsernameInvalid");
    exit();
}


}

}

// Check if there are any errors in the URL parameters
if(isset($_GET['error'])){

    // Display an error message if any of the fields are empty
    if($_GET['error'] == "emptyfields"){

        echo "<p class ='error'> You must fill all fields!!<p> ";
        
    } 
// Display an error message if the username is invalid
else if($_GET['error'] == "UsernameInvalid"){

    echo "<p class ='error'> Please Enter the same Username that you used on the Login Page!!<p> ";
    
} 
// Display an error message if the passwords are not the same
else if($_GET['error'] == "NotTheSamePassword"){

    echo "<p class ='error'> Sorry, you entered 2 different passwords.<p> ";
}


}
?>
<!-- Display the header and navigation bar with the form to be submitted -->

<header>
    <nav>
        <a href= "index.php">
            <img src ="../KidgameIMG.png" alt="logo">
        </a>
</header>

<main>


<form action="Forgotten_Password.php" method ="post">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <label for="pwd">Password:</label>
        <input type="password" name="Newpwd" placeholder="Password">
        <label for="Cpwd">Confirm Password:</label>
            <input type ="password" name="Cpwd" placeholder ="Confirm your Password"> 
        <button type="submit" name="forgottenPass-submit">Modify your password</button>
        </form>

        <form action="../index.php" method ="post">
        <button type="submit" name="signin">Sign-In</button>
        </form>

        </main>
        <!-- Display the footer -->
        <?php include '../footer.php'?>

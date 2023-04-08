
<link rel ="stylesheet" href="../style.css">
<form action="Forgotten_Password.php" method ="post">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <label for="pwd">Password:</label>
        <input type="password" name="Newpwd" placeholder="Password">
        <label for="Cpwd">Confirm Password:</label>
            <input type ="password" name="Cpwd" placeholder ="Confirm your Password"> 
        <button type="submit" name="forgottenPass-submit">Change your password</button>
        </form>

        <form action="index.php" method ="post">
        <button type="submit" name="signin">Sign-In</button>
        </form>

<?php

require 'database_handler.php';



if (isset($_POST['forgottenPass-submit'])) {
    $Newpassword = $_POST['Newpwd'];
    $username= $_POST['username'];
    $ConfirmPassword = $_POST['Cpwd'];


    if (empty($username)|| empty($Newpassword) || empty($ConfirmPassword)) {
        header("Location: Forgotten_Password.php?error=emptyfields");
        exit();
    }

    else if ($Newpassword !== $ConfirmPassword) {
        header("Location: Forgotten_Password.php?error=NotTheSamePassword");
        exit();
    }else{

 // query the database to see if the username of the user exist 
 $sql2= "SELECT player.userName
 FROM player
 WHERE player.userName = '$username'";
$result2= mysqli_query($conn, $sql2);

 if($result2->num_rows > 0 ){
      
        $registrationOrder_result = $conn->query("SELECT player.registrationOrder FROM player WHERE player.userName = '$username'");
        if ($registrationOrder_result->num_rows > 0) {
            $registrationOrder = $registrationOrder_result->fetch_assoc()['registrationOrder'];
            $conn->query("UPDATE authenticator SET passCode='$Newpassword' WHERE registrationOrder='$registrationOrder'");
            header("Location: ../index.php?success=Passchanged");
            exit();
        } 
       
    
    
   
}

else{

    header("Location:Forgotten_Password.php?error=UsernameInvalid");
    exit();
}


}

}

if(isset($_GET['error'])){

    if($_GET['error'] == "emptyfields"){

        echo "<p class ='error'> You must fill all fields!!<p> ";
        
    } 

else if($_GET['error'] == "UsernameInvalid"){

    echo "<p class ='error'> Please Enter the same Username that you used on the Login Page!!<p> ";
    
} 

else if($_GET['error'] == "NotTheSamePassword"){

    echo "<p class ='error'> Sorry, you entered 2 different passwords.<p> ";
}


}


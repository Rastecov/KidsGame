<?php

session_start();


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    
<header>
    <nav>
        <a href= "#">
            <img src ="KidgameIMG.png" alt="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About US</a></li>
            <li><a href="#">Contact</a></li>
        </ul>


    </nav>


    <?php
        
       
           
        echo '  <form action="includes/login_function.php " method ="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login-submit">Login</button>
    </form>
    <a href="signup.php">Signup</a>';





    
?>

</header>
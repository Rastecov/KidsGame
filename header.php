<link rel ="stylesheet" href="style.css">
<?php

session_start();
if (!isset($_SESSION['lives'])) {
    $_SESSION['lives'] = 2;
}
echo'<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    
<header>
    <nav>
        <a href= "index.php">
            <img src ="KidgameIMG.png" alt="logo">
        </a>

    </nav> <br>';
if(isset($_SESSION['username'])){
 echo'<form method="post" action="includes/logout.php">
 <button type="submit">Logout</button>
</form>';
}
else{
   
    
}

?>


</header>
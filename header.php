<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title></title>
</head>
<body>
    <header>
        <a href="index.php" class="logo-link" aria-label="index.php">
            <img src="KidgameIMG.png" alt="KidsGame Logo">
        </a>
        <nav>
            <ul class="header-links" id='header-links'>
                <a href="About the Game.php">About the Game</a>
                <a href="History.php">History</a>
                <a href="index.php">Home</a>
            </ul>
        </nav>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '<form method="post" action="includes/logout.php">
                <button type="submit">Logout</button>
            </form>';

            

        } else {
        }
        if (!isset($_SESSION['lives'])) {
            //initializing the session variable live to 6
                $_SESSION['lives'] = 6;
            }
    

              
        ?>
        


    </header>



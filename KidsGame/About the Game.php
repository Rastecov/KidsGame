<?php
require "header.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About the Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>About the Game</h1>
    </header>
    <main>
        <section>
            <h2>Game Overview</h2>
            <p>KidsGame consists of six different levels that challenge your ability to order numbers and letters in ascending and descending order, identify the first and last letters from a set of letters, and identify the minimum and maximum numbers from a set of numbers. Each level has its own form that allows players to play with numbers from 0 to 100 and alphabet letters from a to z, lower case or/and uppercase.</p>
      <p>To play the game, simply submit the form for each level with the correct order of numbers or letters. If you win the game, a button "Go to the Next Level" will appear for you to proceed to the next level. However, if you lose the game, a button "Try Again this Level" will appear for you to retry the current level.</p>
      <p>If it's not the last level and you win the game, you will see a result message with a button "Sign Out" and "Stop this Session" to end your playing session. If it's the last level and you win the game, congratulations! You will see a result message with a button "Play Again", "Home Page", and "Sign Out" to end your playing session.</p>
      <p>Please keep in mind that you only have six lives for each playing session. If you use up all your lives and fail to win the game, it's game over.</p>
       </section>
        <section>
            <h2>Gameplay</h2>
                    <ul>
                        <li>
                            <h3>Game Level 1: Order letters in ascending order</h3>
                            <p>A set of 6 different letters generated randomly is shown, and you must use the form available to write them in ascending order (from a to z).</p>
                        </li>
                        <li>
                            <h3>Game Level 2: Order letters in descending order</h3>
                            <p>A set of 6 different letters generated randomly is shown, and you must use the form available to write them in descending order (from z to a).</p>
                        </li>
                        <li>
                            <h3>Game Level 3: Order numbers in ascending order</h3>
                            <p>A set of 6 different numbers generated randomly is shown, and you must use the form available to write them in ascending order (from 0 to 100).</p>
                        </li>
                        <li>
                            <h3>Game Level 4: Order numbers in descending order</h3>
                            <p>A set of 6 different numbers generated randomly is shown, and you must use the form available to write them in descending order (from 100 to 0).</p>
                        </li>
                        <li>
                            <h3>Game Level 5: Identify first and last letters from a set of letters</h3>
                            <p>A set of 6 different letters generated randomly is shown, and you must use the form available to write the first letter and the last letter (from the order a to z).</p>
                        </li>
                        <li>
                            <h3>Game Level 6: Identify the minimum and the maximum numbers from a set of numbers</h3>
                            <p>A set of 6 different numbers generated randomly is shown, and you must use the form available to write the minimum number and the maximum number (from the order 0 to 100).</p>
                        </li>
                    </ul>
                    

        </section>
        <section>
            <h2>Meet the Team</h2>
            <ul>
                <li>Boko Eraste Yacov Jesumen - Lead Developer</li>
                <li>Voskerchyan Gagik - Graphics Designer</li>
                <li>Weixuan Li - Database administrator</li>
                <li>Wang Yucheng - Game Level Designer</li>
            </ul>
        </section>
    </main>
    <?php
    
    require 'footer.php';
    ?>
</body>
</html>

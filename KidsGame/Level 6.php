<?php

require "header.php";

if (isset($_SESSION['username'])) {
    if($_SESSION['levelCheck']==='completed'){



    function endofTheGame()
    {  
        echo '<form method="post" action="level congratulation.php">
        <button type="submit">Continue</button>
    </form>';
      
    }

    function backToLevel6()
    {
        echo '<form method="post" action="level 6.php">
        <button type="submit">Try Again this Level</button>
    </form>';
    }

    if (isset($_POST['number'])) {
        $input_numbers = explode(",", ($_POST['number']));
        $input_numbers = array_map('trim', $input_numbers);

        if (count($input_numbers) != 2) {
            echo "<p class ='error'>Please enter 2 numbers, separated by a comma.</p>";
            backToLevel6();
        } else {
            $difference = array_diff($input_numbers, explode(", ", $_SESSION['number']));
            if (!empty($difference)) {
                echo "<p class='error'>Please enter numbers that are not different from the ones displayed.</p>";
                backToLevel6();
                exit();
            } else {
                $displayed_numbers = explode(", ", $_SESSION['number']);
                $first_letter = min($displayed_numbers);
                $last_letter = max($displayed_numbers);

                if ($input_numbers[0] == $first_letter && $input_numbers[1] == $last_letter) {
                    echo "<p class='success'>You have successfully found the minimum and maximum numbers!!</p>";
                    $_SESSION['level'] = 'success';
                    endofTheGame();
                } else {
                    echo "<p class ='error'>Sorry, the numbers you entered did not match the first and last numbers. Please try again.</p>";

                    $_SESSION['lives']--;

                    if ($_SESSION['lives'] == 0) {
                        echo "<p class ='error'>Game over. You ran out of lives.</p>";
                        $username = $_SESSION['username'];
                          $_SESSION['username'] = $username;
                        $_SESSION['level'] = 'failure';

                        echo '<form method="post" action="Level 1.php">
                            <button type="submit">Start a new game Session Level</button>
                        </form>';
                    } else {
                        echo "Lives: " . $_SESSION['lives'] . "<br>";
                        backToLevel6();
                    }
                }
            }
        }
    } else {
        if (isset($_SESSION['number'])) {
            // Use the previously generated number
            $sorted_numbers = $_SESSION['number'];
        } else {
            $numbers = array();
            for ($i = 0; $i < 6; $i++) {
                $numbers[] = rand(0, 100);
            }
            $sorted_numbers = implode(", ", $numbers);


            // Store the generated number in the session variable
            $_SESSION['number'] = $sorted_numbers;
        }

        echo "<p id='letters-label'>The random number generated are: $sorted_numbers</p>";
?>
        <form method="post" action="">
            <label for='number' id='letters-label'>Level 6:Enter the Minimum and the Maximum of these numbers:</label>
            <input type="text" id="number" name="number">
            <button type="submit">Submit</button>
        </form>

<?php
    }
}else{
    
        header("Location: Level 3.php?error=Notpermittedaction");
    }
} else {

    echo "<p class='error'> You need to login first, Sign in below!!</p>";


    echo '<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}

require 'footer.php';

?>
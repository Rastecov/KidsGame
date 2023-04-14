<?php

require "header.php";

// checks if the session variable username is set when the user is log into the game else display an error message.
if (isset($_SESSION['username'])) {

    if ($_SESSION['levelCheck'] === 'completed') {


        // Display the congratulation message when the user clicks on the button
        function endofTheGame()
        {
            echo '<form method="post" action="level congratulation.php">
        <button type="submit">Continue</button>
    </form>';
        }
        // go back to level 6
        function backToLevel6()
        {
            echo '<form method="post" action="level 6.php">
        <button type="submit">Try Again this Level</button>
    </form>';
        }

        //Check if the form named number is submitted
        if (isset($_POST['number'])) {
            // Split the input numbers by comma.
            $input_numbers = explode(",", ($_POST['number']));
            // Removes any leading or trailing whitespace from the input number.
            $input_numbers = array_map('trim', $input_numbers);
            // Validate that the user entered 2 numbers separated by commas.
            if (count($input_numbers) != 2) {
                echo "<p class ='error'>Please enter 2 numbers, separated by a comma.</p>";
                backToLevel6();
            } else {
                // Check if any of the entered letters match any of the displayed letters
                $difference = array_diff($input_numbers, explode(", ", $_SESSION['number']));
                if (!empty($difference)) {
                    echo "<p class='error'>Please enter numbers that are not different from the ones displayed.</p>";
                    backToLevel6();
                    exit();
                } else {
                    //Split each character of the string displayed_numbers by comma  .  
                    $displayed_numbers = explode(", ", $_SESSION['number']);
                    //get the minumum value of the string
                    $first_letter = min($displayed_numbers);
                    //get the maximum value of the string
                    $last_letter = max($displayed_numbers);
                    //Validate that the user has found the correct min and max value of the string
                    if ($input_numbers[0] == $first_letter && $input_numbers[1] == $last_letter) {
                        echo "<p class='success'>You have successfully found the minimum and maximum numbers!!</p>";
                        // Validating that the user have cleared the game and return sucess for the session level variable
                        $_SESSION['level'] = 'success';
                        //Show the congratulation page
                        endofTheGame();
                    } else {
                        //error message if the user haven't entered the right values

                        echo "<p class ='error'>Sorry, the numbers you entered did not match the first and last numbers. Please try again.</p>";
                        //decreasing user  lives by 1
                        $_SESSION['lives']--;
                        //check if lives have run out then display the appropriate message

                        if ($_SESSION['lives'] == 0) {
                            echo "<p class ='error'>Game over. You ran out of lives.</p>";
                            $username = $_SESSION['username'];
                            $_SESSION['username'] = $username;
                            $_SESSION['level'] = 'failure';
                            // start a new Game session when the user clicks on the button
                            echo '<form method="post" action="Level 1.php">
                            <button type="submit">Start a new game Session Level</button>
                        </form>';
                        } else {
                            //displaying the user current number of live

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
            //displaying the number generated

            echo "<p id='letters-label'>The random number generated are: $sorted_numbers</p>";
?>
            <form method="post" action="">
                <label for='number' id='letters-label'>Level 6:Enter the Minimum and the Maximum of these numbers:</label>
                <input type="text" id="number" name="number">
                <button type="submit">Submit</button>
            </form>

<?php
        }
    } else {
        //displaying the error message for the user to complete his current level first

        header("Location: Level 5.php?error=Notpermittedaction");
    }
} else {

    //displaying the error message for the user to log in first

    echo "<p class='error'> You need to login first, Sign in below!!</p>";

    //sign in button
    echo '<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}

require 'footer.php';

?>
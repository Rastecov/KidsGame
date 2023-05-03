<?php

require "header.php";
// checks if the session variable username is set when the user is log into the game else display an error message.
if (isset($_SESSION['username'])) {
    if ($_SESSION['levelCheck'] === 'completed') {

        // This function displays a form that submits to level 6 when the user clicks on the button.

        function redirectToLevel6()
        {

            echo '<form method="post" action="level 6.php">
        <button type="submit">Go the Level 6</button>
    </form>';
        }

        // This function displays a form that submits to level 5 when the user clicks on the button.

        function backToLevel5()
        {
            echo '<form method="post" action="level 5.php">
        <button type="submit">Try Again this Level</button>
    </form>';
        }

        //Check if the form named letters is submitted

        if (isset($_POST['letters'])) {
            // Split the input letters by comma.
            $input_letters = explode(",", strtolower($_POST['letters']));
            // Removes any leading or trailing whitespace from the input letters.
            $input_letters = array_map('trim', $input_letters);
            // Validate that the user entered 2 letters separated by commas.
            if (count($input_letters) != 2) {
                echo "<p class ='error'>Please enter 2 letters, separated by a comma.</p>";
                backToLevel5();
            } else {
                // Check if any of the entered letters match any of the displayed letters
                $difference = array_diff($input_letters, explode(", ", $_SESSION['letters']));
                if (!empty($difference)) {
                    echo "<p class='error'>Please enter letters that are not different from the ones displayed.</p>";
                    backToLevel5();
                    exit();
                } else {
                    // Split the displayed_letters by comma.

                    $displayed_letters = explode(", ", $_SESSION['letters']);
                    //get the minumum value of the string
                    $first_letter = min($displayed_letters);
                    //get the maximum value of the string
                    $last_letter = max($displayed_letters);
                    //Validate that the user has found the correct min and max value of the string
                    if ($input_letters[0] == $first_letter && $input_letters[1] == $last_letter) {
                        echo "<p class='success'>You have successfully found the the first and the last letter of the alphabet of these letters!!</p>";
                        //freeing the session variable letters before going to the next level to generate new values
                        unset($_SESSION["letters"]);

                        $_SESSION['level'] = 'incomplete';
                        //redirect to level 6
                        redirectToLevel6();
                    } else {
                        //error message if the user haven't sorted the letters in a good order

                        echo "<p class ='error'>Sorry, the letters you entered did not match the first and last letters. Please try again.</p>";
                        //decreasing user  lives by 1
                        $_SESSION['lives']--;
                        //check if lives have run out then display the appropriate message
                        if ($_SESSION['lives'] == 0) {
                            echo "<p class ='error'>Game over. You ran out of lives.</p>";
                            $username = $_SESSION['username'];
                            $_SESSION['level'] = 'failure';
                            $_SESSION['username'] = $username;
                            // start a new Game session when the user clicks on the button
                            echo '<form method="post" action="Level 1.php">
                         <button type="submit">Start a new game Session Level</button>
                     </form>';
                        } else {
                            //displaying the user current number of live

                            echo "Lives: " . $_SESSION['lives'] . "<br>";
                            backToLevel5();
                        }
                    }
                }
            }
        } else {

            if (isset($_SESSION['letters'])) {
                // Use the previously generated letters
                $randomString = $_SESSION['letters'];
            } else {
                $n = 6;
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                $randomString = '';

                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                    if ($i < $n - 1) {
                        $randomString .= ", ";
                    }
                }      // Store the generated letters in the session variable

                $_SESSION['letters'] = $randomString;
            }
            //displaying the letters generated

            echo "<p id='letters-label'>The random letters generated are: $randomString</p>";
?>
            <form method="post" action="">
                <label for='letters' id='letters-label'>Level 5: Enter the first and the last letter of the alphabet of these letters:</label>
                <input type="text" id="letters" name="letters">
                <button type="submit">Submit</button>
            </form>


<?php
        }
    } else {
        //displaying the error message for the user to complete his current level first

        header("Location: Level 4.php?error=Notpermittedaction");
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
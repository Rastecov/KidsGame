<?php
require "header.php";
//checks if the 'error' parameter was passed in the URL and if it has the value 'Notpermittedaction', and displays an error message
if (isset($_GET['error'])) {
    if ($_GET['error'] == "Notpermittedaction") {
        echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">You are not permitted access to that Level yet. Please finish your current level first!!</div></div>';
    }
}
// checks if the session variable username is set when the user is log into the game else display an error message.

if (isset($_SESSION['username'])) {
    if ($_SESSION['levelCheck'] === 'completed') {

        // This function displays a form that submits to level 5 when the user clicks on the button.

        function redirectToLevel5()
        {

            echo '<form method="post" action="level 5.php">
      <button type="submit">Go the Level 5</button>
  </form>';
        }
        // This function displays a form that submits to level 4 when the user clicks on the button.

        function backToLevel4()
        {
            echo '<form method="post" action="level 4.php">
      <button type="submit">Try Again this Level</button>
  </form>';
        }
        //Check if the form named number is submitted

        if (isset($_POST['number'])) {
            // Split the input number by comma.
            $input_number = explode(",", strtolower($_POST['number']));
            // Removes any leading or trailing whitespace from the input letters.
            $input_number = array_map('trim', $input_number);

            // Validate that all input number are different than the ones displayed
            if (count($input_number) != 6) {
                echo "<p class ='error'>Please enter 6 number, separated by commas.</p>";
                backToLevel4();
            } else {
                // Check if any of the entered number match any of the displayed number
                $difference = array_diff($input_number, explode(", ", $_SESSION['number']));
                if (!empty($difference)) {
                    echo "<p class='error'>Please enter numbers that are not different from the ones displayed.</p>";
                    backToLevel4();
                    exit();
                } else {

                    //declaring a global variable $input_letters and assigns to it the value of the input letters.           
                    global $input_number;
                    $sorted_input_number = $input_number;
                    //sorts the input numbers in descending order.
                    rsort($sorted_input_number);
                    // Convert the sorted input letters array back into a string with commas separating the letters.
                    $sorted_input_number_str = implode(", ", $sorted_input_number);
                    //display the letter that the user have submitted
                    echo "Your input: " . implode(", ", $input_number) . "<br/>";


                    // Validate if all the input number match the sorted number
                    if ($sorted_input_number_str === implode(", ", $input_number)) {
                        echo "<p class='success'>You have successfully odered these numbers in descending order </p>";
                        //freeing the session variable number before going to the next level to generate new values
                        unset($_SESSION["number"]);
                        $_SESSION['level'] = 'incomplete';
                        redirectToLevel5();
                    } else {

                        //error message if the user haven't sorted the numbers in a good order
                        echo "<p class ='error'>Sorry, the number you entered did not match the sorted number. Please try again.</p>";
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
                            backToLevel4();
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
                <label for='number' id='letters-label'>Level 4: Enter the 6 numbers in descending order::</label>
                <input type="text" id="number" name="number">
                <button type="submit">Submit</button>
            </form>

<?php
        }
    } else {
        //displaying the error message for the user to complete his current level first  
        header("Location: Level 3.php?error=Notpermittedaction");
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
<?php
require "header.php";
function redirectToLevel5() {
  echo '<form method="post" action="level 5.php">
      <button type="submit">Go the Level 5</button>
  </form>';
}

function backToLevel4() {
  echo '<form method="post" action="level 4.php">
      <button type="submit">Try Again this Level</button>
  </form>';
}

if (isset($_POST['number'])) {

    $input_number = explode(",", strtolower($_POST['number']));
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


            global $input_number;
            $sorted_input_number = $input_number;
            rsort($sorted_input_number);
            $sorted_input_number_str = implode(", ", $sorted_input_number);

            echo "Your input: " . implode(", ", $input_number) . "<br/>";


            // Validate if all the input number match the sorted number
            if ($sorted_input_number_str === implode(", ", $input_number)) {
                echo "<p class='success'>You have won the game!</p>";
                $_SESSION['level'] = 'incomplete';
                redirectToLevel5();
                
            } else {
                echo "<p class ='error'>Sorry, the number you entered did not match the sorted number. Please try again.</p>";

                $_SESSION['lives']--;


                if ($_SESSION['lives'] == 0) {
                    echo "<p class ='error'>Game over. You ran out of lives.</p>";
                    $username = $_SESSION['username'];
                    $_SESSION['level'] = 'failure';
                    session_unset();
                    $_SESSION['username'] = $username;
                    

                    echo '<form method="post" action="Level 1.php">
                            <button type="submit">Start a new game Session Level</button>
                        </form>';
                } else {
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

    echo "<p>The random number generated are: $sorted_numbers</p>";
?>
    <form method="post" action="">
        <label for="number">Enter the 6 numbers in descending order::</label>
        <input type="text" id="number" name="number">
        <button type="submit">Submit</button>
    </form>

<?php
}

require "footer.php";
?>
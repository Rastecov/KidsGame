<?php
require "header.php";
function redirectToLevel2() {
  echo '<form method="post" action="level 2.php">
      <button type="submit">Go the Level 2</button>
  </form>';
}

function backToLevel1() {
  echo '<form method="post" action="level 2.php">
      <button type="submit">Try Again this Level</button>
  </form>';
}

if (isset($_POST['letters'])) {

    $input_letters = explode(",", strtolower($_POST['letters']));
    $input_letters = array_map('trim', $input_letters);

    // Validate that all input letters are different than the ones displayed
    if (count($input_letters) != 6) {
        echo "<p class ='error'>Please enter 6 letters, separated by commas.</p>";
        backToLevel1();
    } else {
        // Check if any of the entered letters match any of the displayed letters
        $difference = array_diff($input_letters, explode(", ", $_SESSION['letters']));
        if (!empty($difference)) {
            echo "<p class='error'>Please enter letters that are not different from the ones displayed.</p>";
            backToLevel1();
            exit();
        } else {


            global $input_letters;
            $sorted_input_letters = $input_letters;
            sort($sorted_input_letters);
            $sorted_input_letters_str = implode(", ", $sorted_input_letters);

            echo "Your input: " . implode(", ", $input_letters) . "<br/>";


            // Validate if all the input letters match the sorted letters
            if ($sorted_input_letters_str === implode(", ", $input_letters)) {
                echo "<p class='success'>You have won the game!</p>";
                $_SESSION['level'] = 'incomplete';
                redirectToLevel2();
                
            } else {
                echo "<p class ='error'>Sorry, the letters you entered did not match the sorted letters. Please try again.</p>";

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
                    backToLevel1();
                    
                }
            }
        }
    }
} else {if (isset($_SESSION['letters'])) {
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
  }

  // Store the generated letters in the session variable
  $_SESSION['letters'] = $randomString;
}

echo "<p>The random letters generated are: $randomString</p>";
?>
<form method="post" action="">
  <label for="letters">Enter the 6 letters in ascending order:</label>
  <input type="text" id="letters" name="letters">
  <button type="submit">Submit</button>
</form>

<?php
}

require "footer.php";
?>
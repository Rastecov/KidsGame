
// checks if the user has submitted the form  input letters
if (isset($_POST['letters'])) {

     // Split the input letters by comma and makes them all lowercase.
    $input_letters = explode(",", strtolower($_POST['letters']));
    // Removes any leading or trailing whitespace from the input letters.
    $input_letters = array_map('trim', $input_letters);

    // Validate that the user entered 6 letters separated by commas.
    if (count($input_letters) != 6) {
        echo "<p class ='error'>Please enter 6 letters, separated by commas.</p>";
        backToLevel2();
    } else {
        // Check if any of the entered letters match any of the displayed letters
        $difference = array_diff($input_letters, explode(", ", $_SESSION['letters']));
        if (!empty($difference)) {
            echo "<p class='error'>Please enter letters that are not different from the ones displayed.</p>";
            backToLevel2();
            exit();
        } else {

            //declaring a global variable $input_letters and assigns to it the value of the input letters.           
         global $input_letters;
            $sorted_input_letters = $input_letters;
             //sorts the input letters in descending order.
            rsort($sorted_input_letters);
            // Convert the sorted input letters array back into a string with commas separating the letters.
            $sorted_input_letters_str = implode(", ", $sorted_input_letters);
            //display the letter that the user have submitted
            echo "Your input: " . implode(", ", $input_letters) . "<br/>";


            // Validate if all the input letters match the sorted letters
            if ($sorted_input_letters_str === implode(", ", $input_letters)) {
                echo "<p class='success'>You have successfully  odered these letters in descending order</p>";
                // Validating that the user have cleared this level
                $_SESSION['levelCheck']='completed';
                 $_SESSION['level'] = 'incomplete';

                //freeing the session variable letters before going to the next level to generate new values
                unset($_SESSION["letters"]);
                redirectToLevel3();
                
            } else {
                //error message if the user haven't sorted the letters in a good order
                echo "<p class ='error'>Sorry, the letters you entered did not match the sorted letters. Please try again.</p>";
                //decreasing user  lives by 1
                $_SESSION['lives']--;

                //check if lives have run out then display the appropriate message
                if ($_SESSION['lives'] == 0) {
                    echo "<p class ='error'>Game over. You ran out of lives.</p>";
                    
                    $_SESSION['level'] = 'failure';
                                      

                    echo '<form method="post" action="Level 1.php">
                            <button type="submit">Start a new game Session Level</button>
                        </form>';
                } else {
                    //displaying the user current number of live
                    echo "Lives: " . $_SESSION['lives'] . "<br>";
                    backToLevel2();
                    
                }
            }
        }
    }
} else {
    //
    if (isset($_SESSION['letters'])) {
  // Use the previously generated letters
  $randomString = $_SESSION['letters'];
} else {
  $n = 6;
  $characters = 'abcdefghijklmnopqrstuvwxyz';
  $randomString = '';
//Generate 6 letters from the string character
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

//displaying the letters generated
echo "<p id='letters-label'>The random letters generated are: $randomString</p>";
?>



<form method="post" action="">
  <label for='letters' id='letters-label'>Level 2: Enter the 6 letters in descending order:</label>
  <input type="text" id="letters" name="letters">
  <button type="submit">Submit</button>
</form>
<?php
    }
}else{

    header("Location: Level 1.php?error=Notpermittedaction");
}
} else {
    
    //displaying the error message for the user to log in first
    echo "<p class='error'> You need to login first, Sign in below!!</p>";


    echo '<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}

require 'footer.php';

?>
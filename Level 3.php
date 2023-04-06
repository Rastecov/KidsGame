<?php
require "header.php";
function redirectToLevel4() {
  echo '<form method="post" action="level4.php">
      <button type="submit">Go the Level 4</button>
  </form>';
}

function backToLevel3() {
  echo '<form method="post" action="level 3.php">
      <button type="submit">Try Again this Level</button>
  </form>';
}
// Check if form has been submitted
if (isset($_POST['numbers'])) {
  // User has submitted the form, check if numbers are in ascending order
  $input_numbers = explode(",", $_POST['numbers']);
  $input_numbers = array_map('trim', $input_numbers);

  if (count($input_numbers) != 6) {
    echo "<p>Please enter 6 numbers, separated by commas.</p>";
    backToLevel3();

  } else {
    $sorted_input = implode(", ", $input_numbers);
    sort($input_numbers);

    if ($sorted_input === implode(", ", $input_numbers)) {
      echo "<p>You have won the game!</p>";
      redirectToLevel4();

    } else {
      echo "<p>Sorry, the numbers you entered did not match the sorted numbers. Please try again.</p>";
      $_SESSION['lives']--;
            
      echo "<p>Sorry, the numbers you entered did not match the sorted numbers. Please try again.</p>";
            
      $_SESSION['lives']--;
      
      if ($_SESSION['lives'] == 0) {
        echo "Game over. You ran out of lives.";
        //storing the current username in the variable username
        $username=$_SESSION['username'];
        //deleting the data in all the session variables
    session_unset();
   //Storing the previously saved username in the new session variable username to be able to display the button logout
   $_SESSION['username'] = $username;
      
      echo '<form method="post" action="Level 1.php">
      <button type="submit">Start a new game Session Level</button>
  </form>';
      
          
      }else{
          echo "Lives: " . $_SESSION['lives'] . "<br>";
          backToLevel3();
          
      }
    }
  }
} else {
  // Generate 6 random numbers from 0-100
  $numbers = array();
  for ($i = 0; $i < 6; $i++) {
    $numbers[] = rand(0, 100);
  }
  $sorted_numbers = implode(", ", $numbers);

  // Show the numbers to the user
  echo "<p>The random numbers are: $sorted_numbers</p>";

  // Show the form to the user
  ?>
  <form method="post" action="">
    <label for="numbers">Enter the 6 numbers in ascending order:</label>
    <input type="text" id="numbers" name="numbers">
    <button type="submit">Submit</button>
  </form>
  <?php
}
?>
<?php

require "footer.php";
?>
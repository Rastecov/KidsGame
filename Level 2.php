<?php
require "header.php";
// Check if form has been submitted
function redirectToLevel3() {
  echo '<form method="post" action="level 3.php">
      <button type="submit">Go the Level 3</button>
  </form>';
}
function backToLevel2() {
  echo '<form method="post" action="level 2.php">
      <button type="submit">Try Again this Level</button>
  </form>';
}
if (isset($_POST['letters'])) {
  // User has submitted the form, check if numbers are in ascending order
  $input_letters = explode(",", $_POST['letters']);
  $input_letters = array_map('trim', $input_letters);

  if (count($input_letters) != 6) {
    echo "<p>Please enter 6 letters, separated by commas.</p>";
    backToLevel2();
  } else {

    $sorted_letterInput = implode(", ", $input_letters);
    rsort($input_letters);
    $sortedString = implode(' ', $input_letters); 
    echo $sortedString. "<br/>";

    if ($sorted_letterInput === implode(", ", $input_letters)) {
        echo "<p>You have won the game!</p>";
        redirectToLevel3();

      } else {
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
            backToLevel2();
            
        }
      }

 

   
  }
} else {
  // Generate 6 random letters from the alphabet
   $n = 6;
    
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
     
    for ($i = 0; $i <$n; $i++) {
       $index = rand(0, strlen($characters) - 1);
       $randomString .= $characters[$index];
     if ($i < $n - 1) {
      $randomString .= ", ";
     }
    }
     

  // Show the letters generated to the user
    echo "The random letters generated are : "."<br/>".$randomString."<br/>"; 
     

  // Show the form to the user
  ?>
  <form method="post" action="">
    <label for="letters">Enter the 6 letters in descending order:</label>
    <input type="text" id="letters" name="letters">
    <button type="submit">Submit</button>
  </form>
  <?php
}
?>
<?php

require "footer.php";
?>

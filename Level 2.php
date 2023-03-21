<?php
// Check if form has been submitted
if (isset($_POST['letters'])) {
  // User has submitted the form, check if numbers are in ascending order
  $input_letters = explode(",", $_POST['letters']);
  $input_letters = array_map('trim', $input_letters);

  if (count($input_letters) != 6) {
    echo "<p>Please enter 6 letters, separated by commas.</p>";
  } else {

    $sorted_letterInput = implode(", ", $input_letters);
    rsort($input_letters);
    $sortedString = implode(' ', $input_letters); 
    echo $sortedString. "<br/>";

    if ($sorted_letterInput === implode(", ", $input_letters)) {
        echo "<p>You have won the game!</p>";
      } else {
        echo "<p>Sorry, the numbers you entered did not match the sorted numbers. Please try again.</p>";
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
    <label for="letters">Enter the 6 letters in ascending order:</label>
    <input type="text" id="letters" name="letters">
    <button type="submit">Submit</button>
  </form>
  <?php
}
?>

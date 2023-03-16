<?php
// Check if form has been submitted
if (isset($_POST['numbers'])) {
  // User has submitted the form, check if numbers are in ascending order
  $input_numbers = explode(",", $_POST['numbers']);
  $input_numbers = array_map('trim', $input_numbers);

  if (count($input_numbers) != 6) {
    echo "<p>Please enter 6 numbers, separated by commas.</p>";
  } else {
    $sorted_input = implode(", ", $input_numbers);
    sort($input_numbers);

    if ($sorted_input === implode(", ", $input_numbers)) {
      echo "<p>You have won the game!</p>";
    } else {
      echo "<p>Sorry, the numbers you entered did not match the sorted numbers. Please try again.</p>";
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

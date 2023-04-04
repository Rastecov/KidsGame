<<?php
// Check if form has been submitted
function redirectToLevel5() {
  echo '<form method="post" action="level5.php">
      <button type="submit">Proceed to Level 5</button>
  </form>';
}

function backToLevel4() {
  echo '<form method="post" action="level4.php">
      <button type="submit">Back to Level 4</button>
  </form>';
}
if (isset($_POST['numbers'])) {
  // User has submitted the form, check if numbers are in descending order
  $input_numbers = explode(",", $_POST['numbers']);
  $input_numbers = array_map('trim', $input_numbers);

  if (count($input_numbers) != 6) {
    echo "<p>Please enter 6 numbers, separated by commas.</p>";
    backToLevel4();

  } else {
    $rsorted_input = implode(", ", $input_numbers);
    rsort($input_numbers);

    if ($rsorted_input === implode(", ", $input_numbers)) {
      echo "<p>You have won the game!</p>";
      redirectToLevel5();
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
  $rsorted_numbers = implode(", ", $numbers);

  // Show the numbers to the user
  echo "<p>The random numbers are: $rsorted_numbers</p>";

  // Show the form to the user
  ?>
  <form method="post" action="">
    <label for="numbers">Enter the 6 numbers in descending order:</label>
    <input type="text" id="numbers" name="numbers">
    <button type="submit">Submit</button>
  </form>
  <?php
}
?>

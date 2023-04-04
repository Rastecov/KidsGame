

<?php
generateRandomNumbers();
?>
<form method="post">
    <br />
    <label class="center" for="word">Enter the minimum number and maximum number separated by comma.</label>
    <input type="text" name="numbers">
    <button type="submit">Submit</button>
</form>
</div>

<?php

function backToLevel5() {
  echo '<form method="post" action="level5.php">
      <button type="submit">Back to Level 5</button>
  </form>';
}
function generateRandomNumbers()
{
    global $random_numbers;
    $n = 6;
    // Generate an array of random numbers between 1 and 100
    for ($i = 0; $i < $n; $i++) {
        $random_numbers[] = rand(1, 100);
    }

    // Print the sorted array of random numbers
    echo "<br/>"."The random Numbers generated are : "."<br/>"; 
    foreach ($random_numbers as $number) {
        echo " ".$number . " ";
    }

    return $random_numbers;
}

if (isset($_POST['numbers'])) {
    $numbers = $_POST['numbers'];
    $numbers_array = explode(',', $numbers);

    $numbers_array = array_map('trim', $numbers_array);

    $numbers_array = array_filter($numbers_array);

    $isValid = true;
    foreach ($numbers_array as $number) {
        if (!is_numeric($number)) {
            $isValid = false;
            break;
        }
    }

    if ($isValid) {
        if (!empty($numbers_array)) {
            $min_number = min($numbers_array);
            $max_number = max($numbers_array);

            echo 'Smallest number: ' . $min_number . '<br>';
            echo 'Biggest number: ' . $max_number;
            backToLevel5();
        } else {
            echo 'Please enter at least one number';
        }
    } else {
        echo 'Please enter only numbers separated by commas';
    }
}
?>

</body>
</html>

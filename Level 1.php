<?php
require "header.php";

function redirectToLevel2() {
    echo '<form method="post" action="level2.php">
        <button type="submit">Proceed to Level 2</button>
    </form>';
}

if (isset($_POST['letters'])) {
    $input_letters = explode(",", $_POST['letters']);
    $input_letters = array_map('trim', $input_letters);

    if (count($input_letters) != 6) {
        echo "<p>Please enter 6 letters, separated by commas.</p>";
    } else {
        $sorted_input_letters = $input_letters;
        sort($sorted_input_letters);
        $sorted_input_letters_str = implode(", ", $sorted_input_letters);

        echo "Your input: " . implode(", ", $input_letters) . "<br/>";

        if ($sorted_input_letters_str === implode(", ", $input_letters)) {
            echo "<p>You have won the game!</p>";
            redirectToLevel2();
        } else {
            echo "<p>Sorry, the numbers you entered did not match the sorted numbers. Please try again.</p>";
        }
    }
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

    echo "<p>The random letters generated are: $randomString</p>";
?>
    <form method="post" action="">
        <label for="letters">Enter the 6 letters in ascending order:</label>
        <input type="text" id="letters" name="letters">
        <button type="submit">Submit</button>
    </form>
<?php
}

echo '<form action="includes/logout.php" method="post">
<button class="logout-btn" type="submit" name="logout-submit">Logout</button>
</form>';
?>

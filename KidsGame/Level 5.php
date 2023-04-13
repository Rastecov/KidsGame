<?php

require "header.php";
if (isset($_SESSION['username'])) {
    if($_SESSION['levelCheck']==='completed'){

function redirectToLevel6()
{
   
    echo '<form method="post" action="level 6.php">
        <button type="submit">Go the Level 6</button>
    </form>';
      
}

function backToLevel5()
{
    echo '<form method="post" action="level 5.php">
        <button type="submit">Try Again this Level</button>
    </form>';
}

if (isset($_POST['letters'])) {
    $input_letters = explode(",", strtolower($_POST['letters']));
    $input_letters = array_map('trim', $input_letters);

    if (count($input_letters) != 2) {
        echo "<p class ='error'>Please enter 2 letters, separated by a comma.</p>";
        backToLevel5();
    } else {
        $difference = array_diff($input_letters, explode(", ", $_SESSION['letters']));
        if (!empty($difference)) {
            echo "<p class='error'>Please enter letters that are not different from the ones displayed.</p>";
            backToLevel5();
            exit();
        } else {
            $displayed_letters = explode(", ", $_SESSION['letters']);
            $first_letter = min($displayed_letters);
            $last_letter = max($displayed_letters);

            if ($input_letters[0] == $first_letter && $input_letters[1] == $last_letter) {
                echo "<p class='success'>You have successfully found the the first and the last letter of the alphabet of these letters!!</p>";
                 //freeing the session variable letters before going to the next level to generate new values

                unset($_SESSION["letters"]);
                $_SESSION['level'] = 'incomplete';
                redirectToLevel6();
            } else {
                echo "<p class ='error'>Sorry, the letters you entered did not match the first and last letters. Please try again.</p>";

                $_SESSION['lives']--;

                if ($_SESSION['lives'] == 0) {
                    echo "<p class ='error'>Game over. You ran out of lives.</p>";
                    $username = $_SESSION['username'];
                    $_SESSION['level'] = 'failure';
                    $_SESSION['username'] = $username;;
                } else {
                    echo "Lives: " . $_SESSION['lives'] . "<br>";
                    backToLevel5();
                }
            }
        }
    }
} else {
    if (isset($_SESSION['letters'])) {
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
        $_SESSION['letters'] = $randomString;
    }

    echo "<p id='letters-label'>The random letters generated are: $randomString</p>";
?>
    <form method="post" action="">
        <label for='letters'id='letters-label'>Level 5: Enter the first and the last letter of the alphabet of these letters:</label>
        <input type="text" id="letters" name="letters">
        <button type="submit">Submit</button>
    </form>


<?php
    }
}else{
    
        header("Location: Level 3.php?error=Notpermittedaction");
    }
} else {

    echo "<p class='error'> You need to login first, Sign in below!!</p>";


    echo '<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}

require 'footer.php';

?>
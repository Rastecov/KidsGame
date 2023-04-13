<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <
    <main>
<?php
require "header.php";
// add the header.php file
// this file contains the navigation bar and the session start
require 'includes/database_handler.php'; 
// add the database_handler.php file
// this file contains the connection to the database

// check if the user is logged in
if(isset($_SESSION['username'])){
    // get the username, lives used and level result from the session variables
$username = $_SESSION['username'];
$livesUsed = $_SESSION['lives'];
$result = $_SESSION['level'];

//query to select the registration order from the player table where the username matches
$user_registration_player_result = $conn->query("SELECT registrationOrder FROM player WHERE username='$username'");
//fetch the row as an associative array
$user_registration_player = $user_registration_player_result->fetch_assoc()['registrationOrder'];
//query to select the player ID from the player table where the username matches
$user_ID_result = $conn->query("SELECT id FROM player WHERE username='$username'");
//fetch the row as an associative array
$user_ID = $user_ID_result->fetch_assoc()['id'];
//query to select the registration order from the score table where the score registrationOrder matches the player registrationOrder
$user_registration_score_result = $conn->query("SELECT registrationOrder FROM score WHERE registrationOrder='$user_registration_player'");
$user_registration_score_count = $user_registration_score_result->num_rows;


//check if a row already exist in the score table that have the same registration order as the current player then update the table score else insert a new row into the table score
if($user_registration_score_count > 0){
    $sql1 = "UPDATE score SET scoreTime = NOW(), livesUsed = '$livesUsed', result = '$result' WHERE registrationOrder= '$user_registration_player'";
    $conn->query($sql1);
}
else{
    $sql2 = "INSERT INTO score ( scoreTime, livesUsed, result, registrationOrder)
            VALUES (NOW(), '$livesUsed', '$result', '$user_registration_player')";
    $conn->query($sql2);
}
//query to select everything from the view history where the history id is equal to the player ID
$result2 = $conn->query("SELECT * FROM history WHERE id='$user_ID'");

$count_row = $result2->num_rows;
//display in a table the view history
echo "<table class='table'>";
echo "<tr>
<th>scoreTime</th>
<th>id</th>
<th>fName</th>
<th>lName</th>
<th>result</th>
<th>livesUsed</th>
</tr>";
for ($i = 0; $i < $count_row; ++$i) {
    $each_row = $result2->fetch_array(MYSQLI_ASSOC);
    echo "<tr>";
    echo "<td>" . $each_row['scoreTime'] . "</td>";
    echo "<td>" . $each_row['id'] . "  </td>";
    echo "<td>" . $each_row['fName'] . "</td>";
    echo "<td>" . $each_row['lName'] . "</td>";
    echo "<td>" . $each_row['result'] . "</td>";
    echo "<td>" . $each_row['livesUsed'] . "</td>";
    echo "</tr>";
}
echo "</table>";
}else{
//eror message to if the user display history before he logs in the system
    echo"<p class='error'> You need to login first before seeing your history, Sign in below!!</p>";

//display the sign-in buttons
    echo'<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}?>
 </main>
    <?php
    
    require 'footer.php';
    ?>
</body>
</html>





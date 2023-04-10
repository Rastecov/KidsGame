<?php
require "header.php";
require 'includes/database_handler.php'; 

echo '<h1>History</h1>';
if(isset($_SESSION['username'])){
   
$username = $_SESSION['username'];
$livesUsed = $_SESSION['lives'];
$result = $_SESSION['level'];

$user_registration_player_result = $conn->query("SELECT registrationOrder FROM player WHERE username='$username'");
$user_registration_player = $user_registration_player_result->fetch_assoc()['registrationOrder'];
$user_ID_result = $conn->query("SELECT id FROM player WHERE username='$username'");
$user_ID = $user_ID_result->fetch_assoc()['id'];
$user_registration_score_result = $conn->query("SELECT registrationOrder FROM score WHERE registrationOrder='$user_registration_player'");
$user_registration_score_count = $user_registration_score_result->num_rows;


//check if a row already exist in the score table that have the same registration order as the current player then update that else insert a new row
if($user_registration_score_count > 0){
    $sql1 = "UPDATE score SET scoreTime = NOW(), livesUsed = '$livesUsed', result = '$result' WHERE registrationOrder= '$user_registration_player'";
    $conn->query($sql1);
}
else{
    $sql2 = "INSERT INTO score ( scoreTime, livesUsed, result, registrationOrder)
            VALUES (NOW(), '$livesUsed', '$result', '$user_registration_player')";
    $conn->query($sql2);
}

$result2 = $conn->query("SELECT * FROM history WHERE id='$user_ID'");

$count_row = $result2->num_rows;
for ($i = 0; $i < $count_row; ++$i) {
    $each_row = $result2->fetch_array(MYSQLI_ASSOC);
    echo '        ID : ' . $each_row['id'] . '<br>';
    echo 'First Name : ' . $each_row['fName'] . '<br>';
    echo 'Last Name  : ' . $each_row['lName'] . '<br>';
    echo 'Result     : ' . $each_row['result'] . '<br>';
    echo 'Number Of Lives: ' . $each_row['livesUsed'] . '<br>';
    echo 'Date/Time  : ' . $each_row['scoreTime'] . '<br>';
   

}
}else{

    echo"<p class='error'> You need to login first before seeing your history, Sign in below!!</p>";


    echo'<form action="index.php" method ="post">
    <button type="submit" name="signin">Sign-In</button>
    </form>';
}

require 'footer.php';

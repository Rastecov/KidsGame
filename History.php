
<?php
require "header.php";
?>

<?php
echo '<h1>History</h1>';

require 'includes/database_handler.php';

//7-Select data from the TABLE student
$result=$conn->query("SELECT * FROM history");
//8-Display data selected from the TABLE student
$count_row = $result->num_rows;
for ($i = 0 ; $i < $count_row ; ++$i){
    $each_row = $result->fetch_array(MYSQLI_ASSOC);
    echo '        ID : ' . $each_row['id'] . '<br>';
    echo 'First Name : ' . $each_row['fName'] . '<br>';
    echo 'Last Name  : ' . $each_row['lName'] . '<br>';
    echo 'Result     : '. $each_row['result'] . '<br>';
    echo 'Number Of Lives: '. $each_row['livesUsed'] . '<br>';
    echo 'Date/Time  : '. $each_row['scoreTime'] . '<br>';
    

}


?>

<?php

require 'footer.php';

?>

<?php
// start a session
session_start();
// unset all the session variables
session_unset();
// destroy the session
session_destroy();
// redirect to the index page
header("Location: ../index.php");
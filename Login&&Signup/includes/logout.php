<link rel ="stylesheet" href="style.css">
<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
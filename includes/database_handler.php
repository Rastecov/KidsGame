<?php

$servername= "localhost";
$dBusername= 'root';
$dBPassword = "";
$DBNmae= "kidsgamesdb";

$conn = mysqli_connect($servername, $dBusername,$dBPassword,$DBNmae);

if(!$conn){

    die("Connection failed: ".mysqli_connect_error());
}
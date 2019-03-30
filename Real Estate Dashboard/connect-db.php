<?php

/*

CONNECT-DB.PHP

Allows PHP to connect to the Real_Estate_Management_System database

*/




$server = 'localhost';

$user = 'root';

$pass = 'root';

$db = 'Real_Estate_Management_System';




// Connect to Database

$conn=mysqli_connect($server,$user,$pass,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
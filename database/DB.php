<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbprojekt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

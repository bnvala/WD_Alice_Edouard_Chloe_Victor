<?php
//connexion a la base de donnée 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

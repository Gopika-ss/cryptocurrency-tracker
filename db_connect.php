<?php
$host = "sql100.infinityfree.com";
$user = "if0_40134917";
$pass = "G6D6zJ1Rl6tUplj"; 
$dbname = "if0_40134917_crypto_db ";


$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

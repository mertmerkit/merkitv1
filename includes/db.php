<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "merkitv1";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>

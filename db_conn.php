<?php
$DB_HOST= "localhost";
$DB_USER= "root";
$DB_PASS = "";
$DB_NAME = "demo";

// Create connection
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
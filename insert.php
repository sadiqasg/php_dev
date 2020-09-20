<?php
require("config.php");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];

if ($mysqli->query("INSERT INTO nametable (firstname, lastname) VALUES ('$firstname', '$lastname')") === TRUE) {
    printf("Added successfully.\n");
}

// close connection 
mysqli_close($mysqli);

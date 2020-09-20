<?php
require("config.php");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$title = $_POST['title'];
$post = $_POST['post'];

if ($mysqli->query("INSERT INTO blogposts (title, post) VALUES ('$title', '$post')") === TRUE) {
    // printf("Added successfully.\n");
    header('Location: /');
}

// close connection 
mysqli_close($mysqli);

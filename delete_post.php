<?php
require("config.php");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$id = $_GET['id'];

if ($mysqli->query("DELETE FROM blogposts WHERE id='$id'") === TRUE) {
    header('Location: /');
}

mysqli_close($mysqli);

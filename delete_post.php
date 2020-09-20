<?php
require("config.php");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$id = $_GET['id'];

echo $id;

if ($mysqli->query("DELETE FROM likes WHERE id='$id'") === TRUE) {
    if ($mysqli->query("DELETE FROM blogposts WHERE id='$id'") === TRUE) {
        echo "deleted, whew";
    }
} else {
    echo "Omo";
}

mysqli_close($mysqli);

?>
<?php
require("config.php");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$id = $_GET['post_id'];

$sql = "SELECT num FROM likes WHERE id=$id";
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            if ($row['num'] > 0) {
                if ($mysqli->query("UPDATE likes SET num = num + 1 WHERE id = '$id'") === TRUE) {
                    header('Location: /');
                }
            }
        }
    } else {
        if ($mysqli->query("INSERT INTO likes(id, num) VALUES('$id', '1');") === TRUE) {
            header('Location: /');
        }
    }
}

mysqli_close($mysqli);

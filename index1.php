<html>

<body>
    <h1>A small example page to insert some data in to the MySQL database using PHP</h1>
    <form action="insert.php" method="post">
        First name: <input type="text" name="fname" /><br><br>
        Last name: <input type="text" name="lname" /><br><br>
        <input type="submit" />
    </form>

    <?php

    require("config.php");

    $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    // Attempt select query execution
    $sql = "SELECT * FROM nametable";
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>first_name</th>";
            echo "<th>last_name</th>";
            echo "</tr>";
            while ($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            $result->free();
        } else {
            echo "No records matching your query were found.";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
    ?>

</body>
</html>
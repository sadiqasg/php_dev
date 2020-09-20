<html>

<head>
    <script src="/blog_script.js"></script>
</head>

<body>
    <h1>Blog - Development</h1>
    <form action="insert_post.php" method="post">
        <label>Title</label><br />
        <input type="text" name="title" /><br><br>
        <label>Post</label><br />
        <textarea rows="3" name="post"></textarea><br><br>
        <input type="submit" />
    </form>

    <?php

    require("config.php");

    $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $likeForm = "<form method='get' action='like_post.php'>
    <input style='display:none' name='post_id' value='" . $row['id'] . "' />
    <input type='submit' value='like' />
    </form>";

    // Attempt select query execution
    $sql = "SELECT * FROM blogposts";
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                echo "<div style='background-color:whitesmoke; color: #4f4f4f;border-radius:15px;padding:2px 10px;margin:10px 0;'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . $row['post'] . "</p>";

                if ($likes_result = $mysqli->query("SELECT num FROM likes WHERE id=' " . $row['id'] . " '")) {
                    if ($likes_result->num_rows > 0) {
                        while ($data = $likes_result->fetch_array()) {
                            echo "
                                <form method='get' action='like_post.php'>
                                <input style='display:none' name='post_id' value='" . $row['id'] . "' />
                                <input type='submit' value='like' />
                                </form>
                            ";
                            echo "<small>Like(s): " . $data['num'] . "</small>";
                            
                            echo "<form style='margin-top:10px' method='get' action='delete_post.php' >";
                            echo "<input style='display:none' name='id' value='" . $row['id'] . "' />";
                            echo "<input type='submit' value='delete this guy' />";
                            echo "</form>";
                        }
                    } else {
                        echo "
                            <form method='get' action='like_post.php'>
                            <input style='display:none' name='post_id' value='" . $row['id'] . "' />
                            <input type='submit' value='like' />
                            </form>";
                        echo "<small>Be the first to like this post</small>";
                    }
                }
                echo "</div>";
            }
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detailed Post</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="stylesheet" href="../css/detailedPostStyle.css">
</head>
<body>
    <div class="container">
        <button onclick="goBack()" class="back-to-forum-btn">Back to Previous Page</button>
        <?php
        session_start();

        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "dkt886";
        $dbname = "BlinkBoost";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $postID = $_GET['id'];

        // Fetch the specific post from the database
        $sql = "SELECT Posting.title, Posting.content, Posting.category, User.username, Posting.timestamp FROM Posting JOIN User ON Posting.authorID = User.ID WHERE Posting.ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the post
            echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
            echo "<div class='post-category'>Category: " . htmlspecialchars($row['category']) . "</div>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<p class='author-timestamp'>Posted by " . htmlspecialchars($row['username']) . " on " . $row['timestamp'] . "</p>";
        } else {
            echo "Post not found.";
        }

        // Comment Submission Form
        echo "<div class='comment-section'>";
        echo "<h2>Leave a Comment</h2>";
        if(isset($_SESSION['username'])) {
            echo "<form action='../php/submitComment.php' method='post'>";
            echo "<textarea name='comment_content' required></textarea>";
            echo "<input type='hidden' name='post_id' value='" . $postID . "'>";
            echo "<input type='submit' value='Submit Comment'>";
            echo "</form>";
        } else {
            echo "<p>Please log in to comment.</p>";
        }
        echo "</div>";

        // Display Comments
        echo "<div class='comments-display'>";
        echo "<h2>Comments</h2>";

        $sql = "SELECT Comment.content, User.username, Comment.timestamp FROM Comment JOIN User ON Comment.authorID = User.ID WHERE Comment.postID = ? ORDER BY Comment.timestamp DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                echo "<p class='comment-author'>Comment by " . htmlspecialchars($row['username']) . " on " . $row['timestamp'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }

        $stmt->close();
        $conn->close();
        echo "</div>";
        ?>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

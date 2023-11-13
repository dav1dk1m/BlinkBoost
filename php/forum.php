<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['userID'])) {
    header("Location: index.html");
    exit;
}

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

// Fetch posts from database
$sql = "SELECT Posting.ID, title, content, username, timestamp FROM Posting JOIN User ON Posting.authorID = User.ID ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="../css/forumStyle.css">
    <link rel="stylesheet" href="../css/headerStyle.css">
</head>
<body>
    <header>
        <h1>FORUM</h1>
        <img src="../images/forumBlinkBoost.png" alt="Site Logo" class="site-logo">
    </header>

    <div class="container-1">
        <div class="menu-toggle">
            <input type="checkbox" id="menu-check">
            <div class="menu-btn">
                <label for="menu-check">
                  <span></span>
                  <span></span>
                  <span></span>
                </label>
            </div>
            <ul class="menu">
              <li><a href="../php/main.php">HOME</a></li>
              <li><a href="../php/exercise.php">EXERCISE</a></li>
              <li><a href="../php/forum.php">FORUM</a></li>
            </ul>
        </div>
    </div>

    <div class="forum-container">
        <aside class="user-posts">
        <h2>Your Posts</h2>
<div class="user-posts-list">
    <?php
    $userID = $_SESSION['userID'];

    $userPostsSql = "SELECT ID, title, content, timestamp FROM Posting WHERE authorID = ? ORDER BY timestamp DESC";
    $stmt = $conn->prepare($userPostsSql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $userPostsResult = $stmt->get_result();

    if ($userPostsResult->num_rows > 0) {
        while($post = $userPostsResult->fetch_assoc()) {
            echo "<div class='user-post'>";
            echo "<h3>" . htmlspecialchars($post['title']) . "</h3>";

            $content = htmlspecialchars($post['content']);
            if (strlen($content) > 20) { 
                $content = substr($content, 0, 20) . "... <a href='detailedPost.php?id=" . $post['ID'] . "'>Read More</a>";
            }
            echo "<p>" . nl2br($content) . "</p>";
            echo "<span>Posted on: " . $post['timestamp'] . "</span>";
            echo "</div>";
        }
    } else {
        echo "<p>You haven't posted anything yet.</p>";
    }

    $stmt->close();
    ?>
</div>

        </aside>

        <section class="post-creation">
            <h2>Create a Post</h2>
            <form action="post.php" method="post">
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="content" placeholder="Content" required></textarea>
                <input type="submit" value="Post">
            </form>
        </section>

        <section class="forum-posts">
            <h2>Recent Posts</h2>
            <?php
            if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    echo "<article class='post'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";

    $content = htmlspecialchars($row['content']);
    if (strlen($content) > 10) { 
        $content = substr($content, 0, 10) . "... <a href='detailedPost.php?id=" . $row['ID'] . "'>Read More</a>";
    }
    echo "<p>" . nl2br($content) . "</p>";
    echo "<footer>Posted by " . htmlspecialchars($row['username']) . " on " . $row['timestamp'] . "</footer>";
    echo "</article>";
}
            } else {
                echo "<p>No posts found.</p>";
            }
            ?>
        </section>
    </div>

</body>
</html>

<?php
$conn->close();
?>

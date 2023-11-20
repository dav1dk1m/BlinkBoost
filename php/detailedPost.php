<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Detailed Post</title>
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
            
            $stmt->close();
            $conn->close();
            ?>
      </div>
      <script>
         function goBack() {
             window.history.back();
         }
      </script>
   </body>
</html>
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
   
   // Fetch categories for filter dropdown
   $categorySql = "SELECT DISTINCT category FROM Posting WHERE category IS NOT NULL";
   $categoryResult = $conn->query($categorySql);
   
   // Handle category filter
   $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
   
   // Fetch posts based on selected category
   $postSql = "SELECT Posting.ID, title, content, username, timestamp, category FROM Posting JOIN User ON Posting.authorID = User.ID ";
   if (!empty($selectedCategory)) {
       $postSql .= "WHERE category = '" . $conn->real_escape_string($selectedCategory) . "' ";
   }
   $postSql .= "ORDER BY timestamp DESC";
   $postResult = $conn->query($postSql);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>All Discussions</title>
      <link rel="stylesheet" href="../css/forumStyle.css">
      <link rel="stylesheet" href="../css/headerStyle.css">
      <link rel="stylesheet" href="../css/discussion.css">
   </head>
   <body>
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
               <li><a href="../php/forum.php">DASHBOARD</a></li>
               <li><a href="../php/discussion.php">DISCUSSIONS</a></li>
            </ul>
         </div>
      </div>
      <div class="container">
         <img src="../images/allPostsBlinkBoost.png" alt="All Posts" class="all-posts-image">
         <h1>All Discussions</h1>
         <!-- Category Filter Form -->
         <div class="filter-container">
            <label for="category-filter">Filter by Category:</label>
            <form action="discussion.php" method="get">
               <select name="category" id="category-filter" onchange="this.form.submit()">
                  <option value="">All Categories</option>
                  <?php
                     if ($categoryResult->num_rows > 0) {
                         while ($category = $categoryResult->fetch_assoc()) {
                             $selected = ($selectedCategory == $category['category']) ? 'selected' : '';
                             echo "<option value='" . htmlspecialchars($category['category']) . "' $selected>" . htmlspecialchars($category['category']) . "</option>";
                         }
                     }
                     ?>
               </select>
            </form>
         </div>
         <!-- Display Posts -->
         <?php
            if ($postResult->num_rows > 0) {
                while ($post = $postResult->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<h3>" . htmlspecialchars($post['title']) . "</h3>";
            
                    // Check if content is longer than 400 characters
                    $content = htmlspecialchars($post['content']);
                    if (strlen($content) > 400) {
                        // Truncate and add 'Read More' link
                        $content = substr($content, 0, 400) . "... <a href='detailedPost.php?id=" . $post['ID'] . "'>Read More</a>";
                    }
            
                    echo "<p>" . nl2br($content) . "</p>";
                    echo "<footer>Posted by " . htmlspecialchars($post['username']) . " on " . $post['timestamp'] . "</footer>";
                    echo "</div>";
                }
            } else {
                echo "<p>No posts found.</p>";
            }
                    ?>
      </div>
   </body>
</html>
<?php
   $conn->close();
   ?>
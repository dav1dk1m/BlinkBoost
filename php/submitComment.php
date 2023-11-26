<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    echo "<script>alert('Please Login or Signup to leave a Comment');</script>";
    echo "<script>window.history.back();</script>";
    exit();
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

// Insert comment into database
if(isset($_POST['comment_content']) && isset($_POST['post_id'])) {
    $commentContent = $_POST['comment_content'];
    $postID = $_POST['post_id'];
    $authorID = $_SESSION['userID']; 

    $sql = "INSERT INTO Comment (postID, authorID, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $postID, $_SESSION['userID'], $commentContent);
    $stmt->execute();

    $stmt->close();
}

$conn->close();

// Redirect back to the post
header("Location: detailedPost.php?id=" . $postID);
exit();
?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: index.html");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $authorID = $_SESSION['userID'];
    $category = $_POST['category'];
 

    $sql = "INSERT INTO Posting (title, content, authorID, category) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssis", $title, $content, $_SESSION['userID'], $category);
    $success = $stmt->execute();

    if ($success) {
        // Redirect to forum page or show success message
        header("Location: forum.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

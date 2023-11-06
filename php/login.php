<?php
session_start();

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

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // SQL query to select user based on username
    $sql = "SELECT ID, password FROM User WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) { 
            $_SESSION['userID'] = $row['ID'];
            $_SESSION['username'] = $username;
            header("Location: php/main.php");
            exit();
        } else {
            echo "<script>alert('Invalid password. Try again.');</script>";
            echo "<script>window.location.href='../index.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username. Try again.');</script>";
        echo "<script>window.location.href='../index.html';</script>";
    }
}

$stmt->close();
$conn->close();
?>

<?php
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

// Validate and assign POST data
if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email'])) {
    die("All fields are required");
}

$username = $_POST['username'];
$password = $_POST['password']; 
$email = $_POST['email'];

// Insert new user into database
$sql = "INSERT INTO User (username, email, password) VALUES (?, ?, ?)"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "<script>
            alert('Account successfully created.');
            window.location.href='index.html';
          </script>";
} else {
    if (strpos($conn->error, 'Duplicate entry') !== false) {
        echo "<script>
                alert('Username or Email already exists. Please choose a different one.');
                window.location.href='index.html';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>

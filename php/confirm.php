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

if(isset($_GET['code'])) {
    $code = $_GET['code'];

    // Search for the user with the provided confirmation code
    $sql = "SELECT * FROM Users WHERE confirmationCode=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the user exists and hasn't confirmed yet
    if($result->num_rows == 1) {
        $sql = "UPDATE Users SET isConfirmed=1 WHERE confirmationCode=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $code);
        
        if($stmt->execute()) {
            echo "Your registration is confirmed! You can now <a href='https://kim.ursse.org'>login</a>.";
        } else {
            echo "Error confirming registration.";
        }
    } else {
        echo "Invalid confirmation code or you've already confirmed.";
    }
    $stmt->close();
} else {
    echo "No confirmation code provided.";
}

$conn->close();
?>


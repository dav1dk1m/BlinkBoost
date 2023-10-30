<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <style>
        body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
}

.logo-main {
  width: 500px;
  height: auto;
}

.button {
  width: 180px;
  height: 50px;
  margin-top: 10px;
}

    </style>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>
<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
<img src="BlinkBoost-logos_transparent.png" alt="BlinkBoost Logo" class="logo-main">
<br>
<a href="exercise.php">
    <button class="button">Start Exercise</button>
</a>
<br>
<a href="forum.php">
    <button class="button">To Forum Page</button>
</a>
</body>
</html>

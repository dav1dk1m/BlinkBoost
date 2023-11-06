<?php
session_start();

// Redirect to login page if not logged in and not a guest
if (!isset($_SESSION['username']) && !isset($_GET['guest'])) {
    header("Location: index.html");
    exit();
}

// Set session variable for guests
if (isset($_GET['guest']) && $_GET['guest'] == '1') {
    $_SESSION['username'] = 'Guest';
    $_SESSION['is_guest'] = true;
}

// Welcome message
$welcomeMessage = isset($_SESSION['is_guest']) ? 'Welcome Guest' : 'Welcome ' . htmlspecialchars($_SESSION['username']);

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
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <h1> <?php echo $welcomeMessage; ?> </h1>
    <img src="../images/BlinkBoost-logos_transparent.png" alt="BlinkBoost Logo" class="logo-main">
    <a href="../php/exercise.php">
      <button class="button">Start Exercise</button>
    </a> <?php if (!isset($_SESSION['is_guest'])): ?>
    <!-- Show forum link for non-guests -->
    <a href="forum.php">
      <button class="button">To Forum Page</button>
    </a> <?php endif; ?>
  </body>
</html>
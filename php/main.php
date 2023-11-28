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
      .header {
    width: 100%;
    position: relative;
    text-align: right;
    padding: 10px;
}

.logout-button {
    padding: 5px 15px;
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1em;
}

.logout-button:hover {
    background-color: #d32f2f;
}
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <div class="header">
      <a href="logout.php" class="logout-button">Logout</a>
    </div>
    <h1> <?php echo $welcomeMessage; ?> </h1>
    <img src="../images/BlinkBoost-logos_transparent.png" alt="BlinkBoost Logo" class="logo-main">
    <a href="../php/exercise.php">
      <button class="button">Start Exercise</button>
    </a>
    <!-- Show forum link for non-guests -->
    <?php if (!isset($_SESSION['is_guest'])): ?>
      <a href="forum.php">
        <button class="button">My Dashboard</button>
      </a> 
    <?php endif; ?>
    <!-- Show discussion board link for all users -->
    <a href="discussion.php">
      <button class="button">Discussion Board</button>
    </a>
  </body>
</html>
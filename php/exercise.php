<?php
session_start();
if(isset($_GET['guest']) && $_GET['guest'] == '1') {
    $_SESSION['username'] = 'Guest';
    $_SESSION['is_guest'] = true;
} elseif(!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise Page</title>

    <link rel="stylesheet" href="../css/headerStyle.css">
    <link rel="stylesheet" href="../css/exercise.css">
    </head>

    <body>
    <a href="../php/main.php" class="site-logo">
        <img src="../images/BlinkBoost.png" alt="Site Logo">
    </a>
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
              <li><a href="../php/forum.php">FORUM</a></li>
            </ul>
        </div>
    </div>
    <div id="container">
        <div class="blue-circle"></div>
        <div id="button-container">
    <button id="startExercise">Start</button>
    <button id="prevExercise"></button>
    <button id="nextExercise"></button>
</div>
        <div id="instructions"></div>
        <div id="timer"></div>
    </div>
    <audio id="bellSound" src="../sounds/bell.wav" preload="auto"></audio>

    </body>
  

    <script src="../js/animation.js"></script>

</html>

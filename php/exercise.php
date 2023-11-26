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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
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
               <li><a href="../php/forum.php">DASHBOARD</a></li>
               <li><a href="../php/discussion.php">DISCUSSIONS</a></li>
               <li><a href="logout.php" class="logout-button">LOGOUT</a></li>
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
         <div id="instructions-container">
            <div id="instructions"></div>
            <div class="btn-help">
               <i class="bi bi-question-lg"></i>
               <div class="text-section">
                  <h5>Exercise Info</h5>
                  <p>
                     Information about the exercises and how they help with eye health.
                  </p>
               </div>
            </div>
            <div id="timer"></div>
         </div>
      </div>
      <audio id="bellSound" src="../sounds/bell.wav" preload="auto"></audio>
   </body>
   <script src="../js/animation.js"></script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise Page</title>
    <link rel="stylesheet" href="./menuStyle.css">
    <link rel="stylesheet" href="./exercise.css">
    </head>
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
              <li><a href="./main.php">HOME</a></li>
              <li><a href="./exercise.php">EXERCISE</a></li>
              <li><a href="#">FORUM</a></li>
            </ul>
        </div>
    </div>
    <div id="container">
        <div class="blue-circle"></div>
        <div id="button-container">
    <button id="startExercise">Start</button>
    <button id="prevExercise">Previous</button>
    <button id="nextExercise">Next</button>
</div>
        <div id="timer"></div>
    </div>
    <script src="animation.js"></script>

</html>

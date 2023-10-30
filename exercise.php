<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise Page</title>
    <link rel="stylesheet" href="./menuStyle.css">

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
              <li><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
    <div id="container">
        <div class="blue-circle"></div>
        <button id="startExercise">Start</button>
        <button id="prevExercise">Previous</button>
        <button id="nextExercise">Next</button>
        <div id="timer"></div>
    </div>
    <script src="animation.js"></script>



</html>

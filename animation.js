document.addEventListener('DOMContentLoaded', function() {
    // Get references to HTML elements
    const blueCircle = document.querySelector('.blue-circle');
    const startButton = document.getElementById('startExercise');
    const prevButton = document.getElementById('prevExercise');
    const nextButton = document.getElementById('nextExercise');
    const timerElement = document.getElementById('timer');

    // Initialize variables
    let currentExercise = 0;
    let interval;

    // List of exercise functions
    const exercises = [
        moveUpDown,
        moveLeftRight,
        closeEyes,
        moveInfinity
    ];

    // Clear any existing intervals
    function stopExistingIntervals() {
        clearInterval(interval);
    }

    // Move the blue circle up and down
    function moveUpDown() {
        stopExistingIntervals();
        let y = 0;
        let direction = 1;

        interval = setInterval(() => {
            blueCircle.style.transform = `translateY(${y}px)`;
            y += direction * 5;
            
            // Reverse direction when reaching boundary
            if (y > 300 || y < -300) {
                direction *= -1;
            }
        }, 30);
    }

    // Move the blue circle left and right
    function moveLeftRight() {
        stopExistingIntervals();
        let x = 0;
        let direction = 1;

        interval = setInterval(() => {
            blueCircle.style.transform = `translateX(${x}px)`;
            x += direction * 5;

            // Reverse direction when reaching boundary
            if (x > 400 || x < -400) {
                direction *= -1;
            }
        }, 30);
    }

    // Display a timer for closing eyes
    function closeEyes() {
        stopExistingIntervals();
        let timeLeft = 30;
        timerElement.innerHTML = `Close your eyes for ${timeLeft} seconds`;

        interval = setInterval(() => {
            timeLeft--;
            timerElement.innerHTML = `Close your eyes for ${timeLeft} seconds`;

            // Stop timer when time reaches zero
            if (timeLeft <= 0) {
                clearInterval(interval);
                timerElement.innerHTML = '';
            }
        }, 1000);
    }

    // Move the blue circle in an infinity shape
    function moveInfinity() {
        stopExistingIntervals();
        let angle = 0;

        interval = setInterval(() => {
            const x = 400 * Math.sin(angle);
            const y = 200 * Math.sin(2 * angle);
            blueCircle.style.transform = `translate(${x}px, ${y}px)`;

            angle += 0.025;
        }, 60);
    }

    // Event listeners for buttons
    prevButton.addEventListener('click', () => {
        // Go to the previous exercise
        currentExercise = (currentExercise - 1 + exercises.length) % exercises.length;
        exercises[currentExercise]();
    });

    nextButton.addEventListener('click', () => {
        // Go to the next exercise
        currentExercise = (currentExercise + 1) % exercises.length;
        exercises[currentExercise]();
    });

    startButton.addEventListener('click', () => {
        // Start the current exercise
        exercises[currentExercise]();
    });
});

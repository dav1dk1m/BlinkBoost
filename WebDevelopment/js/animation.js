document.addEventListener('DOMContentLoaded', function() {
    // Get references to HTML elements
    const blueCircle = document.querySelector('.blue-circle');
    const startButton = document.getElementById('startExercise');
    const prevButton = document.getElementById('prevExercise');
    const nextButton = document.getElementById('nextExercise');
    const timerElement = document.getElementById('timer');
    const instructionsElement = document.getElementById('instructions');

    // Initialize variables
    let currentExercise = 0;
    let interval;
    let exerciseStarted = false;

    // List of exercise functions
    const exercises = [
        moveUpDown,
        moveLeftRight,
        closeEyes,
        moveInfinity
    ];

    const exerciseInfo = [{
            title: "Vertical Eye Muscle Strengthening",
            content: "Enhances vertical eye muscle strength and flexibility. Ideal for reducing eye strain from screen use."
        },
        {
            title: "Horizontal Eye Muscle Training",
            content: "Strengthens muscles for side-to-side eye movement. Improves peripheral vision and coordination, useful for driving and sports."
        },
        {
            title: "Eye Relaxation for Health",
            content: "Reduces eye strain and fatigue. Essential for preventing dry eyes in the digital age."
        },
        {
            title: "Eye Coordination and Focus",
            content: "Boosts eye coordination and focus through figure-eight tracking. Enhances reading skills and hand-eye coordination."
        },
    ];

    function updateInstructions(text) {
        instructionsElement.textContent = text;
    }

    // Clear any existing intervals
    function stopExistingIntervals() {
        clearInterval(interval);
    }

    // Function to clear the timer and instructions
    function clearExerciseDisplay() {
        timerElement.innerHTML = '';
        updateInstructions('');
        blueCircle.style.display = 'none'; // Hide the blue circle by default
    }

    // Function to reset the exercise display when switching exercises
    function resetExercise() {
        clearExerciseDisplay();
        stopExistingIntervals();
        exercises[currentExercise](); // Start the new exercise
        updateExerciseInfo(currentExercise); // Update exercise info content
    }

    // Move the blue circle up and down
    function moveUpDown() {
        updateInstructions('Follow the blue circle with your eyes as it moves up and down.');
        blueCircle.style.display = 'block';
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
        updateInstructions('Watch the blue circle and track it with your eyes as it moves side to side.');
        blueCircle.style.display = 'block';
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
        updateInstructions('Close your eyes gently for the duration of the timer.');
        stopExistingIntervals();
        blueCircle.style.display = 'none';
        let timeLeft = 20;
        timerElement.innerHTML = `${timeLeft} seconds`;

        interval = setInterval(() => {
            timeLeft--;
            timerElement.innerHTML = `${timeLeft} seconds`;

            // Stop timer and play bell sound when time reaches zero
            if (timeLeft <= 0) {
                clearInterval(interval);
                timerElement.innerHTML = '';
                document.getElementById('bellSound').play(); // Play the bell sound
            }
        }, 1000);
    }

    // Move the blue circle in an infinity shape
    function moveInfinity() {
        updateInstructions('Keep your head still and trace the figure-eight movement of the blue circle with your eyes.');
        blueCircle.style.display = 'block';
        let angle = 0;

        interval = setInterval(() => {
            const x = 400 * Math.sin(angle);
            const y = 200 * Math.sin(2 * angle);
            blueCircle.style.transform = `translate(${x}px, ${y}px)`;

            angle += 0.025;
        }, 30);
    }

    // Function to start or resume the current exercise
    function startCurrentExercise() {
        exercises[currentExercise]();
        startButton.textContent = 'Pause';
        exerciseStarted = true;
    }

    // Function to pause the current exercise
    function pauseCurrentExercise() {
        clearInterval(interval);
        startButton.textContent = 'Start';
        exerciseStarted = false;
    }

    // Toggle start/pause exercise
    function toggleExercise() {
        if (exerciseStarted) {
            pauseCurrentExercise();
        } else {
            startCurrentExercise();
        }
    }

    function updateExerciseInfo(exerciseIndex) {
        const infoTitle = document.querySelector('.btn-help .text-section h5');
        const infoContent = document.querySelector('.btn-help .text-section p');

        infoTitle.textContent = exerciseInfo[exerciseIndex].title;
        infoContent.textContent = exerciseInfo[exerciseIndex].content;
    }

    // Event listeners for buttons
    prevButton.addEventListener('click', () => {
        currentExercise = (currentExercise - 1 + exercises.length) % exercises.length;
        resetExercise();
        pauseCurrentExercise(); // Ensure the exercise is paused when switching
    });

    nextButton.addEventListener('click', () => {
        currentExercise = (currentExercise + 1) % exercises.length;
        resetExercise();
        pauseCurrentExercise(); // Ensure the exercise is paused when switching
    });



    startButton.addEventListener('click', toggleExercise);

    // Initialize the display without starting the exercise
    clearExerciseDisplay();
    updateExerciseInfo(0); // Initialize info for the first exercise
});
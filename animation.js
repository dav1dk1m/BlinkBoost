document.addEventListener('DOMContentLoaded', function() {
    const blueCircle = document.querySelector('.blue-circle');
    const startButton = document.getElementById('startExercise');
    const prevButton = document.getElementById('prevExercise');
    const nextButton = document.getElementById('nextExercise');
    const timerElement = document.getElementById('timer');

    let currentExercise = 0;
    let interval;

    // Array of exercise functions
    const exercises = [
        moveUpDown,
        moveLeftRight,
        closeEyes,
        moveInfinity
    ];

    function stopExistingIntervals() {
        clearInterval(interval);
    }

    function moveUpDown() {
        stopExistingIntervals();
        let y = 0;
        let direction = 1;

        interval = setInterval(() => {
            blueCircle.style.transform = `translateY(${y}px)`;
            y += direction * 5;
            
            if (y > 100 || y < 0) {
                direction *= -1;
            }
        }, 30);
    }

    function moveLeftRight() {
        stopExistingIntervals();
        let x = 0;
        let direction = 1;

        interval = setInterval(() => {
            blueCircle.style.transform = `translateX(${x}px)`;
            x += direction * 5;

            if (x > 100 || x < 0) {
                direction *= -1;
            }
        }, 30);
    }

    function closeEyes() {
        stopExistingIntervals();
        let timeLeft = 30;
        timerElement.innerHTML = `Close your eyes for ${timeLeft} seconds`;

        interval = setInterval(() => {
            timeLeft--;
            timerElement.innerHTML = `Close your eyes for ${timeLeft} seconds`;

            if (timeLeft <= 0) {
                clearInterval(interval);
                timerElement.innerHTML = '';
            }
        }, 1000);
    }

    function moveInfinity() {
        stopExistingIntervals();
        let angle = 0;

        interval = setInterval(() => {
            const x = 50 * Math.sin(angle);
            const y = 50 * Math.sin(2 * angle);
            blueCircle.style.transform = `translate(${x}px, ${y}px)`;

            angle += 0.05;
        }, 30);
    }

    prevButton.addEventListener('click', () => {
        currentExercise = (currentExercise - 1 + exercises.length) % exercises.length;
        exercises[currentExercise]();
    });

    nextButton.addEventListener('click', () => {
        currentExercise = (currentExercise + 1) % exercises.length;
        exercises[currentExercise]();
    });

    startButton.addEventListener('click', () => {
        exercises[currentExercise]();
    });
});

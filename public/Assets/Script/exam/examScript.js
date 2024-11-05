document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".questions-container > .question");
    const timerElement = document.getElementById("timer");

    // Set the navigation buttons for the current question dynamically
    let currentQuestion = 0;
    const initialDuration = 30 * 60; // 30 minutes in seconds
    let remainingTime;

    // Check if there's a saved time in local storage
    if (localStorage.getItem("remainingTime")) {
        remainingTime = parseInt(localStorage.getItem("remainingTime"), 10);
    } else {
        remainingTime = initialDuration;
    }

    function updateTimerDisplay(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
    }

    function startCountdown() {
        const countdown = setInterval(() => {
            if (remainingTime <= 0) {
                clearInterval(countdown);
                alert("Waktu habis! Ujian akan disubmit secara otomatis.");
            } else {
                remainingTime--;
                updateTimerDisplay(remainingTime);
                localStorage.setItem("remainingTime", remainingTime); // Update local storage
            }
        }, 1000);
    }

    function showQuestion(index) {
        questions.forEach((question, i) => {
            question.style.display = i === index ? "block" : "none";
        });
        updateNavigationButtons();
    }

    function updateNavigationButtons() {
        // Select or dynamically create Back and Next buttons for each question
        let backButton = questions[currentQuestion].querySelector(".nav-button.back");
        let nextButton = questions[currentQuestion].querySelector(".nav-button.next");

        // Ensure Back and Next buttons are created if not already present
        if (!backButton) {
            backButton = document.createElement("button");
            backButton.classList.add("nav-button", "back");
            backButton.textContent = "Back";
            backButton.style.float = "left";
            questions[currentQuestion].appendChild(backButton);
        }
        
        if (!nextButton) {
            nextButton = document.createElement("button");
            nextButton.classList.add("nav-button", "next");
            nextButton.textContent = currentQuestion === questions.length - 1 ? "Finish" : "Next";
            nextButton.style.float = "right";
            questions[currentQuestion].appendChild(nextButton);
        }

        // Show or hide Back button based on the question index
        backButton.style.display = currentQuestion === 0 ? "none" : "inline-block";
        nextButton.textContent = currentQuestion === questions.length - 1 ? "Finish" : "Next";

        // Add event listeners for the buttons
        backButton.onclick = () => {
            if (currentQuestion > 0) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        };

        nextButton.onclick = () => {
            if (currentQuestion < questions.length - 1) {
                currentQuestion++;
                showQuestion(currentQuestion);
            } else {
                alert("Ujian selesai! Jawaban Anda akan dikumpulkan.");
            }
        };
    }

    // Initialize by showing the first question and setting up the timer
    showQuestion(currentQuestion);
    updateTimerDisplay(remainingTime);
    startCountdown();

    // Clear local storage when the user finishes the exam
    window.addEventListener("beforeunload", function () {
        if (remainingTime <= 0) {
            localStorage.removeItem("remainingTime");
        }
    });
});

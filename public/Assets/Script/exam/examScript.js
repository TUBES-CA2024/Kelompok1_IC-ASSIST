document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".questions-container > .question");
    const navButtons = document.querySelectorAll(".nav button");
    const timerElement = document.getElementById("timer");

    let currentQuestion = 0;
    const initialDuration = 30 * 60; // 30 minutes in seconds
    let remainingTime;

    // Load remaining time from local storage if available
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
                // Submit the form or perform any necessary end-of-time action here
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
        updateActiveNavButton();
    }

    function updateNavigationButtons() {
        let backButton = questions[currentQuestion].querySelector(".nav-button.back");
        let nextButton = questions[currentQuestion].querySelector(".nav-button.next");

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

        backButton.style.display = currentQuestion === 0 ? "none" : "inline-block";
        nextButton.textContent = currentQuestion === questions.length - 1 ? "Finish" : "Next";

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

    function updateActiveNavButton() {
        // Remove 'active' class from all navigation buttons
        navButtons.forEach(button => button.classList.remove("active"));
        // Add 'active' class to the button matching the current question index
        if (navButtons[currentQuestion]) {
            navButtons[currentQuestion].classList.add("active");
        }
    }

    // Event listener to handle navigation button clicks
    navButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            currentQuestion = index;
            showQuestion(currentQuestion);
        });
    });

    // Initialize by showing the first question, setting up the timer, and marking the first button as active
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

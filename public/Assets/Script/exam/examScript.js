document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".questions-container > .question");
    const navButtons = document.querySelectorAll(".nav button");
    const timerElement = document.getElementById("timer");

    let currentQuestion = 0;
    const initialDuration = 30 * 60; 
    let remainingTime;

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
        navButtons.forEach(button => button.classList.remove("active"));
        if (navButtons[currentQuestion]) {
            navButtons[currentQuestion].classList.add("active");
        }
    }

    navButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            currentQuestion = index;  
            showQuestion(currentQuestion);  
        });
    });

    showQuestion(currentQuestion);
    updateTimerDisplay(remainingTime);
    startCountdown();

    window.addEventListener("beforeunload", function () {
        if (remainingTime <= 0) {
            localStorage.removeItem("remainingTime");
        }
    });
});

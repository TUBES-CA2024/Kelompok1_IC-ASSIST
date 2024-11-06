document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".questions-container > .question");
    const navButtons = document.querySelectorAll(".nav button");
    const timerElement = document.getElementById("timer");
    const endpoint = "/tubes_web/public/hasil";
    let currentQuestion = 0;
    const initialDuration = 30 * 60; 
    let remainingTime;

    const answers = {}; // Objek untuk menyimpan semua jawaban

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
                alert("Waktu habis! Jawaban akan dikirimkan secara otomatis.");
                submitAllAnswers(); // Kirim semua jawaban jika waktu habis
            } else {
                remainingTime--;
                updateTimerDisplay(remainingTime);
                localStorage.setItem("remainingTime", remainingTime);
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
                submitAllAnswers(); // Kirim semua jawaban saat tombol Finish ditekan
            }
        };
    }

    function updateActiveNavButton() {
        navButtons.forEach(button => button.classList.remove("active"));
        if (navButtons[currentQuestion]) {
            navButtons[currentQuestion].classList.add("active");
        }
    }

    function markAnsweredQuestion(index) {
        if (navButtons[index]) {
            navButtons[index].classList.add("answered");
        }
    }

    function saveAnswer(idSoal, answer) {
        answers[idSoal] = answer; // Simpan jawaban ke dalam objek JSON
    }

    function submitAllAnswers() {
        const data = Object.entries(answers).map(([idSoal, jawaban]) => ({
            id_soal: idSoal,
            jawaban: jawaban,
        }));
        console.log("Data yang akan dikirim:" + JSON.stringify(data));

        $.ajax({
            url: endpoint,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function (response) {
                if (response.status === "success") {
                    alert("Semua jawaban berhasil disimpan.");
                } else {
                    alert("Gagal menyimpan beberapa jawaban.");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error saat menyimpan jawaban:", error);
                console.log("Response:", xhr.responseText);
                console.log("Status:", status);
            }
        });
    }

    navButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            currentQuestion = index;
            showQuestion(currentQuestion);
        });
    });

    questions.forEach((question, index) => {
        const options = question.querySelectorAll("input[type='radio']");
        const idSoal = question.getAttribute("data-id-soal");

        options.forEach(option => {
            option.addEventListener("change", () => {
                const answer = option.value;
                saveAnswer(idSoal, answer); // Simpan jawaban
                markAnsweredQuestion(index);
            });
        });
    });

    showQuestion(currentQuestion);
    updateTimerDisplay(remainingTime);
    startCountdown();

    window.addEventListener("beforeunload", () => {
        if (remainingTime <= 0) {
            localStorage.removeItem("remainingTime");
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".questions-container > .question");
    const navButtons = document.querySelectorAll(".nav button");
    const timerElement = document.getElementById("timer");
    const endpoint = "/tubes_web/public/hasil";
    let currentQuestion = 0;
    const initialDuration = 30 * 60; 
    let remainingTime;

    const answers = {}; 

    if (localStorage.getItem("remainingTime")) {
        remainingTime = parseInt(localStorage.getItem("remainingTime"), 10);
    } else {
        remainingTime = initialDuration;
    }

    async function submitAndFinish() {
        const calculateEndpoint = "/tubes_web/public/calculate";
    
        try {
            const response = await fetch(calculateEndpoint, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
    
            const textResponse = await response.text(); // Ambil respons sebagai teks
            try {
                const data = JSON.parse(textResponse); // Parsing JSON
                console.log("Respons dari backend:", data);
    
                if (data.status === "success") {
                    alert("Ujian selesai! Data Anda telah disimpan.");
                    window.location.href = "/tubes_web/public";
                } else {
                    alert(`Terjadi kesalahan: ${data.message || "Kesalahan tidak diketahui"}`);
                }
            } catch (parseError) {
                console.error("Gagal mem-parsing respons JSON:", textResponse);
                throw new Error("Format respons tidak valid");
            }
        } catch (error) {
            console.error("Error saat menyelesaikan ujian:", error);
            alert("Terjadi kesalahan saat menyelesaikan ujian. Silakan coba lagi.");
        }
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
                alert("Waktu habis! Jawaban Anda akan dikirimkan secara otomatis.");
                submitAllAnswers()
                    .then(() => submitAndFinish()) 
                    .catch((error) => {
                        console.error("Error saat menyimpan jawaban:", error);
                        alert("Terjadi kesalahan saat menyimpan jawaban. Silakan coba lagi.");
                    });
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
    function submitAllAnswers() {
        const data = Object.entries(answers).map(([idSoal, jawaban]) => ({
            id_soal: idSoal,
            jawaban: jawaban,
        }));
    
        console.log("Mengirim jawaban ke backend:", JSON.stringify(data));
    
        return new Promise((resolve, reject) => {
            $.ajax({
                url: endpoint,
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(data),
                success: function (response) {
                    try {
                        // Validasi respons dari backend
                        if (typeof response !== "object" || !response.status) {
                            throw new Error("Format respons tidak valid");
                        }
    
                        if (response.status === "success") {
                            console.log("Respons backend:", response);
                            alert("Semua jawaban berhasil disimpan dan nilai telah dihitung!");
                            resolve(response);
                        } else {
                            console.error("Error dari backend:", response.message || "Tidak ada pesan error");
                            reject(new Error(`Backend error: ${response.message || "Tidak ada pesan error"}`));
                        }
                    } catch (error) {
                        console.error("Kesalahan saat memproses respons backend:", error);
                        reject(error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error saat menyimpan jawaban:", error);
                    console.log("Respons backend:", xhr.responseText);
                    reject(new Error("Error saat menyimpan jawaban."));
                },
            });
        });
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
                if (confirm("Apakah Anda yakin ingin menyelesaikan ujian?")) {
                    submitAllAnswers()
                        .then(() => {
                            return submitAndFinish(); 
                        })
                        .catch(error => {
                            console.error("Error saat menyimpan jawaban atau menghitung nilai:", error);
                            alert("Terjadi kesalahan saat menyimpan data. Silakan coba lagi.");
                        });
                }
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

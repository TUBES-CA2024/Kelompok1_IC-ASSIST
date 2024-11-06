<?php
use App\Controllers\exam\ExamController;
use App\Controllers\Profile\ProfileController;
use App\Controllers\user\BerkasUserController;
$stambuk = ProfileController::viewUser()["stambuk"];
$results = ExamController::viewAllSoal();
$profile = ProfileController::viewBiodata();
$nama = ProfileController::viewBiodata() == null ? "Nama Lengkap" : ProfileController::viewBiodata()["namaLengkap"];
$photo = "/tubes_web/res/imageUser/" . (BerkasUserController::viewBerkas()["foto"] ?? "default.png");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Exam Layout</title>
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/exam.css" />
</head>

<body>
    <header>
        <div class="header-container">
            <img src="/tubes_web/public/Assets/Images/logo.jpeg" alt="Logo" class="logo">
            <h1>ICLabs - Ujian Akhir</h1>
        </div>
    </header>

    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <img src="<?= htmlspecialchars($photo) ?>" alt="User Photo" name="userphoto" id="userphoto"
                    class="profile-picture">
                <h3><?= htmlspecialchars($nama) ?></h3>
                <p><?= htmlspecialchars($stambuk) ?></p>
            </div>
            <div class="nav">
                <?php for ($i = 1; $i <= 15; $i++): ?>
                    <button><?= $i ?></button>
                <?php endfor; ?>
            </div>
        </div>
        <div class="main-content">
            <div class="timer">Time Remaining: <span id="timer">30:00</span></div>
            <div class="questions-container">
                <?php foreach ($results as $index => $result): ?>
                    <div class="question" data-id-soal="<?= htmlspecialchars($result['id']) ?>" style="display: none;">
                        <h3>Question <?= $index + 1 ?></h3>

                        <?php if (!empty($result['gambar'])): ?>
                            <img src="/tubes_web/public/Assets/Img/soal/<?= htmlspecialchars($result['gambar']) ?>"
                                alt="Gambar Soal <?= $index + 1 ?>" class="question-image">
                        <?php endif; ?>

                        <p><?= htmlspecialchars($result['deskripsi']) ?></p>

                        <ul class="options">
                            <?php
                            $options = json_decode($result['pilihan']);
                            foreach ($options as $optionIndex => $option): ?>
                                <li>
                                    <label>
                                        <input type="radio" name="answer[<?= $index ?>]"
                                            value="<?= htmlspecialchars($optionIndex) ?>">
                                        <?= htmlspecialchars($option) ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="navigation-buttons">
                            <button class="nav-button back">Back</button>
                            <button class="nav-button next">Next</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 by ICLabs</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/tubes_web/public/Assets/Script/exam/examScript.js"></script>
</body>

</html>
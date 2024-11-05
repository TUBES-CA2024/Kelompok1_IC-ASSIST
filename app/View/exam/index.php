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
            <img src="logo.jpeg" alt="Logo" class="logo">
            <h1>ICLabs - Ujian Akhir</h1>
        </div>
    </header>

    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <img src="<?= $photo ?>" alt="foto" name="userphoto" id="userphoto" class="profile-picture">
                <h3><?= $nama ?></h3>
                <p><?= $stambuk ?></p>
            </div>
            <div class="nav">
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>4</button>
                <button>5</button>
                <button>6</button>
                <button>7</button>
                <button>8</button>
                <button>9</button>
                <button>10</button>
                <button>11</button>
                <button>12</button>
                <button>13</button>
                <button>14</button>
                <button>15</button>
            </div>
        </div>
        <div class="main-content">
            <div class="timer">Time Remaining: <span id="timer">30:00</span></div>
            <!-- Set initial time to 30 minutes -->

            <!-- Modified Questions Container to Show Only One Question at a Time -->
            <div class="questions-container">
                <?php foreach ($results as $index => $result): ?>
                    <div class="question" style="display: none;">
                        <h3>Question <?= $index + 1 ?></h3>
                        <p><?= $result['deskripsi'] ?></p>
                        
                        <ul class="options">
                            <?php
                            $options = json_decode($result['pilihan']);
                            foreach ($options as $optionIndex => $option): ?>
                                <li>
                                    <label>
                                        <input type="radio" name="answer[<?= $index ?>]" value="<?= $optionIndex ?>">
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
        <footer>
            <p>Copyright © 2024 by ICLabs</p>
        </footer>
</body>
<script src="/tubes_web/public/Assets/Script/exam/examScript.js"></script>

</html>
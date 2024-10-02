<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/sidebarStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="top">
            <div class="logo">
                <img src="/tubes_web/public/Assets/Img/iclabs.png" alt="IC-Assist Logo" class="icon">
                <span>IC-ASSIST</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <img src="/tubes_web/public/Assets/Img/dummy.jpeg" alt="foto" name="userphoto" id="userphoto"
                class="user-img">
            <div>
                <p class="bold" name="username" id="username">Ahmad Mufli Ramadhan</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="#" data-page="dashboard">
                    <i class="bx bx-home"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="#" data-page="biodata">
                    <i class="bx bxs-id-card"></i>
                    <span class="nav-item">Lengkapi Biodata</span>
                </a>
                <span class="tooltip">Lengkapi Biodata</span>
            </li>
            <li>
                <a href="#" data-page="uploadBerkas">
                    <i class="bx bx-file"></i>
                    <span class="nav-item">Upload Berkas</span>
                </a>
                <span class="tooltip">Upload Berkas</span>
            </li>
            <li>
                <a href="#" data-page="tesTulis">
                    <i class="bx bx-task"></i>
                    <span class="nav-item">Tes Tulis</span>
                </a>
                <span class="tooltip">Tes Tulis</span>
            </li>
            <li>
                <a href="#" data-page="presentasi">
                    <i class="bx bx-chalkboard"></i>
                    <span class="nav-item">Presentasi</span>
                </a>
                <span class="tooltip">Presentasi</span>
            </li>
            <li>
                <a href="#" data-page="wawancara">
                    <i class="bx bx-user-voice"></i>
                    <span class="nav-item">Wawancara</span>
                </a>
                <span class="tooltip">Wawancara</span>
            </li>
            <li>
                <a href="#" data-page="pengumuman">
                    <i class="bx bx-notepad"></i>
                    <span class="nav-item">Pengumuman</span>
                </a>
                <span class="tooltip">Pengumuman</span>
            </li>
        </ul>
    </div>
    <div class="main-content" id="content">
       
    </div>
    <script> const APP_URL =  '<?php echo APP_URL; ?>' </script>
    <script src="/tubes_web/public/Assets/Script/sidebar/ScriptSidebar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/tubes_web/public/Assets/Script/app.js"></script>

</body>

</html>
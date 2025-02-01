<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/biodata.css" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/sidebarStyle.css">
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/wawancara.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/pengumuman.css" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/presentasi.css" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/uploadberkas.css" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/dashboardStyle.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/alertAdmin.css">



</head>

<body>
    <?php require_once "sidebarAdmin.php" ?>

    <div class="main-content" id="content">
        <?php require_once "daftarPeserta.php" ?>
    </div>


    <div id="customModal" class="alertmodal-admin">
        <div class="modal-content-admin">
            <img id="modalGif" src="" alt="Animation" style="width: 100px; margin-bottom: 15px; display: none;">

            <p id="modalMessage" style="margin: 10px 0; font-size: 18px;">Pesan akan ditampilkan di sini.</p>

            <button id="closeModal" class="btn btn-primary" style="margin-top: 10px;">Tutup</button>
        </div>
    </div>

    <div id="confirmModal" class="modal-admin">
        <div class="modal-content-admin">
            <p id="confirmModalMessage"></p>
            <div class="modal-buttons-admin">
                <button id="confirmModalConfirm" class="btn-confirm">Confirm</button>
                <button id="confirmModalCancel" class="btn-cancel">Tidak</button>
            </div>
        </div>
    </div>
    <script> const APP_URL = '<?php echo APP_URL; ?>' </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/tubes_web/public/Assets/Script/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="/tubes_web/public/Assets/Script/sidebar/ScriptSidebar.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</body>
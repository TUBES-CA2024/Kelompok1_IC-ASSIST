<div class="sidebar" id="sidebar">
    <div class="top">
        <div class="logo">
            <img src="/tubes_web/public/Assets/Img/iclabs.png" alt="IC-Assist Logo" class="icon">
            <span>IC-ASSIST</span>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <div class="user">
        <div>
            <p class="bold" id="username"><?= $userName ?></p>
        </div>
    </div>
    <ul>
        <li>
            <a href="#" data-page="lihatPeserta">
                <i class='bx bxs-user-check'></i>
                <span class="nav-item">Lihat Peserta</span>
            </a>
            <span class="tooltip">Lihat Peserta</span>
        </li>

        <li>
            <a href="#" data-page="berkasPeserta">
            <i class='bx bx-spreadsheet'></i>                
            <span class="nav-item">Berkas Peserta</span>
            </a>
            <span class="tooltip">Berkas Peserta</span>
        </li>

        <li>
            <a href="#" data-page="presentasi">
            <i class='bx bx-slideshow' ></i>
                <span class="nav-item">Presentasi</span>
            </a>
            <span class="tooltip">Presentasi</span>
        </li>
        <li>
            <a href="#" data-page="tesTulis">
                <i class="bx bx-task"></i>
                <span class="nav-item">Tes Tulis</span>
            </a>
            <span class="tooltip">Tes Tulis</span>
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
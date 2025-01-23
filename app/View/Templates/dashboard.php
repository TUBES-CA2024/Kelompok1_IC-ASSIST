<?php
use app\Controllers\notifications\NotificationControllers;
use app\Controllers\user\DashboardUserController;
$notifikasi = NotificationControllers::getMessageById() ?? [];

?>

<main>
  <h1 class="dashboard">Dashboard</h1>
  <div class="insights">
    <div class="tahap">
      <span class="material-symbols-outlined">browse_activity</span>
      <div class="middle">
        <div class="left">
          <h3>Tahap yang telah di selesaikan</h3>
          <h1><?=DashboardUserController::getNumberTahapanSelesai()?></h1>
        </div>
        <div class="progress">
          <svg>
            <circle cx="39" cy="39" r="39"></circle>
          </svg>
          <div class="number">
            <?=DashboardUserController::getPercentage()?>
          </div>
        </div>
      </div>
      <small class="text_muted">Last 24 Hours</small>
    </div>
  </div>
  <div class="recent-tahapan">
    <h2 class="tahapan-pendaftaran">
      Tahapan-Tahapan pendaftaran Calon Asisten ICLABS 2024
    </h2>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Tahapan</th>
          <th>Status</th>
          <th>keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Lengkapi Biodata</td>
          <?php 
          if(DashboardUserController::getBiodataStatus() == 1) {
           
            ?>
          <td class="success">Selesai</td>
          
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>
        </tr>
        <tr>
          <td>2</td>
          <td>Lengkapi Berkas</td>
          <?php 
          if(DashboardUserController::getBerkasStatus() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum mensubmit berkas anda </td>
          <?php
          }
          ?>
        </tr>
        <tr>
          <td>3</td>
          <td>Tes Tertulis</td>
          <?php 
          if(DashboardUserController::getAbsensiTesTertulis() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>

        </tr>
        <tr>
          <td>4</td>
          <td>Submit Judul makalah dan PPT</td>
          <?php 
          if(DashboardUserController::getPptStatus() == 'diterima') {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else if(DashboardUserController::getPptStatus() == 'revisi') {
            
          ?>
          <td class="danger">Revisi</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum submit judul presentasi </td>
            <?php
          }
          ?>
        </tr>
        <tr>
          <td>5</td>
          <td>Submit makalah dan PPT</td>
          <?php 
          if(DashboardUserController::getPptJudulAccStatus() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda Belum Submit Ppt dan makalah anda</td>
          <?php
          }
          ?>

        </tr>
        <tr>
          <td>6</td>
          <td>Presentasi</td>
          <?php 
          if(DashboardUserController::getAbsensiPresentasi() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>

        </tr>
        <tr>
          <td>7</td>
          <td>Wawancara Asisten</td>
          <?php 
          if(DashboardUserController::getAbsensiWawancaraI() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>

        </tr>
        <tr>
          <td>8</td>
          <td>Wawancara Kepala Lab 1</td>
          <?php 
          if(DashboardUserController::getAbsensiWawancaraII() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>
        </tr>
        <tr>
          <td>9</td>
          <td>Wawancara Kepala Lab 2</td>
          <?php 
          if(DashboardUserController::getAbsensiWawancaraIII() == 1) {
            ?>
          <td class="success">Selesai</td>
          <td>Anda telah menyelesaikan tahap ini</td>
            <?php
          } else {
          ?>
          <td class="danger">Belum</td>
          <td>Anda belum menyelesaikan tahap ini</td>
          <?php
          }
          ?>

        </tr>
      </tbody>
    </table>
  </div>
</main>
<div class="right">
  <div class="top">
    <div class="notification">
      <h2>Notification</h2>
      <span class="material-symbols-outlined">inbox</span>
      <div class="updates">
        <div class="update">
          <div class="message">
            <p><b>Tim Iclabs</b> selamat kamu telah berhasil mendaftar di web IC-ASSIST</p>
          </div>
        </div>
        <div class="dashboard" id="dashboard">
          <button type="button" class="btn btn-primary" id="viewMessageButton">
            Lihat Pesan
          </button>
        </div>
      </div>
      <div id="content" style="margin-top: 20px;"></div>
    </div>
  </div>
</div>

<div id="customMessageModal" class="custom-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
  <div class="custom-modal-content" style="background: white; padding: 20px; border-radius: 8px; width: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <div class="custom-modal-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
      <h5 class="custom-modal-title">Pesan</h5>
      <button id="closeModalButton" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
    </div>
    <div class="custom-modal-body" style="margin-top: 10px; display: flex; flex-direction: column; gap: 10px;">
      <?php
      if($notifikasi == null) {
        echo "<p>Tidak ada pesan</p>";
      } else {

      foreach($notifikasi as $notif) { ?>
          <div style="background: #f9f9f9; border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-transform: uppercase;">
            <b>Tim Iclabs</b>
            <p><?=$notif['pesan']?></p>
            <p><?=$notif['created_at']?></p>
          </div>
      <?php
      }
      }
      ?>
    </div>
    <div class="custom-modal-footer" style="margin-top: 20px; text-align: right;">
      <button id="closeModalFooterButton" class="btn btn-secondary">Tutup</button>
    </div>
  </div>
</div>

<script>
  const viewMessageButton = document.getElementById("viewMessageButton");
  const customMessageModal = document.getElementById("customMessageModal");
  const closeModalButton = document.getElementById("closeModalButton");
  const closeModalFooterButton = document.getElementById("closeModalFooterButton");

  viewMessageButton.addEventListener("click", function () {
    customMessageModal.style.display = "flex";
  });

  closeModalButton.addEventListener("click", function () {
    customMessageModal.style.display = "none";
  });

  closeModalFooterButton.addEventListener("click", function () {
    customMessageModal.style.display = "none";
  });

  customMessageModal.addEventListener("click", function (event) {
    if (event.target === customMessageModal) {
      customMessageModal.style.display = "none";
    }
  });
</script>
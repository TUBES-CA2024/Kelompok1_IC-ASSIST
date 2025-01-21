
<main>
  <h1 class="dashboard">Dashboard</h1>
  <div class="insights">
    <div class="tahap">
      <span class="material-symbols-outlined">browse_activity</span>
      <div class="middle">
        <div class="left">
          <h3>Tahap yang telah di selesaikan</h3>
          <h1>4</h1>
        </div>
        <div class="progress">
          <svg>
            <circle cx="38" cy="38" r="38"></circle>
          </svg>
          <div class="number">
            <p>81%</p>
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
          <th>Waktu</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Lengkapi Biodata</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum Melengkapi Biodata</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Lengkapi Berkas</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum Melengkapi Berkas CV dan Makalah</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Tes Tertulis</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum lulus tahap sebelumnya</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Submit Judul makalah dan PPT</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum lulus tahap sebelumnya</td>
        </tr>
        <tr>
          <td>5</td>
          <td>Submit makalah dan PPT</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum lulus tahap sebelumnya</td>
        </tr>
        <tr>
          <td>6</td>
          <td>Presentasi</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum Submit makalah dan PPT</td>
        </tr>
        <tr>
          <td>7</td>
          <td>Wawancara I</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum lulus tahap sebelumya</td>
        </tr>
        <tr>
          <td>8</td>
          <td>Wawancara II</td>
          <td class="danger">Belum</td>
          <td>17-10-2024 - 19-12-2024</td>
          <td>Belum lulus tahap sebelumnya</td>
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
          <div class="profile-photo">
            <img src="/tubes_web/public/Assets/Img/dummy.jpeg" alt="foto dummy" style="width:100%; height:100%;" />
          </div>
          <div class="message">
            <p><b>Tim Iclabs</b> selamat kamu telah berhasil mendaftar di web IC-ASSIST</p>
            <small class="text_muted">10 hours ago</small>
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
  <div class="custom-modal-content" style="background: white; padding: 20px; border-radius: 8px; width: 400px;">
    <div class="custom-modal-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
      <h5 class="custom-modal-title">Pesan</h5>
      <button id="closeModalButton" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
    </div>
    <div class="custom-modal-body" style="margin-top: 10px;">
      <p><b>Tim Iclabs</b>: Selamat kamu telah berhasil mendaftar di web IC-ASSIST</p>
      <small class="text-muted">10 hours ago</small>
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

<?php

?>
    <main>
    <div>
    <h2 class="presentasi">Presentasi</h2>
    <div class="form-container">
        
        <form id="presentasiForm">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>
    </div>
    <div class="recent-judul">
      <h2 class="tahapan-presentasi">
        Hasil submit judul presentasi
      </h2>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Waktu Pengiriman Judul</th>
            <th>Abstract</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>cnn</td>
            <td class="danger">revisi</td>
            <td>17-10-2024 - 19-12-2024</td>
            <td><a href="#">download</a></td>
            <td>gk ngerti AI SOK SOK PAKE DEEP LEARNING</td>
          </tr>
          </tbody>
          </table>
          </div>
    </main>
    <script src="/tubes_web/public/Assets/Script/user/presentasi.js"></script>
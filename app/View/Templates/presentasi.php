<?php
use App\Controllers\User\PresentasiUserController;

$results = PresentasiUserController::viewAll();
?>
<main>
  <div>
    <h1 class="dashboard">Presentasi</h1>
    <?php
    ?>
    <div class="form-container">
      <form id="berkasPresentasiForm">
        <?php if ( !$results||$results['is_accepted'] == 0 || $results['is_revisi'] == 1) { ?>
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-submit">Submit</button>
          </div>
        </form>
      </div>
      <?php
        } else if ($results['is_accepted'] == 1 && isset($results['is_accepted'])) {
          ?>
        <div class="form-container">
          <form id="presentasiFormAccepted" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="ppt" class="form-label">Masukkan PPT</label>
              <input class="form-control" type="file" id="ppt" name="ppt" required>
            </div>

            <div class="mb-3">
              <label for="makalah" class="form-label">Masukkan makalah anda</label>
              <input class="form-control" type="file" id="makalah" name="makalah" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-submit">Submit</button>
            </div>
          </form>
        </div>
    <?php } ?>
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
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        if (isset($results['judul']))
          $results = [$results];
        foreach ($results as $row) {
          $revisi = !$row['is_accepted']
            ? (!empty($row['revisi']) ? 'Revisi: ' . $row['revisi'] : 'ditolak')
            : 'diterima';
          $keterangan = !$row['is_accepted']
            ? (!empty($row['is_revisi'] && (!empty($row['keterangan']) || !$row['keterangan'])) ? $row['keterangan'] : 'Belum Diterima')
            : 'Silahkan submit ppt dan makalahnya!';
          $color = !$row['is_accepted'] ? 'danger' : 'success';
          $judul = $row['judul'];
          $created = $row['created_at'];
          ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $judul ?></td>
            <td class=<?= $color ?>><?= $revisi ?></td>
            <td><?= $created ?></td>
            <td><?= $keterangan ?></td>
          </tr>
          <?php $i++;
        } ?>
      </tbody>


    </table>
  </div>
</main>
<script src="/tubes_web/public/Assets/Script/user/presentasi.js"></script>
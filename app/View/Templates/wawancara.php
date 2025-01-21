<?php
  use app\Controllers\user\WawancaraController;
  $wawancara = WawancaraController::getAllById() ;
?>

<main>
    <h2 class="dashboard">Wawancara</h2>
    <div class="recent-judul">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis-Wawancara</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($wawancara)) : ?>
                    <tr>
                        <td colspan="5">Belum ada jadwal wawancara</td>
                    </tr>
                <?php endif; $i = 1;?>
                <?php foreach ($wawancara as $value) : ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $value['jenis_wawancara'] ?? "" ?></td>
                        <td><?= $value['ruangan'] ?? "" ?></td>
                        <td><?= $value['tanggal']?? "" ?></td>
                        <td><?= $value['waktu'] ?? "" ?></td>
                    </tr>
                       
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
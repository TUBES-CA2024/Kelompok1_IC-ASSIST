<?php

use App\Controllers\Exam\NilaiAkhirController;
$nilai = NilaiAkhirController::getAllNilaiAkhirMahasiswa();
?>
<main>

<h1 class="dashboard">Daftar Nilai</h1>
<table id="daftar-nilai" class="table table-striped rounded-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stambuk</th>
            <th>Nilai Tes tertulis</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($nilai as $key => $value) : ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $value['nama_lengkap'] ?></td>
                <td><?= $value['stambuk'] ?></td>
                <td><?= $value['nilai'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</main>

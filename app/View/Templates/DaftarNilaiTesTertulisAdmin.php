<?php

use App\Controllers\Exam\NilaiAkhirController;
$nilai = NilaiAkhirController::getAllNilaiAkhirMahasiswa();
?>
<h1>Daftar Nilai Mahasiswa</h1>
<table id="daftar-nilai" class="table table-striped table-bordered">
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
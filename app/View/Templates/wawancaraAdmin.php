<?php
 use App\Controllers\user\WawancaraController;
 $wawancara = WawancaraController::getAll();
?>
<h1>Wawancara Admin</h1>

<table id="presentasiMahasiswa" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Ruangan</th>
            <th>Jenis Wawancara</th>
            <th>Waktu</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($wawancara as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['id_mahasiswa'] ?>">
                <td><?= $i ?></td>
                <td>
                    <span class="open-detail" data-bs-toggle="modal" data-bs-target="#presentasiModal"
                        data-nama="<?= $row['nama_lengkap'] ?>" data-stambuk="<?= $row['stambuk'] ?>"
                        data-ruangan="<?= $row['ruangan'] ?>" data-jeniswawancara="<?= $row['jenis_wawancara'] ?>"
                        data-waktu="<?= $row['waktu']?>" data-tanggal="<?= $row['tanggal'] ?>">
                        <?= $row['nama_lengkap'] ?>
                    </span>
                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['ruangan'] ?></td>
                <td><?= $row['jenis_wawancara']?></td>
                <td><?= $row['waktu']?></td>
                <td><?= $row['tanggal']?></td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
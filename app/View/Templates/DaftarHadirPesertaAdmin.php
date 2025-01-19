<?php
    use App\Controllers\user\AbsensiUserController;
    $absensiList = AbsensiUserController::viewAbsensi();
?>

<h1>Daftar Hadir Mahasiswa</h1>

<table id="presentasiMahasiswa" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Tes tertulis</th>
            <th>Presentasi</th>
            <th>Wawancara I</th>
            <th>Wawancara II</th>
            <th>Wawancara III</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($absensiList as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['id'] ?>">
                <td><?= $i ?></td>
                <td>
                    <span class="open-detail" data-bs-toggle="modal" data-bs-target="#presentasiModal"
                        data-nama="<?= $row['nama'] ?>" data-stambuk="<?= $row['stambuk'] ?>"
                        data-absensiwawancaraI="<?= $row['absensi_wawancara_I'] ?>" data-absensiwawancaraII="<?= $row['absensi_wawancara_II']?>"
                        data-absensiwawancaraIII="<?= $row['absensi_wawancara_III'] ?>"
                        data-absensitestertulis="<?= $row['absensi_test_tertulis'] ?>" data-absensipresentasi="<?= $row['absensi_presentasi'] ?>">
                        <?= $row['nama'] ?>
                    </span>
                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['absensi_test_tertulis'] ?></td>
                <td><?= $row['absensi_presentasi'] ?></td>
                <td><?= $row['absensi_wawancara_I'] ?></td>
                <td><?= $row['absensi_wawancara_II'] ?></td>
                <td><?= $row['absensi_wawancara_III'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>


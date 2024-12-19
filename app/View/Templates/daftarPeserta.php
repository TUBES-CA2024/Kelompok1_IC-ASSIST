<?php
use App\Controllers\user\MahasiswaController;
$result = MahasiswaController::viewAllMahasiswa() ?? [];
?>

<table id="daftar" class="display">
    <thead>
        <tr>
            <th>no</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <div style="display: flex; gap:5%;">
                        <img src="/tubes_web/public/Assets/Img/edit.svg" alt="edit" style="cursor: pointer;" onclick="editMahasiswa(<?= $row['id'] ?>)">
                        <img src="/tubes_web/public/Assets/Img/delete.svg" alt="delete" style="cursor: pointer;" onclick="deleteMahasiswa(<?= $row['id'] ?>)">
                    </div>
                </td>
            </tr>
            <?php $i++;
        } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#daftar').DataTable();
    })
</script>
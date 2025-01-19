<h1>Wawancara Admin</h1>

<table id="presentasiMahasiswa" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Judul Presentasi</th>
            <th>Aksi</th>
        </tr>s
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswaList as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['id_mahasiswa'] ?>">
                <td><?= $i ?></td>
                <td>
                    <span class="open-detail" data-bs-toggle="modal" data-bs-target="#presentasiModal"
                        data-nama="<?= $row['nama'] ?>" data-stambuk="<?= $row['stambuk'] ?>"
                        data-judul="<?= $row['judul'] ?>" data-ppt="<?= $row['berkas']['ppt'] ?>"
                        data-makalah="<?= $row['berkas']['makalah'] ?>">
                        <?= $row['nama'] ?>
                    </span>
                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td>
                    <div style="display: flex; gap: 5%;">
                        <img src="/tubes_web/public/Assets/Img/edit.svg" alt="edit" class="edit-button"
                            style="cursor: pointer;">
                        <img src="/tubes_web/public/Assets/Img/delete.svg" alt="delete" class="delete-button"
                            style="cursor: pointer;">
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
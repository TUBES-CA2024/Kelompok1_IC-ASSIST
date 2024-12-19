<?php
use App\Controllers\user\BerkasUserController;
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
            <tr data-bs-toggle="modal" data-bs-target="#detailModal" data-nama="<?= $row['nama_lengkap'] ?>"
                data-stambuk="<?= $row['stambuk'] ?>" data-jurusan="<?= $row['jurusan'] ?>"
                data-kelas="<?= $row['kelas'] ?>" data-alamat="<?= $row['alamat'] ?>"
                data-tempat_lahir="<?= $row['tempat_lahir'] ?>" data-notelp="<?= $row['notelp'] ?>"
                data-tanggal_lahir="<?= $row['tanggal_lahir'] ?>" data-jenis_kelamin="<?= $row['jenis_kelamin'] ?>"
                data-foto="<?= $row['berkas']['foto'] ?>"
                style="cursor: pointer;">
                <td><?= $i ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <div style="display: flex; gap:5%;">
                        <img src="/tubes_web/public/Assets/Img/edit.svg" alt="edit" style="cursor: pointer;"
                            onclick="editMahasiswa(<?= $row['id'] ?>)">
                        <img src="/tubes_web/public/Assets/Img/delete.svg" alt="delete" style="cursor: pointer;"
                            onclick="deleteMahasiswa(<?= $row['id'] ?>)">
                    </div>
                </td>
            </tr>
            <?php $i++;
        } ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalFoto" src="" alt="" style="width: 100%; max-height: 300px; object-fit: cover;">
                <p><strong>Nama Lengkap:</strong> <span id="modalNama"></span></p>
                <p><strong>Stambuk:</strong> <span id="modalStambuk"></span></p>
                <p><strong>Jurusan:</strong> <span id="modalJurusan"></span></p>
                <p><strong>Kelas:</strong> <span id="modalKelas"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <p><strong>Tempat Lahir:</strong> <span id="modalTempat_lahir"></span></p>
                <p><strong>Tanggal Lahir:</strong> <span id="modalTanggal_lahir"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="modalJenis_kelamin"></span></p>
                <p><strong>No Telephone:</strong> <span id="modalNoTelp"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="downloadButton">
                    Download Berkas
                </button>
                <button type="button" class="btn btn-success" id="acceptButton">
                    Accept
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const table = $('#daftar').DataTable();

        $('#daftar tbody').on('click', 'tr', function () {
            const nama = $(this).data('nama');
            const stambuk = $(this).data('stambuk');
            const jurusan = $(this).data('jurusan');
            const kelas = $(this).data('kelas');
            const alamat = $(this).data('alamat');
            const tempat_lahir = $(this).data('tempat_lahir');
            const notelp = $(this).data('notelp');
            const tanggal_lahir = $(this).data('tanggal_lahir');
            const jenis_kelamin = $(this).data('jenis_kelamin');
            const foto = this.getAttribute('data-foto');
            console.log({ nama, stambuk, jurusan, kelas, alamat, tempat_lahir, notelp, tanggal_lahir, jenis_kelamin,foto });

            // Masukkan data ke modal
            $('#modalNama').text(nama);
            $('#modalStambuk').text(stambuk);
            $('#modalJurusan').text(jurusan);
            $('#modalKelas').text(kelas);
            $('#modalAlamat').text(alamat);
            $('#modalTempat_lahir').text(tempat_lahir);
            $('#modalNoTelp').text(notelp);
            $('#modalTanggal_lahir').text(tanggal_lahir);
            $('#modalJenis_kelamin').text(jenis_kelamin);

            $('#modalFoto').attr('src', "/tubes_web/res/imageUser/" + foto || '/path/to/default-image.jpg');
            $('#modalFoto').attr('alt', `Foto ${nama}`);
        });
    });

</script>
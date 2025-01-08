<?php
use App\Controllers\presentasi\RuanganController;
use App\Controllers\User\PresentasiUserController;
$mahasiswaList = PresentasiUserController::viewAllForAdmin();
$ruanganList = RuanganController::viewAllRuangan();
?>
<table id="presentasiMahasiswa" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Judul Presentasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswaList as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['id_mahasiswa'] ?>">
                <td><?= $i ?></td>
                <td>
                    <span class="open-detail" data-bs-toggle="modal" data-bs-target="#presentasiModal"
                        data-nama="<?= $row['nama'] ?>" data-stambuk="<?= $row['stambuk'] ?>"
                        data-judul="<?= $row['judul'] ?>" data-ppt="<?= $row['berkas']['ppt'] ?>" data-makalah="<?= $row['berkas']['makalah'] ?>">
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
</table>

<!-- Modal -->
<div class="modal fade" id="presentasiModal" tabindex="-1" aria-labelledby="presentasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentasiModalLabel">Detail Presentasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalFotoPresentasi" src="" alt="" style="width: 100%; max-height: 300px; object-fit: cover;">

                <p><strong>Nama Lengkap:</strong> <span id="modalNamaPresentasi"></span></p>
                <p><strong>Stambuk:</strong> <span id="modalStambukPresentasi"></span></p>
                <p><strong>Judul Presentasi:</strong> <span id="modalJudulPresentasi"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadPptPresentasi" class="btn btn-primary">Unduh PPT</button>
                <button type="button" id="downloadMakalahPresentasi" class="btn btn-primary">Unduh Makalah</button>
                <button type="button" class="btn btn-success" id="acceptButtonPresentasi">Accept</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan ke Mahasiswa:</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editForm">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#presentasiModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);

            const nama = button.data('nama');
            const stambuk = button.data('stambuk');
            const judul = button.data('judul');
            const ppt = button.data('ppt');
            const makalah = button.data('makalah');
            const idMahasiswa = button.closest('tr').data('userid');

            console.log("makalah : " + makalah);
            console.log("PPt :s " + ppt);
            $('#modalNamaPresentasi').text(nama || 'Data tidak tersedia');
            $('#modalStambukPresentasi').text(stambuk || 'Data tidak tersedia');
            $('#modalJudulPresentasi').text(judul || 'Data tidak tersedia');
            $('#downloadMakalahPresentasi').attr('data-download-url', makalah ? `/tubes_web/res/makalahUser/${makalah}` : '#');
            $('#downloadPptPresentasi').attr('data-download-url', ppt ? `/tubes_web/res/pptUser/${ppt}` : '#');
            $('#acceptButtonPresentasi').data('userid', idMahasiswa);

        });

        $('#downloadPptPresentasi').on('click', function () {
            const url = $(this).data('download-url');
            if (url && url !== '#') {
                window.location.href = url;
            } else {
                alert('Berkas tidak tersedia.');
            }
        });
        $('#downloadMakalahPresentasi').on('click', function () {
            const url = $(this).data('download-url');
            if (url && url !== '#') {
                window.location.href = url;
            } else {
                alert('Berkas tidak tersedia.');
            }
        });


        $('#presentasiMahasiswa tbody').on('click', '.delete-button', function (event) {
            event.stopPropagation();
            const id = $(this).closest('tr').data('id');
            const userid = $(this).closest('tr').data('userid');

            $('#deleteModal').data('id', id).data('userid', userid).modal('show');
        });

        $('#confirmDelete').on('click', function () {
            const userid = $('#deleteModal').data('userid');

            $.ajax({
                url: '<?= APP_URL ?>/deletemhs',
                type: 'POST',
                data: { id: userid },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Data berhasil dihapus!');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });

            $('#deleteModal').modal('hide');
        });

        $('#presentasiMahasiswa tbody').on('click', '.edit-button', function (event) {
            event.stopPropagation();
            const id = $(this).closest('tr').data('id');
            $('#editModal').data('id', id).modal('show');
        });

        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#editModal').data('id');
            const message = $('#message').val();

            $.ajax({
                url: '<?= APP_URL ?>/notification',
                type: 'POST',
                data: { id: id, message: message },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Pesan berhasil dikirim!');
                    } else {
                        alert('Gagal mengirim pesan!');
                    }
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });

            $('#editModal').modal('hide');
        });
        $('#acceptButtonPresentasi').on('click', function () {
            const idMahasiswa = $(this).data('userid');

            if (!idMahasiswa) {
                alert('ID mahasiswa tidak ditemukan.');
                return;
            }

            $.ajax({
                url:  '<?= APP_URL ?>/updatestatus',
                type: 'POST',
                data: { id: idMahasiswa },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Status berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert('Gagal memperbarui status: ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Terjadi kesalahan. Coba lagi nanti.');
                }
            });
        });
    });
</script>
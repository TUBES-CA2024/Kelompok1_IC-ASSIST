<?php
use App\Controllers\presentasi\RuanganController;
$ruanganList = RuanganController::viewAllRuangan();
?>

<main>
<h1 class="dashboard">Ruangan</h1>

<!-- Button Tambah Ruangan -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahRuanganModal">
    Tambah Ruangan
</button>

<table class="table table-striped rounded-table" style="table-layout: auto; width: 100%; text-align: left;">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="jadwalTableBody">
        <?php $i = 1; ?>
        <?php foreach ($ruanganList as $ruangan) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $ruangan['nama'] ?></td>
                <td>
                    <div style="display: flex; gap:5%;">
                        <img src="/tubes_web/public/Assets/Img/edit.svg" alt="edit" class="edit-button" data-id="<?= $ruangan['id'] ?>" style="cursor: pointer;">
                        <img src="/tubes_web/public/Assets/Img/delete.svg" alt="delete" class="delete-button" data-id="<?= $ruangan['id'] ?>" style="cursor: pointer;">
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>
</main>

<!-- Modal Tambah Ruangan -->
<div class="modal fade" id="tambahRuanganModal" tabindex="-1" aria-labelledby="tambahRuanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRuanganLabel">Tambah Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahRuanganForm">
                    <div class="mb-3">
                        <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="namaRuangan" name="namaRuangan" placeholder="Masukkan nama ruangan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Ruangan -->
<div class="modal fade" id="updateRuanganModal" tabindex="-1" aria-labelledby="updateRuanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRuanganLabel">Update Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateRuanganForm">
                    <input type="hidden" id="updateRuanganId">
                    <div class="mb-3">
                        <label for="updateNamaRuangan" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="updateNamaRuangan" name="updateNamaRuangan" placeholder="Masukkan nama ruangan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tambahRuanganForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                namaRuangan: $('#namaRuangan').val()
            };

            $.ajax({
                url: '<?=APP_URL?>/tambahruangan', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Ruangan berhasil ditambahkan!');
                        location.reload(); 
                    } else {
                        alert('Gagal menambahkan ruangan: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                }
            });
        });

        $('.delete-button').on('click', function() {
            const id = $(this).data('id');
            console.log(id);
            if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?')) {
                $.ajax({
                    url: '<?=APP_URL?>/deleteruangan',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Ruangan berhasil dihapus!');
                            location.reload();
                        } else {
                            alert('Gagal menghapus ruangan: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, coba lagi.');
                    }
                });
            }
        });

        // Update Ruangan
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            const currentName = $(this).closest('tr').find('td:nth-child(2)').text();

            $('#updateRuanganId').val(id);
            $('#updateNamaRuangan').val(currentName);

            $('#updateRuanganModal').modal('show');
        });

        $('#updateRuanganForm').on('submit', function(e) {
            e.preventDefault();

            const id = $('#updateRuanganId').val();
            const namaRuangan = $('#updateNamaRuangan').val();
            console.log(id, namaRuangan);
            $.ajax({
                url: '<?=APP_URL?>/updateruangan',
                type: 'POST',
                data: { id: id, namaRuangan: namaRuangan },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Ruangan berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert('Gagal memperbarui ruangan: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                }
            });
        });
    });
</script>

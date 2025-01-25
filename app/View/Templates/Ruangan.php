<?php
use App\Controllers\presentasi\RuanganController;
$ruanganList = RuanganController::viewAllRuangan();
?>
<style>
    /* Import Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    
    .btn-primary {
        background: linear-gradient(135deg, #3DC2EC, #3392cc);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #3392cc, #3DC2EC);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .btn-primary:focus {
        outline: none;
    }

    /* Table Styles */
    .table-striped {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin: 20px 0;
    }

    .table-striped th,
    .table-striped td {
        padding: 16px 20px;
        text-align: left;
        color: #555;
    }

    .table-striped th {
        background-color: #f9fbfc;
        font-weight: 600;
        font-size: 1rem;
        color: #333;
        text-transform: uppercase;
    }

    .table-striped tr:nth-child(odd) {
        background-color: #f8faff;
    }

    .table-striped tr:nth-child(even) {
        background-color: #e8f4fc;
    }

    .table-striped tr:hover {
        background-color: rgba(61, 194, 236, 0.2);
        cursor: pointer;
    }

    .rounded-table {
        border-radius: 12px;
        overflow: hidden;
    }

    /* Action Buttons */
    .edit-button,
    .delete-button {
        width: 24px;
        height: 24px;
        transition: transform 0.3s ease;
    }

    .edit-button:hover,
    .delete-button:hover {
        transform: scale(1.2);
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        font-family: 'Poppins', sans-serif;
    }

    .modal-header {
        background: linear-gradient(135deg, #3DC2EC, #3392cc);
        color: white;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
        padding: 20px;
    }

    .modal-header h5 {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .modal-body {
        padding: 20px;
        color: #555;
    }

    .modal-footer {
        border-top: none;
        padding: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px 15px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #3DC2EC;
        box-shadow: 0 0 5px rgba(61, 194, 236, 0.5);
        outline: none;
    }
</style>

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

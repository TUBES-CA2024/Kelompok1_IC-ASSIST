<?php
use App\Controllers\presentasi\RuanganController;
use App\Controllers\User\PresentasiUserController;
use App\Controllers\presentasi\JadwalPresentasiController;
$mahasiswaList = PresentasiUserController::viewAllForAdmin();
$mahasiswaAccStatus = PresentasiUserController::viewAllAccStatusForAdmin();
$ruanganList = RuanganController::viewAllRuangan();
$jadwalPresentasi = JadwalPresentasiController::getJadwalPresentasi();
?>
<style>
    /* Import Font Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    /* Button Styles */
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

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Table Styles */
    .table-striped {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin-top: 20px;
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
        font-size: 1.5rem;
        font-weight: 600;
    }

    .modal-body {
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
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

    /* Form Inputs */
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

    .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .form-select:focus {
        border-color: #3DC2EC;
        outline: none;
    }

    /* Miscellaneous */
    .btn-close {
        background: transparent;
        font-size: 1.2rem;
        color: white;
        border: none;
    }

    .btn-close:hover {
        color: #ccc;
    }
    .tes {
    margin-top: 1rem;
    margin-bottom: 1rem;
    background-color: var(--color-white);
    width: 18%;
    text-align: center;
    border-radius: var(--border-radius-1);
    box-shadow: var(--box-shadow);
    color: var(--color-primary);
    border: 1px solid var(--color-light);
    }
</style>

<main>
<h1 class="dashboard">Presentasi </h1>
<table id="presentasiMahasiswa" class="table table-striped rounded-table">
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
</table>

<div style="text-align: center;">
    <h1 class="tes">Jadwal Presentasi</h1>

    <button type="button" data-bs-toggle="modal" data-bs-target="#addJadwalModal"
        style="font-size: 1rem; padding: 10px 20px; margin-bottom: 1rem;">
        Tambah Jadwal
    </button>

    <table class="table table-striped rounded-table" style="table-layout: auto; width: 100%; text-align: left;">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Stambuk</th>
                <th>Nama Lengkap</th>
                <th>Judul Presentasi</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody id="jadwalTableBody">
            <?php $i = 1; ?>
            <?php foreach ($jadwalPresentasi as $jadwal) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $jadwal['stambuk'] ?></td>
                    <td><?= $jadwal['nama'] ?></td>
                    <td><?= $jadwal['judul_presentasi'] ?></td>
                    <td><?= $jadwal['ruangan'] ?></td>
                    <td><?= $jadwal['tanggal'] ?></td>
                    <td><?= $jadwal['waktu'] ?></td>
                </tr>
                <?php $i++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addJadwalModal" tabindex="-1" aria-labelledby="addJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJadwalModalLabel">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addJadwalForm">
                    <div class="mb-3">
                        <label for="mahasiswa" class="form-label">Pilih Mahasiswa</label>
                        <select class="form-select" id="mahasiswa">
                            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                            <?php foreach ($mahasiswaAccStatus as $mahasiswa): ?>
                                <option value="<?= $mahasiswa['id'] ?>">
                                    <?= $mahasiswa['stambuk'] ?> - <?= $mahasiswa['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-secondary mt-2" id="addMahasiswaButton">Tambah
                            mahasiswa</button>
                    </div>
                    <div class="mb-3">
                        <label for="selectedMahasiswa" class="form-label">Mahasiswa Terpilih</label>
                        <ul class="list-group" id="selectedMahasiswaList">
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <select class="form-select" id="ruangan" required>
                            <option value="" disabled selected>-- Pilih Ruangan --</option>
                            <?php foreach ($ruanganList as $ruangan): ?>
                                <option value="<?= $ruangan['id'] ?>">
                                    <?= $ruangan['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="waktu" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>

<div class="modal fade" id="presentasiModal" tabindex="-1" aria-labelledby="presentasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentasiModalLabel">Detail Presentasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                showModal('Berkas tidak tersedia.');
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

            console.log('ID:', id);
            console.log('Message:', message);
            $.ajax({
                url: '<?= APP_URL ?>/updatepresentasi',
                type: 'POST',
                data: { id: id, message: message },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Pesan berhasil dikirim!');
                    } else {
                        console.error(response.message);
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
                url: '<?= APP_URL ?>/updatestatus',
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

    $(document).ready(() => {
        const mahasiswaDropdown = document.getElementById("mahasiswa");
        const addMahasiswaButton = document.getElementById("addMahasiswaButton");
        const selectedMahasiswaList = document.getElementById("selectedMahasiswaList");
        const addJadwalForm = document.getElementById("addJadwalForm");

        console.log("addMahasiswaButton:", addMahasiswaButton); 
        let selectedMahasiswa = [];

        function renderSelectedMahasiswa() {
            selectedMahasiswaList.innerHTML = ""; 

            selectedMahasiswa.forEach((mahasiswa) => {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item d-flex justify-content-between align-items-center";
                listItem.textContent = mahasiswa.text;

                const removeButton = document.createElement("button");
                removeButton.className = "btn btn-sm btn-danger";
                removeButton.textContent = "Hapus";
                removeButton.addEventListener("click", () => {
                    selectedMahasiswa = selectedMahasiswa.filter((item) => item.id !== mahasiswa.id);
                    renderSelectedMahasiswa();
                });

                listItem.appendChild(removeButton);
                selectedMahasiswaList.appendChild(listItem);
            });
        }

        $(addMahasiswaButton).on("click", () => {
            console.log("Button clicked");
            const selectedOption = mahasiswaDropdown.options[mahasiswaDropdown.selectedIndex];
            const mahasiswaId = mahasiswaDropdown.value;
            const mahasiswaText = selectedOption ? selectedOption.text : null;

            if (!mahasiswaId) {
                alert("Pilih mahasiswa terlebih dahulu!");
                return;
            }

            // Cegah duplikasi
            if (selectedMahasiswa.some((item) => item.id === mahasiswaId)) {
                alert("Mahasiswa sudah dipilih!");
                return;
            }

            selectedMahasiswa.push({ id: mahasiswaId, text: mahasiswaText });
            console.log("Selected Mahasiswa:", selectedMahasiswa);
            renderSelectedMahasiswa();

            mahasiswaDropdown.selectedIndex = 0;
        });

        // Submit form
        $(addJadwalForm).on("submit", (e) => {
            e.preventDefault();

            const ruangan = document.getElementById("ruangan").value;
            const tanggal = document.getElementById("tanggal").value;
            const waktu = document.getElementById("waktu").value;
            console.log("selectedMahasiswa:", selectedMahasiswa);
            console.log("ruangan : " + ruangan);
            console.log("tanggal : " + tanggal);
            console.log("waktu : " + waktu);
            if (selectedMahasiswa.length === 0) {
                alert("Pilih setidaknya satu mahasiswa!");
                return;
            }

            const jadwalData = {
                selectedMahasiswa,
                ruangan,
                tanggal,
                waktu,
            };

            $.ajax({
                url: "<?= APP_URL ?>/tambahjadwal",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(jadwalData),
                success: function (response, data) {
                    if (response.status === 'success') {
                        alert(response.message || 'Data berhasil disimpan');
                        location.reload();
                    } else {
                        alert(response.message || 'Data gagal disimpan');
                        console.log(response.message);
                    }x

                    addJadwalForm.reset();
                    selectedMahasiswa = [];
                    renderSelectedMahasiswa();

                    alert("Jadwal berhasil ditambahkan!");
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Gagal menyimpan jadwal. Silakan coba lagi.");
                }
            });

        });
    });



</script>
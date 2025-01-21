<?php
use App\Controllers\user\WawancaraController;
use App\Controllers\user\MahasiswaController;
use App\Controllers\presentasi\RuanganController;
$wawancara = WawancaraController::getAll();
$mahasiswaList = MahasiswaController::viewAllMahasiswa();
$ruanganList = RuanganController::viewAllRuangan();
?>
<h1>Wawancara Admin</h1>
<button type="button" data-bs-toggle="modal" data-bs-target="#addJadwalModal" class="btn btn-primary mb-3">
    Tambah mahasiswa
</button>

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
                        data-waktu="<?= $row['waktu'] ?>" data-tanggal="<?= $row['tanggal'] ?>">
                        <?= $row['nama_lengkap'] ?>
                    </span>
                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['ruangan'] ?></td>
                <td><?= $row['jenis_wawancara'] ?></td>
                <td><?= $row['waktu'] ?></td>
                <td><?= $row['tanggal'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>

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
                            <?php foreach ($mahasiswaList as $mahasiswa): ?>
                                <option value="<?= $mahasiswa['id'] ?>">
                                    <?= $mahasiswa['stambuk'] ?> - <?= $mahasiswa['nama_lengkap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-secondary mt-2" id="addMahasiswaButton">Tambah mahasiswa</button>
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
                    <div class="mb-3">
                        <label for="wawancara" class="form-label">Jenis Wawancara</label>
                        <select class="form-select" id="wawancara" required>
                            <option value="" disabled selected>-- Pilih Jenis Wawancara --</option>
                            <option value="wawancara_asisten">Wawancara Asisten</option>
                            <option value="wawancara_kepala_lab_i">Wawancara Kepala Lab I</option>
                            <option value="wawancara_kepala_lab_ii">Wawancara Kepala Lab II</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        const mahasiswaDropdown = document.getElementById("mahasiswa");
        const addMahasiswaButton = document.getElementById("addMahasiswaButton");
        const selectedMahasiswaList = document.getElementById("selectedMahasiswaList");
        const addJadwalForm = document.getElementById("addJadwalForm");

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
            const selectedOption = mahasiswaDropdown.options[mahasiswaDropdown.selectedIndex];
            const mahasiswaId = mahasiswaDropdown.value;
            const mahasiswaText = selectedOption ? selectedOption.text : null;

            if (!mahasiswaId) {
                alert("Pilih mahasiswa terlebih dahulu!");
                return;
            }

            if (selectedMahasiswa.some((item) => item.id === mahasiswaId)) {
                alert("Mahasiswa sudah dipilih!");
                return;
            }

            selectedMahasiswa.push({ id: mahasiswaId, text: mahasiswaText });
            renderSelectedMahasiswa();

            mahasiswaDropdown.selectedIndex = 0;
        });

        $(addJadwalForm).on("submit", (e) => {
            e.preventDefault();

            const ruangan = document.getElementById("ruangan").value;
            const tanggal = document.getElementById("tanggal").value;
            const waktu = document.getElementById("waktu").value;
            const wawancara = document.getElementById("wawancara").value;
            let id = selectedMahasiswa.map((item) => item.id);
            if (selectedMahasiswa.length === 0) {
                alert("Pilih setidaknya satu mahasiswa!");
                return;
            }
            console.log("id " + id);
            const jadwalData = {
                id,
                ruangan,
                tanggal,
                waktu,
                wawancara,
            }; 
            $.ajax({
                url: "<?=APP_URL?>/wawancara",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(jadwalData),
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message || 'Data berhasil disimpan');
                        location.reload();
                    } else {
                        alert(response.message || 'Data gagal disimpan');
                    }

                    addJadwalForm.reset();
                    selectedMahasiswa = [];
                    renderSelectedMahasiswa();
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Gagal menyimpan jadwal. Silakan coba lagi.");
                }
            });
        });
    });
</script>


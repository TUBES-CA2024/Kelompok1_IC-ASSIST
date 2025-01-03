<?php
use App\Controllers\user\MahasiswaController;

$mahasiswaList = MahasiswaController::viewAllMahasiswa();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Jadwal</h1>

    <!-- Tombol Tambah Jadwal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
        Tambah Jadwal
    </button>

    <!-- Data Table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Stambuk</th>
                <th>Nama Lengkap</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody id="jadwalTableBody">
            <!-- Data jadwal akan ditambahkan di sini -->
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
                        <select class="form-select" id="mahasiswa" required>
                            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                            <?php foreach ($mahasiswaList as $mahasiswa): ?>
                                <option value="<?= $mahasiswa['id'] ?>">
                                    <?= $mahasiswa['stambuk'] ?> - <?= $mahasiswa['nama_lengkap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-secondary mt-2" id="addMahasiswaButton">Tambah</button>
                    </div>
                    <div class="mb-3">
                        <label for="selectedMahasiswa" class="form-label">Mahasiswa Terpilih</label>
                        <ul class="list-group" id="selectedMahasiswaList">
                            <!-- Nama mahasiswa yang dipilih akan muncul di sini -->
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <input type="text" class="form-control" id="ruangan" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mahasiswaDropdown = document.getElementById("mahasiswa");
        const addMahasiswaButton = document.getElementById("addMahasiswaButton");
        const selectedMahasiswaList = document.getElementById("selectedMahasiswaList");
        const addJadwalForm = document.getElementById("addJadwalForm");
        const jadwalTableBody = document.getElementById("jadwalTableBody");

        let selectedMahasiswa = [];
        let rowCounter = 1; // Counter untuk nomor tabel

        // Fungsi untuk merender daftar mahasiswa yang sudah dipilih
        function renderSelectedMahasiswa() {
            selectedMahasiswaList.innerHTML = ""; // Kosongkan daftar sebelum dirender ulang

            selectedMahasiswa.forEach((mahasiswa) => {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item d-flex justify-content-between align-items-center";
                listItem.textContent = mahasiswa.text;

                // Tombol hapus
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

        // Tambahkan mahasiswa ke daftar
        addMahasiswaButton.addEventListener("click", () => {
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

            // Tambahkan ke daftar mahasiswa terpilih
            selectedMahasiswa.push({ id: mahasiswaId, text: mahasiswaText });

            // Render ulang daftar mahasiswa
            renderSelectedMahasiswa();

            // Reset dropdown ke default
            mahasiswaDropdown.selectedIndex = 0;
        });

        // Submit form
        addJadwalForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const ruangan = document.getElementById("ruangan").value;
            const tanggal = document.getElementById("tanggal").value;
            const waktu = document.getElementById("waktu").value;

            if (selectedMahasiswa.length === 0) {
                alert("Pilih setidaknya satu mahasiswa!");
                return;
            }

            const jadwalData = {
                ruangan,
                tanggal,
                waktu,
                mahasiswa: selectedMahasiswa,
            };

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "/path/to/backend/api", // Ubah sesuai URL endpoint backend Anda
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(jadwalData),
                success: (response) => {
                    // Tambahkan data ke tabel jika berhasil
                    selectedMahasiswa.forEach((mahasiswa) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${rowCounter}</td>
                            <td>${mahasiswa.text.split(" - ")[0]}</td>
                            <td>${mahasiswa.text.split(" - ")[1]}</td>
                            <td>${ruangan}</td>
                            <td>${tanggal}</td>
                            <td>${waktu}</td>
                        `;
                        jadwalTableBody.appendChild(row);
                        rowCounter++; // Tingkatkan jumlah baris
                    });

                    // Reset form dan daftar mahasiswa
                    addJadwalForm.reset();
                    selectedMahasiswa = [];
                    renderSelectedMahasiswa();

                    // Tutup modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById("addJadwalModal"));
                    modal.hide();

                    alert("Jadwal berhasil ditambahkan!");
                },
                error: (xhr, status, error) => {
                    console.error("Error:", error);
                    alert("Gagal menyimpan jadwal. Silakan coba lagi.");
                },
            });
        });
    });
</script>

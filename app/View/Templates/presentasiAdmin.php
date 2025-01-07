<?php
use App\Controllers\user\MahasiswaController;
use App\Controllers\presentasi\RuanganController;
$mahasiswaList = MahasiswaController::viewAllMahasiswa();
$ruanganList = RuanganController::viewAllRuangan();
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
        <?php foreach ($mahasiswaList as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['idUser'] ?>" style="cursor: pointer;">
                <td><?= $i ?></td>
                <td>
                    <span data-bs-toggle="modal" data-bs-target="#detailModal" data-nama="<?= $row['nama_lengkap'] ?>"
                        data-stambuk="<?= $row['stambuk'] ?>" data-jurusan="<?= $row['jurusan'] ?>"
                        data-kelas="<?= $row['kelas'] ?>" data-alamat="<?= $row['alamat'] ?>"
                        data-tempat_lahir="<?= $row['tempat_lahir'] ?>" data-notelp="<?= $row['notelp'] ?>"
                        data-tanggal_lahir="<?= $row['tanggal_lahir'] ?>" data-jenis_kelamin="<?= $row['jenis_kelamin'] ?>"
                        data-foto="<?= $row['berkas']['foto'] ?>" data-cv="<?= $row['berkas']['cv'] ?>"
                        data-transkrip="<?= $row['berkas']['transkrip_nilai'] ?>"
                        data-surat="<?= $row['berkas']['surat_pernyataan'] ?>">
                        <?= $row['nama_lengkap'] ?>
                    </span>

                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <div style="display: flex; gap:5%;">
                        <img src="/tubes_web/public/Assets/Img/edit.svg" alt="edit" style="cursor: pointer;">
                        <img src="/tubes_web/public/Assets/Img/delete.svg" alt="delete" style="cursor: pointer;">
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
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
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <!-- Tombol utama -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                        data-bs-target="#downloadOptions" aria-expanded="false" aria-controls="downloadOptions">
                        Unduh Berkas
                    </button>

                    <!-- Tombol-tombol pilihan -->
                    <div class="collapse mt-3" id="downloadOptions">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-sm" id="downloadFotoButton"
                                data-download-url="" target="blank">Unduh Foto</button>
                            <button type="button" class="btn btn-primary btn-sm" id="downloadCVButton"
                                data-download-url="" target="blank">Unduh CV</button>
                            <button type="button" class="btn btn-primary btn-sm" id="downloadTranskripButton"
                                data-download-url="" target="blank">Unduh Transkrip Nilai</button>
                            <button type="button" class="btn btn-primary btn-sm" id="downloadSuratButton"
                                data-download-url="" target="blank">Unduh Surat Pernyataan</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success" id="acceptButton">
                    Accept
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Jadwal</h1>

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
        Tambah Jadwal
    </button>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const table = $('#daftar').DataTable();

        $('#detailModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);

            // Ambil data dari atribut data-*
            const nama = button.data('nama');
            const stambuk = button.data('stambuk');
            const jurusan = button.data('jurusan');
            const kelas = button.data('kelas');
            const alamat = button.data('alamat');
            const tempat_lahir = button.data('tempat_lahir');
            const notelp = button.data('notelp');
            const tanggal_lahir = button.data('tanggal_lahir');
            const jenis_kelamin = button.data('jenis_kelamin');
            const foto = button.data('foto');
            const cv = button.data('cv');
            const transkrip = button.data('transkrip');
            const surat = button.data('surat');

            // Set data ke modal
            $('#modalNama').text(nama);
            $('#modalStambuk').text(stambuk);
            $('#modalJurusan').text(jurusan);
            $('#modalKelas').text(kelas);
            $('#modalAlamat').text(alamat);
            $('#modalTempat_lahir').text(tempat_lahir);
            $('#modalNoTelp').text(notelp);
            $('#modalTanggal_lahir').text(tanggal_lahir);
            $('#modalJenis_kelamin').text(jenis_kelamin);

            $('#modalFoto').attr('src', "/tubes_web/res/imageUser/" + (foto || 'default-image.jpg'));
            $('#modalFoto').attr('alt', `Foto ${nama}`);

            // Set atribut untuk tombol download
            $('#downloadFotoButton').attr('data-download-url', foto ? `/tubes_web/res/imageUser/${foto}` : '#');
            $('#downloadCVButton').attr('data-download-url', cv ? `/tubes_web/res/berkasUser/${cv}` : '#');
            $('#downloadTranskripButton').attr('data-download-url', transkrip ? `/tubes_web/res/berkasUser/${transkrip}` : '#');
            $('#downloadSuratButton').attr('data-download-url', surat ? `/tubes_web/res/berkasUser/${surat}` : '#');
        });

        // Listener untuk tombol download
        $('button[data-download-url]').on('click', function () {
            const url = $(this).data('download-url');
            if (url && url !== '#') {
                window.location.href = url; // Lakukan download
            } else {
                alert('Berkas tidak tersedia.');
            }
        });


        $('#daftar tbody').on('click', 'img[alt="delete"]', function (event) {
            event.stopPropagation(); // Hindari trigger event pada baris tabel
            const id = $(this).closest('tr').data('id'); // Ambil ID mahasiswa dari data-id
            const userid = $(this).closest('tr').data('userid'); // Ambil ID user dari data-userid

            $('#deleteModal') // Simpan data ke modal
                .data('id', id)
                .data('userid', userid)
                .modal('show');
        });

        $('#daftar tbody').on('click', 'img[alt="edit"]', function (event) {
            event.stopPropagation();
            const id = $(this).closest('tr').data('id');
            $('#editModal').data('id', id).modal('show');
        });

        $('#confirmDelete').on('click', function (e) {
            e.preventDefault();
            const userid = $('#deleteModal').data('userid'); // Ambil data-userid dari modal
            console.log(userid); // Untuk debugging

            $.ajax({
                url: '<?= APP_URL ?>/deletemhs',
                type: 'POST',
                data: { id: userid }, // Kirim userid ke server
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Data berhasil dihapus!');
                    } else {
                        alert(response.message);
                        console.log(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('error: ', xhr.responseText);
                    console.error('status: ', status);
                    console.error('error: ', error);
                }
            });
            alert('Berhasil Menghapus Data!');
            $('#deleteModal').modal('hide'); // Tutup modal
            location.reload();
        });
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#editModal').data('id');
            const message = $('#message').val();

            console.log(id, message);
            $.ajax({
                url: '<?= APP_URL ?>/notification',
                type: 'POST',
                data: { id: id, message: message },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                    } else {
                        alert('Gagal mengirim pesan!');
                        console.log(response.message);
                    }
                },
                error: function (xhr, status, error, response) {
                    console.log('error: ', xhr.responseText);
                    console.log('status: ', status);
                    console.log('error : ', error);
                }
            });
            alert('Pesan berhasil dikirim!');
            $('#editModal').modal('hide');

        });

    });

    document.addEventListener("DOMContentLoaded", () => {
        const mahasiswaDropdown = document.getElementById("mahasiswa");
        const addMahasiswaButton = document.getElementById("addMahasiswaButton");
        const selectedMahasiswaList = document.getElementById("selectedMahasiswaList");
        const addJadwalForm = document.getElementById("addJadwalForm");
        const jadwalTableBody = document.getElementById("jadwalTableBody");

        let selectedMahasiswa = [];
        let rowCounter = 1;

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
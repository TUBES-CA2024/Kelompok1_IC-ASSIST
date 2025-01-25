<?php
    use App\Controllers\user\AbsensiUserController;
    use App\Controllers\user\MahasiswaController;
    $absensiList = AbsensiUserController::viewAbsensi();
    $mahasiswaList = MahasiswaController::viewAllMahasiswa();
?>

<style>
    /* Import Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

  

    /* Primary Button */
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

    /* Form Styles */
    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px 15px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3DC2EC;
        box-shadow: 0 0 5px rgba(61, 194, 236, 0.5);
        outline: none;
    }

    .form-select {
        appearance: none;
        background: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%233DC2EC' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E")
            no-repeat right 12px center;
        background-size: 12px 12px;
    }

    .form-control-plaintext {
        background-color: transparent;
        border: none;
        padding: 0;
        color: #555;
        font-size: 1rem;
    }

    .form-control-plaintext:focus {
        border: none;
        outline: none;
    }

    .btn-warning {
        background: linear-gradient(135deg, #FFD54F, #FFC107);
        color: white;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #FFC107, #FFD54F);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
        background: linear-gradient(135deg, #4CAF50, #388E3C);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #388E3C, #4CAF50);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>

<main>
<h1 class="dashboard">Daftar Hadir</h1>
<button type="button" data-bs-toggle="modal" data-bs-target="#addMahasiswaModal" class="btn btn-primary mb-3">
  Tambah Kehadiran Mahasiswa
</button>
<table id="presentasiMahasiswa" class="table table-striped rounded-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Stambuk</th>
            <th>Tes tertulis</th>
            <th>Presentasi</th>
            <th>Wawancara I</th>
            <th>Wawancara II</th>
            <th>Wawancara III</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($absensiList as $row) { ?>
            <tr data-id="<?= $row['id'] ?>" data-userid="<?= $row['id'] ?>">
                <td><?= $i ?></td>
                <td>
                    <span class="open-detail" data-bs-toggle="modal" data-bs-target="#detailAbsensiModal"
                        data-nama="<?= $row['nama_lengkap'] ?>" data-stambuk="<?= $row['stambuk'] ?>"
                        data-absensiwawancarai="<?= $row['absensi_wawancara_I'] ?>" data-absensiwawancaraii="<?= $row['absensi_wawancara_II']?>"
                        data-absensiwawancaraiii="<?= $row['absensi_wawancara_III'] ?>"
                        data-absensitestertulis="<?= $row['absensi_tes_tertulis'] ?>" data-absensipresentasi="<?= $row['absensi_presentasi'] ?>">
                        <?= $row['nama_lengkap'] ?>
                    </span>
                </td>
                <td><?= $row['stambuk'] ?></td>
                <td><?= $row['absensi_tes_tertulis'] ?></td>
                <td><?= $row['absensi_presentasi'] ?></td>
                <td><?= $row['absensi_wawancara_I'] ?></td>
                <td><?= $row['absensi_wawancara_II'] ?></td>
                <td><?= $row['absensi_wawancara_III'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>
</main>

<div class="modal fade" id="addMahasiswaModal" tabindex="-1" aria-labelledby="addJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJadwalModalLabel">Absen Mahasiswa</h5>
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
                        <label for="absensiWawancara1" class="form-label">Wawancara 1</label>
                        <select class="form-select" id="absensiWawancara1" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="absensiWawancara2" class="form-label">Wawancara 2</label>
                        <select class="form-select" id="absensiWawancara2" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="absensiWawancara3" class="form-label">Wawancara 3</label>
                        <select class="form-select" id="absensiWawancara3" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="absensiTesTertulis" class="form-label">Tes Tertulis</label>
                        <select class="form-select" id="absensiTesTertulis" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="absensiPresentasi" class="form-label">Presentasi</label>
                        <select class="form-select" id="absensiPresentasi" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah absensi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailAbsensiModal" tabindex="-1" aria-labelledby="detailAbsensiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailAbsensiModalLabel">Detail Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="mb-3">
                        <label>Nama Lengkap:</label>
                        <span id="detailNama"></span>
                    </div>
                    <div class="mb-3">
                        <label>Stambuk:</label>
                        <span id="detailStambuk"></span>
                    </div>
                    <div class="mb-3">
                        <label>Tes Tertulis:</label>
                        <select name="tesTertulis" id="tesTertulis" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Presentasi:</label>
                        <select name="presentasi" id="presentasi" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Wawancara I:</label>
                        <select name="wawancaraI" id="wawancaraI" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Wawancara II:</label>
                        <select name="wawancaraII" id="wawancaraII" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Wawancara III:</label>
                        <select name="wawancaraIII" id="wawancaraIII" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" id="resetDetailAbsensi" class="btn btn-warning me-2">Reset</button>
                    <button type="button" id="saveDetailAbsensi" class="btn btn-success" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    const mahasiswaSelect = $("#mahasiswa");
    const selectedMahasiswaList = $("#selectedMahasiswaList");
    const addMahasiswaButton = $("#addMahasiswaButton");
    const addJadwalForm = $("#addJadwalForm");

    addMahasiswaButton.on("click", function () {
        const mahasiswaId = mahasiswaSelect.val();
        const selectedOption = mahasiswaSelect.find(":selected");

        if (!mahasiswaId) {
            alert("Silakan pilih mahasiswa terlebih dahulu.");
            return;
        }

        const existingItem = selectedMahasiswaList.children().filter(function () {
            return $(this).data("id") === mahasiswaId;
        });

        if (existingItem.length > 0) {
            alert("Mahasiswa sudah ada di daftar terpilih.");
            return;
        }

        const listItem = $("<li>", {
            class: "list-group-item d-flex justify-content-between align-items-center",
            "data-id": mahasiswaId,
            text: " CCA" + mahasiswaId + " " + selectedOption.text() ,
        });

        const removeButton = $("<button>", {
            class: "btn btn-sm btn-danger",
            text: "Hapus",
            click: function () {
                listItem.remove();
            },
        });

        listItem.append(removeButton);
        selectedMahasiswaList.append(listItem);

        mahasiswaSelect.prop("selectedIndex", 0);
    });

    addJadwalForm.on("submit", function (event) {
        event.preventDefault();

        const mahasiswaTerpilih = selectedMahasiswaList.children().map(function () {
            return $(this).data("id");
        }).get();

        if (mahasiswaTerpilih.length === 0) {
            alert("Silakan tambahkan mahasiswa ke daftar terpilih.");
            return;
        }

        const tanggal = $("#tanggal").val();
        const waktu = $("#waktu").val();
        const wawancara1 = $("#absensiWawancara1").val();
        const wawancara2 = $("#absensiWawancara2").val();
        const wawancara3 = $("#absensiWawancara3").val();
        const tesTertulis = $("#absensiTesTertulis").val();
        const presentasi = $("#absensiPresentasi").val();

        if (!wawancara1 || !wawancara2 || !wawancara3 || !tesTertulis || !presentasi) {
            alert("Silakan lengkapi semua field absensi dan jadwal.");
            return;
        }

        const formData = {
            mahasiswa: mahasiswaTerpilih,
            wawancara1: wawancara1,
            wawancara2: wawancara2,
            wawancara3: wawancara3,
            tesTertulis: tesTertulis,
            presentasi: presentasi
        };
        // console.log(Array.isArray(formData.mahasiswa));
        // console.log( "Mahasiswa : " + formData.mahasiswa);
        // console.log( "Wawancara1 : " + formData.wawancara1);
        // console.log( "Wawancara2 : " + formData.wawancara2);
        // console.log( "Wawancara3 : " + formData.wawancara3);
        // console.log( "Tes Tertulis : " + formData.tesTertulis);
        // console.log( "Presentasi : " + formData.presentasi);

        $.ajax({
            url: "<?= APP_URL ?>/absensi",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(formData),
            success: function (response) {
                if(response.status === 'tes') {
                    console.log(response.message);
                }
                if (response.status === "success") {
                    alert(response.message);
                    
                } else {
                    console.log(response.message)
                    alert(response.message);
                }
            },
        });
    });
    let originalValues = {};
        const saveButton = $("#saveDetailAbsensi");

        $(document).on("click", ".open-detail", function () {
            const nama = $(this).data("nama") || "";
            const stambuk = $(this).data("stambuk") || "";
            const wawancaraI = $(this).data("absensiwawancarai") || "";
            const wawancaraII = $(this).data("absensiwawancaraii") || "";
            const wawancaraIII = $(this).data("absensiwawancaraiii") || "";
            const tesTertulis = $(this).data("absensitestertulis") || "";
            const presentasi = $(this).data("absensipresentasi") || "";

            console.log({ nama, stambuk, wawancaraI, wawancaraII, wawancaraIII, tesTertulis, presentasi });
            $("#detailNama").text(nama);
            $("#detailStambuk").text(stambuk);

            $("#tesTertulis").val(tesTertulis);
            $("#presentasi").val(presentasi);
            $("#wawancaraI").val(wawancaraI);
            $("#wawancaraII").val(wawancaraII);
            $("#wawancaraIII").val(wawancaraIII);

            originalValues = { tesTertulis, presentasi, wawancaraI, wawancaraII, wawancaraIII };
            saveButton.prop("disabled", true);

            $("#detailAbsensiModal").modal("show");
        });

        $("select").on("change", function () {
            const currentValues = {
                tesTertulis: $("#tesTertulis").val(),
                presentasi: $("#presentasi").val(),
                wawancaraI: $("#wawancaraI").val(),
                wawancaraII: $("#wawancaraII").val(),
                wawancaraIII: $("#wawancaraIII").val(),
            };

            const hasChanged = Object.keys(originalValues).some(
                (key) => originalValues[key] !== currentValues[key]
            );

            saveButton.prop("disabled", !hasChanged);
        });

        $("#resetDetailAbsensi").on("click", function () {
            $("#tesTertulis").val(originalValues.tesTertulis);
            $("#presentasi").val(originalValues.presentasi);
            $("#wawancaraI").val(originalValues.wawancaraI);
            $("#wawancaraII").val(originalValues.wawancaraII);
            $("#wawancaraIII").val(originalValues.wawancaraIII);

            saveButton.prop("disabled", true);
        });

        $("#saveDetailAbsensi").on("click", function () {
            alert("Detail absensi berhasil disimpan!");
            $("#detailAbsensiModal").modal("hide");
        });
    });
</script>

<<<<<<< HEAD
<?php
use App\Controllers\user\BiodataUserController;
use App\Controllers\Profile\ProfileController;
$nama = ProfileController::viewBiodata() == null ? "Nama Lengkap" : ProfileController::viewBiodata()["namaLengkap"];
$stambuk = ProfileController::viewUser()["stambuk"];
$jurusan = ProfileController::viewBiodata() == null ? "Jurusan" : ProfileController::viewBiodata()["jurusan"];
$alamat = ProfileController::viewBiodata() == null ? "Alamat" : ProfileController::viewBiodata()["alamat"];
$kelas = ProfileController::viewBiodata() == null ? "kelas" : ProfileController::viewBiodata()["kelas"];
$jenisKelamin = ProfileController::viewBiodata() == null ? "Jenis Kelamin" : ProfileController::viewBiodata()["jenisKelamin"];
$tempatLahir = ProfileController::viewBiodata() == null ? "Tempat Lahir" : ProfileController::viewBiodata()["tempatLahir"];
$tanggalLahir = ProfileController::viewBiodata() == null ? "Tanggal Lahir" : ProfileController::viewBiodata()["tanggalLahir"];
$noHp = ProfileController::viewBiodata() == null ? "No Telephone" : ProfileController::viewBiodata()["noHp"];
?>
<div>
    <h1 class="biodata">Biodata</h1>
</div>
<div class="form-container">

    <?php if(BiodataUserController::isEmpty()) { ?>

    <form id="biodataForm">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
        </div>

        <div class="mb-3">
            <label for="stambuk" class="form-label">Stambuk</label>
            <input type="text" class="form-control" value="<?=$stambuk?>"readonly>
        </div>

        <div>
            <label>Jurusan</label>
            <select class="form-select" aria-label="Default select example" name="jurusan" required>
                <option value="Teknik informatika">Teknik informatika</option>
                <option value="Sistem informasi">Sistem informasi</option>
            </select>
        </div>

        <div class="mb-3">
            <div>
                <label class="form-label">Jenis Kelamin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="wanita" required
                    onclick="updateKelasOptions()">
                <label class="form-check-label" for="inlineRadio1">Wanita</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="pria" required
                    onclick="updateKelasOptions()">
                <label class="form-check-label" for="inlineRadio2">Pria</label>
            </div>
        </div>

        <div class="mb-3 form-floating">
            <select class="form-select" id="floatingSelect" name="kelas" required>

            </select>
            <label for="floatingSelect">Pilih kelas anda</label>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
        </div>
        <div class="mb-3">
            <label for="tempatlahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir"
                required>
        </div>
        <div class="mb-3">
            <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir"
                required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">No Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="submit" value="daftar">Submit</button>
            <button type="reset" class="btn btn-secondary" name="reset" value="batal">Reset</button>
        </div>
    </form>
    
    <?php } else { ?>
=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Biodata</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/biodata.css" />
</head>

<body>
    <div>
        <h1 class="biodata">Biodata</h1>
    </div>
    <div class="container">
        <form>
            <table class="table responsive">
            <table class="table table-bordered border-primary">
                <!-- Baris 1 -->
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Nama Lengkap"></td>
                </tr>
                <!-- Baris 2 -->
                <tr>
                    <td>Jurusan</td>
                    <td>
                        <select class="form-select" aria-label="Default select example" name="jurusan" required>
                            <option value="Teknik_informatika">Teknik informatika</option>
                            <option value="Sistem_informasi">Sistem informasi</option>
                        </select>
                    </td>
                </tr>
                <!-- Baris 3 -->
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="perempuan" required
                                onclick="updateKelasOptions()">
                            <label class="form-check-label" for="inlineRadio1">Perempuan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="laki-laki" required
                                onclick="updateKelasOptions()">
                            <label class="form-check-label" for="inlineRadio2">Laki-Laki</label>
                        </div>
                    </td>
                </tr>
                <!-- Baris 4 -->
                <tr>
                    <td>Pilih Kelas</td>
                    <td>
                        <select class="form-select" id="floatingSelect" name="kelas" required></select>
                    </td>
                </tr>
                <!-- Baris 5 -->
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></td>
                </tr>
                <!-- Baris 6 -->
                <tr>
                    <td>Tempat Lahir</td>
                    <td><input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir" required></td>
                </tr>
                <!-- Baris 7 -->
                <tr>
                    <td>Tanggal Lahir</td>
                    <td><input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required></td>
                </tr>
                <!-- Baris 8 -->
                <tr>
                    <td>No Telepon</td>
                    <td><input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone" required></td>
                </tr>
            </table>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="submit" value="daftar">Submit</button>
                <button type="reset" class="btn btn-secondary" name="reset" value="batal">Reset</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateKelasOptions() {
            const gender = document.querySelector('input[name="gender"]:checked').value;
            const kelasSelect = document.getElementById('floatingSelect');
>>>>>>> 14ec831bb210e5006fbb5e3bd7155b0518d3c482

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" value="<?=$nama?>" readonly>
        </div>

<<<<<<< HEAD
        <div class="mb-3">
            <label for="stambuk" class="form-label">Stambuk</label>
            <input type="text" class="form-control" id="stambuk" value="<?=$stambuk?>" readonly>
        </div>

        <div>
            <label>Jurusan</label>
            <select class="form-select" aria-label="Default select example" name="jurusan">
                <option><?=$jurusan?></option>
            </select>
        </div>

        <div class="mb-3">
            <div>
                <label class="form-label">Jenis Kelamin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" checked disabled>
                <label class="form-check-label" for="inlineRadio1"><?=$jenisKelamin?></label>
            </div>
        </div>

        <div class="mb-3 form-floating">
            <select class="form-select" id="floatingSelect" name="kelas" required>
                <option><?=$kelas?></option>
            </select>
            <label for="floatingSelect">Pilih kelas anda</label>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" value="<?=$alamat?>" readonly>
        </div>
        <div class="mb-3">
            <label for="tempatlahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" value="<?=$tempatLahir?>" readonly>
        </div>
        <div class="mb-3">
            <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" value="<?=$tanggalLahir?>" readonly>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">No Telephone</label>
            <input type="text" class="form-control" value="<?=$noHp?>" readonly>
        </div>
        <?php } ?>
</div>
<script src="/tubes_web/public/Assets/Script/biodata/biodata.js"></script>
=======
            if (gender === 'perempuan') {
                const kelasOptions = ['B1', 'B2', 'B3', 'B4', 'B5'];
                kelasOptions.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    kelasSelect.appendChild(option);
                });
            } else if (gender === 'laki-laki') {
                const kelasOptions = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9'];
                kelasOptions.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    kelasSelect.appendChild(option);
                });
            }
        }
    </script>
</body>

</html>
>>>>>>> 14ec831bb210e5006fbb5e3bd7155b0518d3c482

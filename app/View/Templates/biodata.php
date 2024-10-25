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
            <input type="number" class="form-control" id="stambuk" name="stambuk" placeholder="Stambuk" required>
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

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" value="<?=$nama?>" readonly>
        </div>

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
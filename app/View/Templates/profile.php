
<?php
use App\Controllers\Profile\ProfileController;
 $userName = ProfileController::viewUser()["username"];
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
<div class="profile">
    <div class="form-container"
        style="display: flex; align-items: center; justify-content: space-between; padding: 30px; height: 250px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto; background-color: #fff;">
        <div style="flex: 1; display: flex; justify-content: center; margin">
            <img src="/tubes_web/public/Assets/Img/dummy.jpeg" alt="Profile Picture"
                style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>
        <div style="flex: 2; padding-left: 20px;">
            <p style="font-size: 1rem; margin-bottom: 10px;">Username : <strong><?=$userName; ?></strong></p>
            <p style="font-size: 1rem; margin-bottom: 10px;">NIM : <strong><?=$stambuk; ?></strong></p>
        </div>
        <div class="profile-buttons" style="flex: 1; display: flex; flex-direction: column; align-items: flex-end;">
            <a href="#" data-page="editprofile"><button type="submit" class="btn btn-submit"
                    style="background-color: #007BFF; color: white; padding: 8px 16px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; margin-bottom: 10px; width: 150px;">Edit
                    Profile</button></a>
            <a href="<?php APP_URL . "/login"?>" data-page="logout"><button type="submit" class="btn btn-submit"
                    style="background-color: #FF0000; color: white; padding: 8px 16px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; width: 150px;">Logout
                    </button> <?php session_destroy()?></a>
        </div>
    </div>
</div>

<div class="form-container"
    style="display: flex; flex-direction: column; justify-content: center; padding: 30px; height: 430px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 800px; margin: 0 auto; background-color: #fff; margin-top:1.8rem;">
    <div style="flex: 1; display: flex; flex-wrap: wrap; justify-content: space-between;">
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Nama Lengkap</p>
            <p><strong><?=($nama != null) ? $nama : "" ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">NIM</p>
            <p><strong><?=($stambuk != null) ? $stambuk : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Jurusan</p>
            <p><strong><?=($jurusan != null) ? $jurusan : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Kelas</p>
            <p><strong><?=($kelas != null) ? $kelas : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Alamat</p>
            <p><strong><?=($alamat != null) ? $alamat : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Jenis Kelamin</p>
            <p><strong><?=($jenisKelamin != null) ? $jenisKelamin : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Tempat Lahir</p>
            <p><strong><?=($tempatLahir != null) ? $tempatLahir : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Tanggal Lahir</p>
            <p><strong><?=($tanggalLahir != null) ? $tanggalLahir : ""; ?></strong></p>
        </div>

        <div style="flex: 1 1 45%;">
            <p style="font-size: 1rem;">No Telephone</p>
            <p><strong><?=($noHp != null) ? $noHp : ""; ?></strong></p>
        </div>
    </div>
</div>
</div>
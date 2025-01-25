<?php
use App\Controllers\Profile\ProfileController;
use App\Controllers\user\BerkasUserController;

$userName = ProfileController::viewUser()["username"];
$nama = ProfileController::viewBiodata() == null ? "Nama Lengkap" : ProfileController::viewBiodata()["namaLengkap"];
$stambuk = ProfileController::viewUser()["stambuk"];
$jurusan = ProfileController::viewBiodata() == null ? "Jurusan" : ProfileController::viewBiodata()["jurusan"];
$alamat = ProfileController::viewBiodata() == null ? "Alamat" : ProfileController::viewBiodata()["alamat"];
$kelas = ProfileController::viewBiodata() == null ? "Kelas" : ProfileController::viewBiodata()["kelas"];
$jenisKelamin = ProfileController::viewBiodata() == null ? "Jenis Kelamin" : ProfileController::viewBiodata()["jenisKelamin"];
$tempatLahir = ProfileController::viewBiodata() == null ? "Tempat Lahir" : ProfileController::viewBiodata()["tempatLahir"];
$tanggalLahir = ProfileController::viewBiodata() == null ? "Tanggal Lahir" : ProfileController::viewBiodata()["tanggalLahir"];
$noHp = ProfileController::viewBiodata() == null ? "No Telephone" : ProfileController::viewBiodata()["noHp"];
$photo = "/tubes_web/res/imageUser/" . (BerkasUserController::viewBerkas()["foto"] ?? "default.png");
?>

<div class="profile">
    <div class="form-container"
        style="display: flex; align-items: center; justify-content: space-between; padding: 30px; height: 250px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto; background-color: #fff;">
        <div style="flex: 1; display: flex; justify-content: center;">
            <img src="<?= $photo ?>" alt="Profile Picture"
                style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>
        <div style="flex: 2; padding-left: 20px;">
            <p style="font-size: 1rem; margin-bottom: 10px;">Username: <strong><?= $userName; ?></strong></p>
            <p style="font-size: 1rem; margin-bottom: 10px;">NIM: <strong><?= $stambuk; ?></strong></p>
        </div>
        <div class="profile-buttons" style="flex: 1; display: flex; flex-direction: column; align-items: flex-end;">
            <button type="button" class="btn btn-submit" id="editProfileButton"
                style="background-color: #007BFF; color: white; padding: 8px 16px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; margin-bottom: 10px; width: 150px;">
                Edit Profile
            </button>
            <button id="logoutButton" class="btn btn-submit"
                style="background-color: #FF0000; color: white; padding: 8px 16px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; width: 150px;">
                Logout
            </button>
        </div>
    </div>
</div>

<div class="form-container"
    style="display: flex; flex-direction: column; justify-content: center; padding: 30px; height: auto; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 800px; margin: 0 auto; background-color: #fff; margin-top:1.8rem;">
    <div style="flex: 1; display: flex; flex-wrap: wrap; justify-content: space-between;">
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Nama Lengkap</p>
            <p><strong><?= $nama; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">NIM</p>
            <p><strong><?= $stambuk; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Jurusan</p>
            <p><strong><?= $jurusan; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Kelas</p>
            <p><strong><?= $kelas; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Alamat</p>
            <p><strong><?= $alamat; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Jenis Kelamin</p>
            <p><strong><?= $jenisKelamin; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Tempat Lahir</p>
            <p><strong><?= $tempatLahir; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">Tanggal Lahir</p>
            <p><strong><?= $tanggalLahir; ?></strong></p>
        </div>
        <div style="flex: 1 1 45%; margin-bottom: 15px;">
            <p style="font-size: 1rem;">No Telephone</p>
            <p><strong><?= $noHp; ?></strong></p>
        </div>
    </div>
</div>

<div id="editProfileModal" class="modal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div class="modal-content"
        style="background: #fff; padding: 20px; border-radius: 10px; max-width: 500px; width: 100%; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        <h2>Edit Profile</h2>
        <form id="editProfileForm">
            <div style="margin-bottom: 15px;">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= $nama; ?>"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="jurusan">Jurusan</label>
                <select id="jurusan" name="jurusan"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="Teknik Informatika" <?= $jurusan === 'Teknik Informatika' ? 'selected' : ''; ?>>Teknik
                        Informatika</option>
                    <option value="Sistem Informasi" <?= $jurusan === 'Sistem Informasi' ? 'selected' : ''; ?>>Sistem
                        Informasi</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></select>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= $alamat; ?>"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="jenisKelamin">Jenis Kelamin</label>
                <select id="jenisKelamin" name="jenisKelamin"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="Pria" <?= $jenisKelamin === "Pria" ? "selected" : ""; ?>>Pria</option>
                    <option value="Wanita" <?= $jenisKelamin === "Wanita" ? "selected" : ""; ?>>Wanita</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="tempatLahir">Tempat Lahir</label>
                <input type="text" id="tempatLahir" name="tempatLahir" value="<?= $tempatLahir; ?>"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="tanggalLahir">Tanggal Lahir</label>
                <input type="date" id="tanggalLahir" name="tanggalLahir" value="<?= $tanggalLahir; ?>"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="noHp">No Telephone</label>
                <input type="text" id="noHp" name="noHp" value="<?= $noHp; ?>"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <button type="submit"
                style="background: #007BFF; color: #fff; padding: 10px 15px; border: none; border-radius: 5px;">Save
                Changes</button>
            <button type="button" id="closeModal"
                style="background: #FF0000; color: #fff; padding: 10px 15px; border: none; border-radius: 5px; margin-left: 10px;">Cancel</button>
        </form>
    </div>
</div>

<script>
    const appUrl = "/tubes_web/public/";

    $(document).ready(function () {
        $('#editProfileButton').click(function () {
            $('#editProfileModal').css('display', 'flex');
            updateKelasOptions(); 
        });

        $('#closeModal').click(function () {
            $('#editProfileModal').css('display', 'none');
        });

        $(window).click(function (event) {
            if ($(event.target).is('#editProfileModal')) {
                $('#editProfileModal').css('display', 'none');
            }
        });

        $('#jenisKelamin').on('change', function () {
            updateKelasOptions();
        });

        $('#logoutButton').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: appUrl + 'logout',
                type: 'POST',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message || 'Logout berhasil');
                        window.location.href = appUrl;
                    } else {
                        alert(response.message || 'Logout gagal');
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });

        $('#editProfileForm').submit(function (e) {
            e.preventDefault();

            const formData = {
                nama: $('#nama').val(),
                jurusan: $('#jurusan').val(),
                kelas: $('#kelas').val(),
                alamat: $('#alamat').val(),
                jenisKelamin: $('#jenisKelamin').val(),
                tempatLahir: $('#tempatLahir').val(),
                tanggalLahir: $('#tanggalLahir').val(),
                noHp: $('#noHp').val()
            };

            console.log("Form Data:", formData);

            $.ajax({
                url: appUrl + 'updatebiodata',
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message || 'Data berhasil diperbarui');
                        window.location.reload(); 
                    } else {
                        alert("data berhasil diperbarui");
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });

        function updateKelasOptions() {
            const gender = document.getElementById('jenisKelamin').value;
            const kelasSelect = document.getElementById('kelas');

            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

            const kelasOptions = gender === 'Perempuan'
                ? ['B1', 'B2', 'B3', 'B4', 'B5', 'B6'] 
                : ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9']; 
            kelasOptions.forEach(kelas => {
                const option = document.createElement('option');
                option.value = kelas;
                option.textContent = kelas;
                kelasSelect.appendChild(option);
            });
        }
    });
</script>

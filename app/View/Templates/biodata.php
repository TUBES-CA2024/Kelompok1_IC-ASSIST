
    <div>
        <h1 class="biodata">Biodata</h1>
    </div>
    <div class="form-container">
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
                <option value="Teknik_informatika">Teknik informatika</option>
                <option value="Sistem_informasi">Sistem informasi</option>
            </select>
        </div>

        <div class="mb-3">
            <div>
                <label class="form-label">Jenis Kelamin</label>
            </div>
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
            <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir" required>
        </div>
        <div class="mb-3">
            <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">No Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="submit" value="daftar">Submit</button>
            <button type="reset" class="btn btn-secondary" name="reset" value="batal">Reset</button>
        </div>
    </div>
    <script>
        function updateKelasOptions() {
            const gender = document.querySelector('input[name="gender"]:checked').value;
            const kelasSelect = document.getElementById('floatingSelect');

            kelasSelect.innerHTML = '';

            if (gender === 'perempuan') {
                const kelasOptions = ['B1', 'B2', 'B3', 'B4', 'B5'];
                kelasOptions.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    kelasSelect.appendChild(option);
                });
            } else if (gender === 'laki-laki') {
                const kelasOptions = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6','A7','A8','A9'];
                kelasOptions.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    kelasSelect.appendChild(option);
                });
            }
        }
    </script>

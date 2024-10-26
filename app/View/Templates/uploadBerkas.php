<main>
    <h2 class="berkas">Upload Berkas</h2>
    <div class="form-container" style="max-width: 1000px; height: 500px; padding: 20px; margin: 0 auto;">
        <form style="padding:10px" id="berkasForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class="form-label">Masukkan Foto 3x4</label>
                <input class="form-control" type="file" id="foto" name="foto" required>
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">Masukkan CV</label>
                <input class="form-control" type="file" id="cv" name="cv" required>
            </div>

            <div class="mb-3">
                <label for="transkrip" class="form-label">Masukkan Transkrip Nilai</label>
                <input class="form-control" type="file" id="transkrip" name="transkrip" required>
            </div>

            <div class="mb-3">
                <label for="suratpernyataan" class="form-label">Masukkan Surat Pernyataan</label>
                <input class="form-control" type="file" id="suratpernyataan" name="suratpernyataan" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-submit" style="margin-top:90px;">Submit</button>
            </div>
        </form>
    </div>

    <div class="recent-judul">
        <h2 class="tahapan-presentasi">
            Hasil submit Berkas
        </h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Abstract</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>cnn</td>
                    <td class="danger">revisi</td>
                    <td>17-10-2024 - 19-12-2024</td>
                    <td><a href="#">download</a></td>
                    <td>gk ngerti AI SOK SOK PAKE DEEP LEARNING</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>binary tree</td>
                    <td class="success">diterima</td>
                    <td>17-10-2024 - 19-12-2024</td>
                    <td><a href="#">download</a></td>
                    <td>Silahkan submit ppt dan makalahnya!</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<script src="/tubes_web/public/Assets/Script/user/berkas.js"></script>

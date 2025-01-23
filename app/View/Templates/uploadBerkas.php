<?php
use App\Controllers\User\BerkasUserController;
$result = BerkasUserController::viewBerkas();
$isAcc = $result['is_Accepted'] ?? '';
?>

<main>
    <h1 class="biodata">Upload Berkas</h1>
    <div class="form-container" style="max-width: 1000px; height: 500px; padding: 20px; margin: 0 auto;">
        <form style="padding:10px" id="berkasForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class="form-label">Masukkan Foto 3x4</label>
                <input class="form-control" type="file" id="foto" name="foto" required
                       <?php if ($isAcc) echo 'disabled'; ?>>
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">Masukkan CV</label>
                <input class="form-control" type="file" id="cv" name="cv" required
                       <?php if ($isAcc) echo 'disabled'; ?>>
            </div>

            <div class="mb-3">
                <label for="transkrip" class="form-label">Masukkan Transkrip Nilai</label>
                <input class="form-control" type="file" id="transkrip" name="transkrip" required
                       <?php if ($isAcc) echo 'disabled'; ?>>
            </div>

            <div class="mb-3">
                <label for="suratpernyataan" class="form-label">Masukkan Surat Pernyataan</label>
                <input class="form-control" type="file" id="suratpernyataan" name="suratpernyataan" required
                       <?php if ($isAcc) echo 'disabled'; ?>>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-submit" style="margin-top:90px;"
                        <?php if ($isAcc) echo 'disabled'; ?>>Submit</button>
            </div>
        </form>
    </div>
</main>

<script src="/tubes_web/public/Assets/Script/user/berkas.js"></script>

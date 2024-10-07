<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="/tubes_web/public/Assets/Style/uploadberkas.css" />
  </head>
  <body>
  <h2 class="berkas">Upload Berkas</h2>
    <div class="form-container">
        <form>
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
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/tubes_web/public/Assets/Style/presentasi.css" />
</head>

<body>
    <main>

    <div>
    <h2 class="presentasi">Presentasi</h2>
    <div class="form-container">
        
        <form>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul" required>
            </div>
            <div class="mb-3">
                <label for="abstract" class="form-label">Masukkan Abstract Makalah</label>
                <input class="form-control" type="file" id="abstract" name="abstract" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>
    </div>
    <div class="recent-judul">
      <h2 class="tahapan-presentasi">
        Hasil submit judul presentasi
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
            <td>Silahkan submit ppt dan  makalahnya!</td>
          </tr>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
use App\Controllers\exam\ExamController;
$allSoal = ExamController::viewAllSoal();
?>
<h1>Daftar Soal</h1>
<!-- Button Tambah Soal -->
<button type="button" data-bs-toggle="modal" data-bs-target="#addSoalModal" class="btn btn-primary mb-3">
    Tambah Soal
</button>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Deskripsi</th>
            <th>Gambar Soal</th>
            <th>Pilihan</th>
            <th>Jawaban</th>
        </tr>
    </thead>
    <tbody id="soalTableBody">
        <?php $i = 1; ?>
        <?php foreach ($allSoal as $soal): ?>
            <tr class="soal-row" 
                data-id="<?= $soal['id'] ?>" 
                data-deskripsi="<?= htmlspecialchars($soal['deskripsi']) ?>" 
                data-gambar="<?= htmlspecialchars($soal['gambar']) ?>" 
                data-pilihan="<?= htmlspecialchars($soal['pilihan']) ?>" 
                data-jawaban="<?= htmlspecialchars($soal['jawaban']) ?>">
                <td><?= $i++ ?></td>
                <td><?= $soal['deskripsi'] ?></td>
                <td>
                    <?php if (!empty($soal['gambar'])): ?>
                        <img src="/tubes_web/public/Assets/Img/soal/<?= htmlspecialchars($soal['gambar']) ?>" 
                             alt="soal.png" 
                             style="width: 4cm; height: 3cm;">
                    <?php else: ?>
                        Bukan Gambar Soal
                    <?php endif; ?>
                </td>
                <td><?= $soal['pilihan'] ?></td>
                <td><?= $soal['jawaban'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="addSoalModal" tabindex="-1" aria-labelledby="addSoalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addSoalForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="addSoalModalLabel">Tambah Soal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Deskripsi Soal -->
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
          </div>

          <!-- Upload Gambar -->
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Soal</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
          </div>

          <!-- Radio Button Pilihan Tipe Jawaban -->
          <div class="mb-3">
            <label class="form-label">Tipe Jawaban</label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipeJawaban" id="pilihanGanda" value="pilihan_ganda" checked>
              <label class="form-check-label" for="pilihanGanda">Pilihan Ganda</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipeJawaban" id="textBox" value="textbox">
              <label class="form-check-label" for="textBox">Textbox</label>
            </div>
          </div>

          <!-- Input Pilihan Ganda -->
          <div id="pilihanGandaInput" class="mb-3">
            <label for="pilihan" class="form-label">Pilihan</label>
            <textarea class="form-control" id="pilihan" name="pilihan" placeholder="Pisahkan dengan koma, contoh: A,B,C,D"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Detail/Edit Soal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
        <p><strong>Gambar Soal:</strong> <br><img id="modalGambar" src="" alt="Gambar Soal" style="max-width: 100%;"></p>
        <p><strong>Pilihan:</strong> <span id="modalPilihan"></span></p>
        <p><strong>Jawaban:</strong> <span id="modalJawaban"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editButton">Edit Soal</button>
        <button type="button" class="btn btn-danger" id="deleteButton">Hapus Soal</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    // Handle row click
    $(".soal-row").on("click", function () {
        const id = $(this).data("id");
        const deskripsi = $(this).data("deskripsi");
        const gambar = $(this).data("gambar");
        const pilihan = $(this).data("pilihan");
        const jawaban = $(this).data("jawaban");

        $("#modalDeskripsi").text(deskripsi);
        $("#modalGambar").attr("src", gambar ? "/tubes_web/public/Assets/Img/soal/" + gambar : "");
        $("#modalPilihan").text(pilihan);
        $("#modalJawaban").text(jawaban);

        $("#editButton").data("id", id);
        $("#deleteButton").data("id", id);

        $("#detailModal").modal("show");
    });

    // Handle radio button change in add modal
    $('input[name="tipeJawaban"]').on("change", function () {
        if ($(this).val() === "pilihan_ganda") {
            $("#pilihanGandaInput").show();
            $("#textBoxInput").hide();
            $("#jawabanTextBox").prop("disabled", true);
        } else {
            $("#pilihanGandaInput").hide();
            $("#textBoxInput").show();
        }
    });

    // Handle tambah soal form
    $("#addSoalForm").on("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '<?= APP_URL ?>/addsoal',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Soal berhasil ditambahkan!');
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                console.error('Error:', xhr.responseText);
            }
        });

        $('#addSoalModal').modal('hide');
    });

    // Handle delete soal
    $("#deleteButton").on("click", function () {
        const id = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus soal ini?")) {
            $.ajax({
                url: '<?= APP_URL ?>/deletesoal',
                type: 'POST',
                data: { id },
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Soal berhasil dihapus!');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });

            $('#detailModal').modal('hide');
        }
    });

    // Handle edit soal (redirect to edit page or modal form)
    $("#editButton").on("click", function () {
        const id = $(this).data("id");
        window.location.href = `/tubes_web/public/soal/edit/${id}`;
    });
});
</script>

<?php
use App\Controllers\exam\ExamController;
use App\Controllers\exam\SoalController;
$allSoal = ExamController::viewAllSoal();
$years = SoalController::getYears();
?>

<style>
  <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

  .table-hover {
    background-color: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    margin-top: 20px;
    font-size: 0.95rem;
  }

  .table-hover th,
  .table-hover td {
    padding: 16px 20px;
    text-align: left;
    color: #555;
  }

  .table-hover th {
    background-color: #3DC2EC;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
  }

  .table-hover tr:nth-child(odd) {
    background-color: #f8faff;
  }

  .table-hover tr:nth-child(even) {
    background-color: #e8f4fc;
  }

  .table-hover tr:hover {
    background-color: rgba(61, 194, 236, 0.2);
    cursor: pointer;
  }

  .rounded-table {
    border-radius: 12px;
    overflow: hidden;
  }

  .btn-primary {
    background: linear-gradient(135deg, #3DC2EC, #3392cc);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #3392cc, #3DC2EC);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
  }

  .btn-primary:focus {
    outline: none;
  }

  .btn-danger {
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-danger:hover {
    background-color: #c82333;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  /* Modal Styles */
  .modal-content {
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    font-family: 'Poppins', sans-serif;
  }

  .modal-header {
    background: linear-gradient(135deg, #3DC2EC, #3392cc);
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
    padding: 20px;
  }

  .modal-header h5 {
    font-size: 1.5rem;
    font-weight: 600;
  }

  .modal-body {
    padding: 20px;
    color: #555;
  }

  .modal-footer {
    border-top: none;
    padding: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  /* Form Inputs */
  .form-control {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px 15px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }

  .form-control:focus {
    border-color: #3DC2EC;
    box-shadow: 0 0 5px rgba(61, 194, 236, 0.5);
    outline: none;
  }

  .form-check-input:checked {
    background-color: #3DC2EC;
    border-color: #3DC2EC;
  }

  .form-check-label {
    font-size: 0.95rem;
    color: #555;
  }

  #soalListContainer {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    max-height: 300px;
    overflow-y: hidden;
    overflow-x: auto;
    padding: 10px;
  }

  .soal-item {
    min-width: 200px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }
</style>

<main>
  <h1 class="dashboard">Tes Tertulis</h1>
  <button type="button" data-bs-toggle="modal" data-bs-target="#addSoalModal" class="btn btn-primary mb-3">
    Tambah Soal
  </button>
  <div id="year-buttons" class="mb-3">
    <?php if (!empty($years)): ?>
      <?php foreach ($years as $year): ?>
        <button class="btn btn-primary year-btn" data-year="<?= $year; ?>">
          <?= $year; ?>
        </button>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Tidak ada data tahun.</p>
    <?php endif; ?>
  </div>

  <div id="action-buttons" class="mb-3">
    <button id="updateSelected" class="btn btn-success">Update</button>
    <button id="deleteSelected" class="btn btn-danger">Delete</button>
  </div>

  <table class="table table-hover rounded-table">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Deskripsi</th>
        <th>Tipe Jawaban</th>
        <th>Pilihan</th>
        <th>Jawaban</th>
      </tr>
    </thead>
    <tbody id="soalTableBody">
    </tbody>
  </table>


  <div class="modal fade" id="addSoalModal" tabindex="-1" aria-labelledby="addSoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addSoalForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="addSoalModalLabel">Tambah Soal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="deskripsi" class="form-label"><b>Deskripsi</b></label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label"><b>Tipe Jawaban</b></label><br>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="tipeJawaban" id="pilihanGanda" value="pilihan_ganda"
                  checked>
                <label class="form-check-label" for="pilihanGanda">Pilihan Ganda</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="tipeJawaban" id="textBox" value="textbox">
                <label class="form-check-label" for="textBox">Textbox</label>
              </div>
            </div>

            <div id="pilihanGandaInput" class="mb-3">
              <label for="pilihan" class="form-label"><b>Pilihan</b></label>
              <textarea class="form-control" id="pilihan" name="pilihan"
                placeholder="Pisahkan dengan koma, contoh: A,B,C,D"></textarea>
            </div>

            <div id="jawabanGandaInput" class="mb-3">
              <label for="jawaban" class="form-label"><b>Jawaban</b></label>
              <textarea class="form-control" id="jawaban" name="jawaban"
                placeholder="Masukkan jawaban yang benar dari pilihan"></textarea>
            </div>

            <div id="soalListContainer"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="addSoalButton">Tambah Soal</button>
            <button type="submit" class="btn btn-primary" id="submitAllSoalButton">Kirim semua soal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
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


    function showModal(message, gifUrl = null) {
      const modal = document.getElementById('customModal');
      if (!modal) {
        return;
      }
      const modalMessage = document.getElementById('modalMessage');
      const modalGif = document.getElementById('modalGif');
      const closeModal = document.getElementById('closeModal');

      modalMessage.textContent = message;
      modalGif.style.display = gifUrl ? 'block' : 'none';
      if (gifUrl) modalGif.src = gifUrl;

      modal.style.display = 'flex';

      $(closeModal).off('click').on('click', function () {
        modal.style.display = 'none';
      });

      $(window).off('click').on('click', function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    }

    function showConfirm(message, onConfirm = null, onCancel = null) {
      const modal = document.getElementById('confirmModal');
      if (!modal) {
        return;
      }
      const modalMessage = document.getElementById('confirmModalMessage');
      const confirmButton = document.getElementById('confirmModalConfirm');
      const cancelButton = document.getElementById('confirmModalCancel');

      modalMessage.textContent = message;
      modal.style.display = 'flex';

      $(confirmButton).off('click').on('click', function () {
        if (onConfirm) onConfirm();
        modal.style.display = 'none';
      });

      $(cancelButton).off('click').on('click', function () {
        if (onCancel) onCancel();
        modal.style.display = 'none';
      });

      $(window).off('click').on('click', function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    }
    function loadSoal(year) {
      $.ajax({
        url: '<?= APP_URL ?>/getallsoal',
        type: 'POST',
        data: { year: year },
        dataType: 'json',
        success: function (response) {
          let tableBody = $('#soalTableBody');
          tableBody.empty();
          if (response.allSoal && response.allSoal.length > 0 && response.tstatus === 'success') {
            console.log(response.id);
            response.allSoal.forEach((row, index) => {
              tableBody.append(`
            <tr class="soal-row" data-id="${window.selectedDbId}" data-deskripsi="${row.deskripsi}" data-pilihan='${JSON.stringify(row.pilihan)}' data-jawaban="${row.jawaban}">
              <td>${index + 1}</td>
              <td>${row.deskripsi}</td>
              <td>${row.tipeJawaban}</td>
              <td>${row.pilihan}</td>
              <td>${row.jawaban}</td>
            </tr>
          `);
            });
          } else {
            tableBody.append(`
          <tr>
            <td colspan="5">Tidak ada data soal untuk tahun ${year}</td>
          </tr>
        `);

            console.log("error : ", response.message);
          }
          $("#updateSelected").data("id", response.id);
          $("#deleteSelected").data("id", response.id);
        },
        error: function (xhr, status, error) {
          console.error('AJAX error:', error);
        }
      });
    }
    $("#updateSelected").on("click", function () {
      const id = $(this).data("id");
      if (!id) {
        alert("Data soal belum dimuat atau tidak ditemukan.");
        return;
      }
      console.log("Update data untuk id: ", id);
      $("#updateSoalId").val(id);
      $.ajax({
        url: '<?= APP_URL ?>/updatesoaljson',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
          if (response.status === 'success') {
            showModal(response.message || "Soal Berhasil di aktifkan", '/tubes_web/public/Assets/gif/success.gif');
          } else {
            showModal('Gagal memuat data soal: ' + response.message, '/tubes_web/public/Assets/gif/failed.gif');
          }
        },
        error: function (xhr) {
          console.error('Error:', xhr.responseText);
        }
      })
      $("#updateSoalModal").modal("show");
    });

    $("#deleteSelected").on("click", function () {
      const id = $(this).data("id");

      if (!id) {
        alert("Data soal belum dimuat atau tidak ditemukan.");
        return;
      }

      // Gunakan showConfirm untuk menampilkan modal konfirmasi
      showConfirm("Apakah Anda yakin ingin menghapus soal ini?", function () {
        // Fungsi ini akan dieksekusi jika pengguna menekan tombol 'Confirm'
        console.log("Delete data untuk id: ", id);

        $.ajax({
          url: '<?= APP_URL ?>/deletesoaljson',
          type: 'POST',
          data: { id: id },
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              showModal('Soal berhasil dihapus!', '/tubes_web/public/Assets/gif/success.gif');
              document.querySelector('a[data-page="tesTulis"]').click();
            } else {
              showModal('Soal gagal dihapus: ' + response.message, '/tubes_web/public/Assets/gif/failed.gif');
            }
          },
          error: function (xhr) {
            console.error('Error:', xhr.responseText);
          }
        });
      }, function () {
      });
    });


    let currentYear = new Date().getFullYear();
    console.log("currentYear: ", currentYear);
    loadSoal(currentYear);

    $('.year-btn').on('click', function () {
      let selectedYear = $(this).data('year');
      loadSoal(selectedYear);
    });


    $('#soalTableBody').on('click', '.soal-row', function () {
      const id = $(this).data("id");
      const deskripsi = $(this).data("deskripsi");
      let pilihan = $(this).data("pilihan");
      const jawaban = $(this).data("jawaban");

      console.log("id : ", id);
      try {
        const parsedPilihan = JSON.parse(pilihan);
        if (Array.isArray(parsedPilihan)) {
          pilihan = parsedPilihan.join(", ");
        }
      } catch (err) {
        console.warn("Gagal mengurai nilai pilihan, gunakan nilai asli:", err);
      }

      $("#modalDeskripsi").text(deskripsi);
      $("#modalPilihan").text(pilihan);
      $("#modalJawaban").text(jawaban);

      $("#editButton").data("id", id);
      $("#deleteButton").data("id", id);

      $("#detailModal").modal("show");
    });

    $('input[name="tipeJawaban"]').on("change", function () {
      if ($(this).val() === "pilihan_ganda") {
        $("#pilihanGandaInput").show();
        $("#jawabanGandaInput").show();
        $("#textAnswerInput").hide();
      } else if ($(this).val() === "textbox") {
        $("#pilihanGandaInput").hide();
        $("#jawabanGandaInput").hide();
        $("#textAnswerInput").show();
      }
    });

    if ($('input[name="tipeJawaban"]:checked').val() === "pilihan_ganda") {
      $("#pilihanGandaInput").show();
      $("#jawabanGandaInput").show();
      $("#textAnswerInput").hide();
    } else {
      $("#pilihanGandaInput").hide();
      $("#jawabanGandaInput").hide();
      $("#textAnswerInput").show();
    }

    let soalArray = [];
    function renderSoals() {
      const soalListContainer = $("#soalListContainer");
      soalListContainer.empty();
      soalArray.forEach((soal, index) => {
        const soalElement = `
      <div class="soal-item">
        <h5>Soal ${index + 1}:</h5>
        <p><strong>Deskripsi:</strong> ${soal.deskripsi}</p>
        <p><strong>Tipe Jawaban:</strong> ${soal.tipeJawaban}</p>
        ${soal.tipeJawaban === 'pilihan_ganda' ?
            `<p><strong>Pilihan:</strong> ${soal.pilihan}</p>
           <p><strong>Jawaban:</strong> ${soal.jawaban}</p>` : ''}
        <hr>
      </div>
    `;
        soalListContainer.append(soalElement);
      });
    }
    $('#addSoalButton').on('click', function () {
      const soal = {};
      soal.deskripsi = $("#deskripsi").val();
      soal.tipeJawaban = $('input[name="tipeJawaban"]:checked').val();
      soal.pilihan = $("#pilihan").val();
      soal.jawaban = $("#jawaban").val();

      if (soal.deskripsi === '' || soal.tipeJawaban === '') {
        showModal('Deskripsi dan tipe jawaban harus diisi');
        return;
      }
      if (soal.tipeJawaban === 'pilihan_ganda' && (soal.pilihan === '' || soal.jawaban === '')) {
        showModal('Pilihan dan jawaban harus diisi');
        return;
      }

      soalArray.push(soal);
      console.log("Soal yang ditambahkan: ", soal);
      console.log("Semua soal yang telah ditambahkan: ", soalArray);
      renderSoals();
      $('#addSoalForm')[0].reset();
    });

    $("#submitAllSoalButton").on("click", function (e) {
      if (soalArray.length === 0) {
        showModal('Tidak ada soal yang ditambahkan');
        return;
      }
      $.ajax({
        url: '/tubes_web/public/addingsoal',
        type: 'POST',
        data: JSON.stringify({ soals: soalArray }),
        contentType: 'application/json',
        success: function (response) {
          if (response.status === 'success') {
            showModal('Soal berhasil ditambahkan!', '/tubes_web/public/Assets/gif/success.gif');
            soalArray = [];
            $('#addSoalForm')[0].reset();
            renderSoals();
            document.querySelector('a[data-page="tesTulis"]').click();
          } else {
            showModal(response.message || 'Soal gagal ditambahkan', '/tubes_web/public/Assets/gif/failed.gif');
          }
        },
        error: function (xhr) {
          console.error('Error:', xhr.responseText);
        }
      });
      $('#addSoalModal').modal('hide');
    });
  });


</script>
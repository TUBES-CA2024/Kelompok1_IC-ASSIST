<?php

use App\Controllers\Exam\NilaiAkhirController;
$nilai = NilaiAkhirController::getAllNilaiAkhirMahasiswa();
?>
<main>

<h1 class="dashboard">Daftar Nilai</h1>
<table id="daftar-nilai" class="table table-striped rounded-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stambuk</th>
            <th>Nilai Tes tertulis</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($nilai as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <button class="btn nama-button" data-id="<?= htmlspecialchars($value['id'] ?? '') ?>"
                        data-nama="<?= htmlspecialchars($value['nama_lengkap'] ?? 'Tidak ada nama') ?>"
                        data-stambuk="<?= htmlspecialchars($value['stambuk'] ?? 'Tidak ada stambuk') ?>"
                        data-nilai="<?= htmlspecialchars($value['nilai'] ?? 'Tidak ada nilai') ?>">
                        <?= htmlspecialchars($value['nama_lengkap'] ?? 'Tidak ada nama') ?>
                    </button>
                </td>
                <td><?= htmlspecialchars($value['stambuk'] ?? 'Tidak ada stambuk') ?></td>
                <td><?= htmlspecialchars($value['nilai'] ?? 'Tidak ada nilai') ?></td>
            </tr>
            <?php
            $i++;
        endforeach; ?>
    </tbody>
</table>
</main>

<!-- Custom Modal -->
<div id="customModal" class="custom-modal hidden">
    <div class="custom-modal-content">
        <span id="closeModal" class="close-modal">&times;</span>
        <h2>Detail Mahasiswa</h2>
        <p><strong>Nama:</strong> <span id="modalNama">Tidak ada data</span></p>
        <p><strong>Stambuk:</strong> <span id="modalStambuk">Tidak ada data</span></p>
        <p><strong>Nilai Tes Tertulis:</strong> <span id="modalNilai">Tidak ada data</span></p>
        <div id="soalJawaban" style="margin-top: 20px;">
            <h5>Soal dan Jawaban</h5>
            <ul id="soalJawabanList"></ul>
        </div>
    </div>
</div>

<style>
    .custom-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .custom-modal.hidden {
        display: none;
    }

    .custom-modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 50%;
        max-height: 80%;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function () {
        $('.nama-button').on('click', function (e) {
            e.preventDefault();

            const id = $(this).data('id');
            const nama = $(this).data('nama') || 'Tidak ada data';
            const stambuk = $(this).data('stambuk') || 'Tidak ada data';
            const nilai = $(this).data('nilai') || 'Tidak ada data';

            console.log("ID:", id);
            $('#modalNama').text(nama);
            $('#modalStambuk').text(stambuk);
            $('#modalNilai').text(nilai);

            // AJAX untuk fetch soal dan jawaban
            $.ajax({
                url: '<?= APP_URL ?>/getsoaljawaban',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' && response.data.length > 0) {
                        let soalJawabanHTML = '';
                        response.data.forEach(item => {
                            soalJawabanHTML += `
                            <li><strong>Soal:</strong> ${item.deskripsi} 
                            <br>
                            <strong> pilihan: </strong> ${item.pilihan}
                            <br>
                            <strong>Jawaban benar :</strong> ${item.jawaban}
                            <strong>Jawaban User  :</strong> ${item.jawaban_user} 
                            <br>
                            </li>`;
                        });
                        $('#soalJawabanList').html(soalJawabanHTML);
                    } else {
                        const message = response.message || 'Tidak ada data soal dan jawaban.';
                        $('#soalJawabanList').html(`<li>${message}</li>`);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching soal dan jawaban:', error);
                    $('#soalJawabanList').html('<li>Error saat mengambil data.</li>');
                }
            });

            // Tampilkan modal
            $('#customModal').removeClass('hidden');
        });

        // Tutup modal
        $('#closeModal').on('click', function () {
            $('#customModal').addClass('hidden');
        });

        // Tutup modal jika klik di luar konten
        $('#customModal').on('click', function (e) {
            if ($(e.target).is('#customModal')) {
                $('#customModal').addClass('hidden');
            }
        });
    });
</script>

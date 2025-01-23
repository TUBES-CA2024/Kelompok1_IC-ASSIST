<?php
use App\Controllers\presentasi\RuanganController;
$ruanganList = RuanganController::viewAllRuangan();

?>
<main>
<h1 class="dashboard">Ruangan</h1>

<table class="table table-striped table-bordered" style="table-layout: auto; width: 100%; text-align: left;">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
            </tr>
        </thead>
        <tbody id="jadwalTableBody">
            <?php $i = 1; ?>
            <?php foreach ($ruanganList as $ruangan) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $ruangan['nama'] ?></td>
                </tr>
                <?php $i++; ?>
            <?php } ?>
        </tbody>
    </table>
</main>

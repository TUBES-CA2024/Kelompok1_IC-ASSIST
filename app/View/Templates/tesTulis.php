<style>

.exam-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.exam-container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.exam-container p {
    color: #555;
    line-height: 1.6;
    margin-bottom: 15px;
    text-align: justify;
}

.exam-container ul {
    list-style: none; 
    margin-left: 20px;
    margin-bottom: 20px;
}

.exam-container li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    color: #444;
}

.exam-container li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 6px;
    width: 8px;
    height: 8px;
    background-color: #3DC2EC; 
    border-radius: 50%; 
}

.exam-container button {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #3DC2EC;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.exam-container button:hover {
    background-color: #45a049;
}

.exam-container b {
    color: #333;
    .exam-container input[type="text"] {
    display: block;
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

.exam-container input[type="text"]:focus {
    border-color: #3DC2EC;
    outline: none;
    box-shadow: 0 0 5px rgba(61, 194, 236, 0.5);
}

.exam-container .error {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
}

}

</style>
<main>
<h1 class="dashboard">Tes Tertulis</h1>
<div class="exam-container">
    <h2>Test Exam</h2>
    <p>Pada tahap kali ini kalian akan melaksanakan ujian pilihan ganda.</p>
    <p>Tata tertib sebelum ujian meliputi:</p>
    <ul>
        <li><b>Dilarang menghadap kiri kanan. Silahkan fokus di komputernya saja</b></li>
        <li><b>Bila membutuhkan sesuatu silahkan angkat tangannya dan panggil asistennya</b></li>
        <li><b>Kerjakan dengan jujur</b></li>
    </ul>
    <p>Ujian kali ini memiliki durasi waktu <b>80 Menit</b>. Sebelum dimulai dipersilahkan untuk membaca doa terlebih dahulu.</p>
   
    <strong><label for="nomorMeja" class="form-label">Masukkan nomor meja anda untuk memulai ujian</label></strong>
    <input type="text" id="nomorMeja" class = "form-control" placeholder="Masukkan nomor meja Anda" />
    <div id="errorMessage" class="error"></div>
    <button id="startTestButton" style="margin-top: 10px;">Start Test</button>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  try {
    console.log("Inisialisasi tombol...");
    $('#startTestButton').on('click', function () {
      console.log("Tombol Start Test diklik.");
      const nomorMejaInput = $('#nomorMeja').val().trim();

      if (!nomorMejaInput || isNaN(nomorMejaInput) || parseInt(nomorMejaInput) <= 0) {
        $('#errorMessage').text('Nomor meja tidak valid!');
        return;
      }

      $('#errorMessage').text('');
      const targetURL = `${APP_URL}/soal?nomorMeja=${encodeURIComponent(nomorMejaInput)}`;
      console.log("Redirecting to:", targetURL);
      window.location.href = targetURL;
    });
  } catch (error) {
    console.error("Terjadi error saat inisialisasi:", error);
  }
});

</script>





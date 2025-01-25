$(document).ready(function() {
    $('#berkasPresentasiForm').submit(function(e) {
        e.preventDefault(); 

        $.ajax({
            url: '/tubes_web/public/judul', // Endpoint untuk #berkasPresentasiForm
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil disimpan');
                    window.location.href = '/tubes_web/public/';
                } else {
                    alert(response.message || 'Data gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $('#presentasiFormAccepted').on('submit', function (e) {
        e.preventDefault(); 
    
        var formData = new FormData(this); 
    
        $.ajax({
            url: '/tubes_web/public/presentasi', // Endpoint untuk memproses file
            type: 'POST',
            data: formData,
            processData: false, // Jangan ubah data menjadi string query
            contentType: false, // Jangan atur Content-Type
            dataType: 'json', // Harapkan respons JSON dari server
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message || 'Berkas berhasil disimpan');
                    window.location.href = '/tubes_web/public/';
                } else {
                    alert(response.message || 'Berkas gagal disimpan');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });    
});

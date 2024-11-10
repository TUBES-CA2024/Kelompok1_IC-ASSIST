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

    // Handler untuk form #presentasiFormAccepted
    $('#presentasiFormAccepted').submit(function(e) {
        e.preventDefault(); // Mencegah pengiriman default

        // Kirim data form sebagai FormData object (untuk file upload)
        var formData = new FormData(this);
        $.ajax({
            url: '/tubes_web/public/presentasi', // Endpoint untuk #presentasiFormAccepted
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Jangan proses data
            contentType: false, // Jangan atur header Content-Type
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Berkas berhasil disimpan');
                    window.location.href = '/tubes_web/public/';
                } else {
                    alert(response.message || 'Berkas gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                console.log('status:' + status );
                console.log('error:' + error );
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
});

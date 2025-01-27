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
            url: '/tubes_web/public/presentasi', 
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json', 
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

$(document).ready(function() {
    $('#berkasForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log("Data lagi di process");
        $.ajax({
            url: '/tubes_web/public/berkas',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Berkas berhasil disimpan');
                    window.location.href = '/tubes_web/public/';
                } else {
                    alert(response.message || 'Berkas gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error Status:', status);
                console.log('Error Details:', error);
                console.log('Server Response:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
            
        });
    });
});
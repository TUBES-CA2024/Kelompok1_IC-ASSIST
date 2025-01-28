$(document).ready(function() {
    $('#berkasForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log('Data Foto:', formData.get('foto'));
    console.log('Data CV:', formData.get('cv'));
    console.log('Data Transkrip:', formData.get('transkrip'));
    console.log('Data Surat Pernyataan:', formData.get('suratpernyataan'));
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
                    showModal("Berkas berhasil disimpan", "/tubes_web/public/Assets/gif/success.gif");
                    window.location.href = '/tubes_web/public/';
                } else {
                    showModal("Berkas gagal disimpan", "/tubes_web/public/Assets/gif/failed.gif");
                    console.log(response.message);
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
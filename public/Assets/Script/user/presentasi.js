$(document).ready(function() {
    $('#presentasiForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/tubes_web/public/judul',
            type: 'POST',
            data: $('#presentasiForm').serialize(),
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
        }); $('#berkasPresentasiForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/tubes_web/public/presentasi',
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
                    console.log('Error:', xhr.responseText + " " + status + " " + error);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
    });

});
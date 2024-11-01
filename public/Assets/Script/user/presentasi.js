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
        });
    });
});
$('#logoutButton').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'tubes_web/public/logout', // URL endpoint untuk logout
        type: 'POST', // Pastikan method sesuai dengan route
        success: function(response) {
            // Cek status logout, lalu arahkan ke halaman login jika sukses
            if (response.status === 'success') {
                alert(response.message || 'Logout berhasil');
                window.location.href = 'tubes_web/public/login';
            } else {
                alert(response.message || 'Logout gagal');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', xhr.responseText);
            alert('Terjadi kesalahan: ' + error);
        }
    });
});

function loadPage(page) {
    $.ajax({
        url: APP_URL + '/' + page, // Sesuaikan dengan BASEURL yang sudah didefinisikan
        method: 'GET',
        success: function(response) {
            $('#content').html(response); // Ganti konten dinamis di div #content
        },
        error: function() {
            $('#content').html('<p>Error: Gagal memuat halaman.</p>');
        }
    });
}

$(document).ready(function() {
    $('#sidebar a').click(function(e) {
        e.preventDefault(); // Mencegah refresh halaman

        var page = $(this).data('page'); // Ambil nilai dari data-page
        console.log(page);
        loadPage(page); // Panggil fungsi AJAX untuk memuat halaman
    });
});

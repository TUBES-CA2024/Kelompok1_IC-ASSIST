let btn = document.getElementById('btn');
let sidebar = document.querySelector('.sidebar');
let user = document.querySelector('.user');

btn.onclick = function(){
    sidebar.classList.toggle('active');
    user.classList.add('active');
    user.classList.toggle('active');
};

$(document).ready(function() {
    // Tangkap klik dari sidebar
    $('.sidebar a').click(function(e) {
        e.preventDefault(); // Mencegah refresh halaman
        
        var page = $(this).attr('href'); // Ambil URL dari href (misalnya /load/dashboard)

        // AJAX untuk memuat konten secara dinamis
        $.ajax({
            url: page, // Gunakan URL href sebagai endpoint
            method: 'GET',
            success: function(response) {
                // Tampilkan respons di #content
                $('#content').html(response);
            },
            error: function() {
                $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
            }
        });
    });
});

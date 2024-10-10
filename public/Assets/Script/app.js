$(document).ready(function() {
    $('.sidebar a').click(function(e) {
        e.preventDefault();  // Cegah reload halaman

        var page = $(this).data('page');  // Ambil nilai dari data-page
        console.log("Memuat halaman:", page);

        // AJAX request untuk memuat konten dinamis
        $.ajax({
            url: APP_URL + '/' + page,
            method: 'GET',
            success: function(response) {
                $('#content').html(response);  // Masukkan konten ke div #content
                console.log("Konten berhasil dimuat");
            },
            error: function() {
                $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
            }
        });
    });
});

$(document).ready(function() {
  $('.profile a').click(function(e) {
      e.preventDefault();  // Cegah reload halaman

      var page = $(this).data('page');  // Ambil nilai dari data-page
      console.log("Memuat halaman:", page);

      // AJAX request untuk memuat konten dinamis
      $.ajax({
          url: APP_URL + '/' + page,
          method: 'GET',
          success: function(response) {
              $('#content').html(response);  // Masukkan konten ke div #content
              console.log("Konten berhasil dimuat");
          },
          error: function() {
              $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
          }
      });
  });
});

// footer
var lastScrollTop = 0;
window.addEventListener("scroll", function () {
  var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
  if (currentScroll > lastScrollTop) {
    document.getElementById('footer').classList.remove('show-footer');
  } else {
    document.getElementById('footer').classList.add('show-footer');
  }
  lastScrollTop = currentScroll;
});
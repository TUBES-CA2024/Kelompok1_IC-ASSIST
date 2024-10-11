$(document).ready(function() {
  $('.sidebar a, .profile a, .dashboard a').click(function(e) {
    e.preventDefault();  

    var page = $(this).data('page'); 
    console.log("Memuat halaman:", page);

    $.ajax({
      url: APP_URL + '/' + page,
      method: 'GET',
      success: function(response) {
        $('#content').html(response);
        console.log("Konten berhasil dimuat"); 
      },
      error: function() {
        $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
      }
    });
  });
});

var lastScrollTop = 0;
var scrollTimeout;

window.addEventListener("scroll", function () {
  if (scrollTimeout) {
    clearTimeout(scrollTimeout);
  }

  scrollTimeout = setTimeout(function () {
    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    var scrollHeight = document.documentElement.scrollHeight;
    var clientHeight = document.documentElement.clientHeight;

    if (currentScroll > lastScrollTop) {
      document.getElementById('footer').classList.remove('show-footer');
    } else {
      document.getElementById('footer').classList.add('show-footer');
    }

    if (currentScroll + clientHeight >= scrollHeight - 10) {
      document.getElementById('footer').classList.add('show-footer');
    }

    lastScrollTop = currentScroll;
  }, 100);  
});

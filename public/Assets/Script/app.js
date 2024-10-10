$(document).ready(function() {
  // Combine sidebar and profile links for AJAX content loading
  $('.sidebar a, .profile a').click(function(e) {
    e.preventDefault();  // Prevent default link behavior

    var page = $(this).data('page');  // Get data-page attribute
    console.log("Memuat halaman:", page);

    // AJAX request to dynamically load content
    $.ajax({
      url: APP_URL + '/' + page,
      method: 'GET',
      success: function(response) {
        $('#content').html(response);  // Insert content into #content div
        console.log("Konten berhasil dimuat");

    
        initializeModals();  
      },
      error: function() {
        $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
      }
    });
  });
});

// Function to reinitialize modals (and potentially other Bootstrap components)
function initializeModals() {
  $('[data-bs-toggle="modal"]').click(function() {
    var target = $(this).data('bs-target');
    $(target).modal('show');
  });
}

// Debounced Scroll Event for Footer Visibility
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
      // Hide footer on scroll down
      document.getElementById('footer').classList.remove('show-footer');
    } else {
      // Show footer on scroll up
      document.getElementById('footer').classList.add('show-footer');
    }

    // Always show footer if near the bottom of the page
    if (currentScroll + clientHeight >= scrollHeight - 10) {
      document.getElementById('footer').classList.add('show-footer');
    }

    lastScrollTop = currentScroll;
  }, 100);  // Adjust the debounce delay (100ms) as needed
});

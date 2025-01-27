function showModal(message, gifUrl = null) {
  const modal = document.getElementById('customModal');
  const modalMessage = document.getElementById('modalMessage');
  const modalGif = document.getElementById('modalGif');
  const closeModal = document.getElementById('closeModal');

  modalMessage.textContent = message;

  if (gifUrl) {
      modalGif.src = gifUrl;
      modalGif.style.display = 'block';
  } else {
      modalGif.style.display = 'none';
  }

  modal.style.display = 'flex';

  closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
  });

  window.addEventListener('click', (event) => {
      if (event.target === modal) {
          modal.style.display = 'none';
      }
  });
}


$(document).ready(function () {
  $('.sidebar a, .profile a, .dashboard a').on('click', function (e) {
    if (this.id === "startTestButton") return; 
    e.preventDefault();

    var page = $(this).data('page');
    if (!page) {
      console.error("Data page tidak ditemukan pada elemen ini:", this);
      return;
    }

    console.log("Memuat halaman:", page);

    $.ajax({
      url: `${APP_URL}/${page}`, 
      method: 'GET',
      success: function (response) {
        $('#content').html(response);
        console.log("Konten berhasil dimuat");
      },
      error: function (xhr, status, error) {
        console.error("Error saat memuat konten:", error);
        $('#content').html('<p>Error: Halaman tidak ditemukan.</p>');
      },
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

      var footer = document.getElementById('footer');
      if (!footer) {
        console.warn("Footer tidak ditemukan dalam dokumen.");
        return;
      }

      if (currentScroll > lastScrollTop) {
        footer.classList.remove('show-footer');
      } else {
        footer.classList.add('show-footer');
      }

      if (currentScroll + clientHeight >= scrollHeight - 10) {
        footer.classList.add('show-footer');
      }

      lastScrollTop = currentScroll;
    }, 100); 
  });

  $('#startTestButton').on('click', function () {
    const nomorMejaInput = $('#nomorMeja').val().trim();

    if (!nomorMejaInput || isNaN(nomorMejaInput) || parseInt(nomorMejaInput) <= 0) {
      $('#errorMessage').text('Nomor meja tidak valid!');
      return;
    }

    $('#errorMessage').text(''); 

    const targetURL = `${APP_URL}/soal?nomorMeja=${encodeURIComponent(nomorMejaInput)}`;
    window.location.href = targetURL;
  });
});


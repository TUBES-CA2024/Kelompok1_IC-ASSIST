const telephoneInput = document.getElementById("telephone");
const tempatLahirInput = document.getElementById("tempatlahir");
const namaInput = document.getElementById("nama");

function showModal(message, gifUrl = null) {
  const modal = document.getElementById("customModal");
  const modalMessage = document.getElementById("modalMessage");
  const modalGif = document.getElementById("modalGif");
  const closeModal = document.getElementById("closeModal");

  modalMessage.textContent = message;

  if (gifUrl) {
    modalGif.src = gifUrl;
    modalGif.style.display = "block";
  } else {
    modalGif.style.display = "none";
  }

  modal.style.display = "flex";

  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
}
function validatePhoneNumber(phoneNumber) {
  const phoneRegex = /^(?:\+62|62|0)(8[1-9][0-9]{6,9})$/;

  if (!phoneRegex.test(phoneNumber)) {
    return {
      success: false,
      message:
        "Format nomor telepon tidak valid. Harus diawali dengan +62, 62, atau 0 dan diikuti oleh angka 8.",
    };
  }

  return { success: true, message: "Nomor telepon valid." };
}

function validateNoNumber(input) {
  const noNumberRegex = /^[^0-9]*$/;

  if (!noNumberRegex.test(input)) {
    return {
      success: false,
      message: "Input tidak valid: Nama tidak boleh mengandung angka.",
    };
  }

  return { success: true, message: "Input valid: Tidak ada angka." };
}

$(document).ready(function () {
  // Logout Button
  $("#logoutButton").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "/tubes_web/public/logout",
      type: "POST",
      success: function (response) {
        if (response.status === "success") {
          showModal(
            response.message || "Logout berhasil",
            "/tubes_web/public/Assets/gif/success.gif",
            () => {
              window.location.href = "/tubes_web/public";
            }
          );
        } else {
          showModal(
            response.message || "Logout gagal",
            "/tubes_web/public/Assets/gif/failed.gif"
          );
        }
      },
      error: function (xhr, status, error) {
        console.log("Error:", xhr.responseText);
        showModal(
          "Terjadi kesalahan: " + error,
          "/tubes_web/public/Assets/gif/failed.gif"
        );
      },
    });
  });

  $("#editProfileForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "/tubes_web/public/updatebiodata",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showModal(
            "Biodata berhasil diperbarui",
            "/tubes_web/public/Assets/gif/success.gif"
          );
          document.querySelector('a[data-page="profile"]').click();
        } else {
          showModal(
            "Biodata gagal diperbarui",
            "/tubes_web/public/Assets/gif/failed.gif"
          );
        }
        document.querySelector('a[data-page="profile"]').click();
      },
      error: function (xhr, status, error) {
        console.log("Error:", xhr.responseText);
        showModal(
          "Terjadi kesalahan: " + error,
          "/tubes_web/public/Assets/gif/failed.gif"
        );
      },
    });
  });
  telephoneInput.addEventListener("input", function () {
    telephoneInput.setCustomValidity("");
    telephoneInput.reportValidity();
  });

  namaInput.addEventListener("input", function () {
    namaInput.setCustomValidity("");
    namaInput.reportValidity();
  });
  tempatLahirInput.addEventListener("input", function () {
    tempatLahirInput.setCustomValidity("");
    tempatLahirInput.reportValidity();
  });
  
  $("#biodataForm").submit(function (e) {
    e.preventDefault();
    console.log($("#biodataForm").serialize());

    const phoneNumber = document.getElementById("telephone").value;
    const tempatLahir = document.getElementById("tempatlahir").value;
    const nama = document.getElementById("nama").value;

    let isValid = true;

    if (!validatePhoneNumber(phoneNumber).success) {
      telephoneInput.setCustomValidity(
        validatePhoneNumber(phoneNumber).message
      );
      telephoneInput.reportValidity();
      isValid = false;
    }

    if (!validateNoNumber(tempatLahir).success) {
      tempatLahirInput.setCustomValidity(validateNoNumber(tempatLahir).message);
      tempatLahirInput.reportValidity();
      isValid = false;
    }

    if (!validateNoNumber(nama).success) {
      namaInput.setCustomValidity(validateNoNumber(nama).message);
      namaInput.reportValidity();
      isValid = false;
    }

    $.ajax({
      url: "tubes_web/public/store",
      type: "post",
      data: $("#biodataForm").serialize(),
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showModal(
            "Biodata berhasil disimpan",
            "/tubes_web/public/Assets/gif/success.gif"
          );
          document.querySelector('a[data-page="biodata"]').click();
        } else {
          showModal(
            response.message || "Biodata gagal disimpan",
            "/tubes_web/public/Assets/gif/failed.gif"
          );
          console.log(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error:", xhr.responseText);
        showModal(
          "Terjadi kesalahan: " + error,
          "/tubes_web/public/Assets/gif/failed.gif"
        );
      },
    });
  });
});

// Fungsi Update Pilihan Kelas Berdasarkan Gender
function updateKelasOptions() {
  const genderElement = document.querySelector('input[name="gender"]:checked');

  if (!genderElement) return; // Hindari error jika tidak ada input gender

  const gender = genderElement.value;
  const kelasSelect = document.getElementById("floatingSelect");

  kelasSelect.innerHTML = ""; // Hapus opsi lama

  let kelasOptions = [];

  if (gender === "wanita") {
    kelasOptions = ["B1", "B2", "B3", "B4", "B5"];
  } else if (gender === "pria") {
    kelasOptions = ["A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9"];
  }

  kelasOptions.forEach((kelas) => {
    const option = document.createElement("option");
    option.value = kelas;
    option.text = kelas;
    kelasSelect.appendChild(option);
  });
}


$(document).ready(function() {
    
    
    $('#logoutButton').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '/tubes_web/public/logout', 
            type: 'POST',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Logout berhasil');
                    window.location.href = '/tubes_web/public';
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

    $('#editProfileForm').submit(function(e) {
        e.preventDefault();
                $.ajax({
            url: '/tubes_web/public/updatebiodata',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil diperbarui');
                    window.location.reload();
                } else {
                    alert(response.message || 'Data gagal diperbarui');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
});

$(document).ready(function() {
    $('#biodataForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'tubes_web/public/store',
            type: 'POST',
            data: $('#biodataForm').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil disimpan');
                    window.location.href = 'tubes_web/public/';
                } else {
                    alert(response.message || 'Data gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                alert('Data Berhasil disimpan: ');
            }
        });
    });
    $('#biodataForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'tubes_web/public/store',
            type: 'POST',
            data: $('#biodataForm').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil disimpan');
                    window.location.href = 'tubes_web/public/';
                } else {
                    alert(response.message || 'Data gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                alert('Data Berhasil disimpan: ');
            }
        });
    });
});
$(document).ready(function() {
    $('#biodataForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'tubes_web/public/store',
            type: 'POST',
            data: $('#biodataForm').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil disimpan');
                } else {
                    alert(response.message || 'Data gagal disimpan');
                }
            },
            error: function(xhr, status, error) {
                alert('Data Berhasil disimpan: ');
            }
        });
    });
});
function updateKelasOptions() {
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const kelasSelect = document.getElementById('floatingSelect');

    kelasSelect.innerHTML = '';

    if (gender === 'wanita') {
        const kelasOptions = ['B1', 'B2', 'B3', 'B4', 'B5'];
        kelasOptions.forEach(kelas => {
            const option = document.createElement('option');
            option.value = kelas;
            option.text = kelas;
            kelasSelect.appendChild(option);
        });
    } else if (gender === 'pria') {
        const kelasOptions = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9'];
        kelasOptions.forEach(kelas => {
            const option = document.createElement('option');
            option.value = kelas;
            option.text = kelas;
            kelasSelect.appendChild(option);
        });
    }
}

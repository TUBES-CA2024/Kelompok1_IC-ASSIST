$('#logoutButton').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= APP_URL ?>/logout',
        type: 'POST',
        success: function() {
            window.location.href = '<?= APP_URL ?>/login';
        },
        error: function(xhr, status, error) {
            alert('Logout failed: ' + error);
        }
    });
});
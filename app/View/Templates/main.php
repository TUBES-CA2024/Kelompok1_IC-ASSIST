<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Page Application</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="content">
        <?php include 'sidebar.php'?>
    </div>
    <script>
        const APP_URL = '<?php echo APP_URL; ?>'; // Ambil APP_URL dari PHP
    </script>
    <script src="/tubes_web/public/Assets/Script/app.js"></script>
</body>

</html>
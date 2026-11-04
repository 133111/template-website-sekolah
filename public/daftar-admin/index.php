<?php
define("BASE_URL", "/school-dashboard-template");
include_once __DIR__ . '/../../controllers/daftar-admin/daftarAdmin-config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar-Admin</title>
    <?php include_once __DIR__ . '/../../components/main-frame/header.php';?> <!-- call header component -->
</head>
<body>
    <!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../../components/main-frame/frame-grid.php';?>
    <div class="container-mainContent">
        <div className="main">
            
        </div>
    </div>
<script src="../../js/sorotan.js"></script>
</body>
</html>
<?php
define("BASE_URL", "/school-dashboard-template");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>
    <?php include_once __DIR__ . '/../../components/main-frame/header.php';?> <!-- call header component -->
</head>
<body>
<!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../../components/main-frame/frame-grid.php';?>
    <?= "<h1>Hello World</h1>"; ?>

<script src="../../js/sorotan.js"></script>
</body>
</html>
<?php
    session_start();
    require 'config/database.php';
    $_SESSION['From'] = 'index';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Home</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    
</body>
</html>









<!-- check list
    - type
    - reservation
    - display reservation in admin side and user sides
-->
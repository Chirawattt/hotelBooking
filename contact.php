<?php
    session_start();
    require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Add Type</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?> 
    
    <div class="ml-[200px] mt-10 " >
        <p class="text-black text-[50px]"><span class="text-[55px] text-amber-200">Contact</span> us</p>
        <p class="mt-5 text-[30px]">You can follow us on these channels:</p>
        <div class="mt-10 flex items-center text-[20px]">
            <i class="fas fa-hotel fa-3x"></i>
            <p class="ml-5">Location</p>
            <p class="ml-5">431 Chareonraj Rd.,Faham sub-district,Chiang Mai City, Chiang Mai 50000,Thailand</p>
        </div>
        <div class="mt-10 flex items-center text-[20px]">
            <i class="fas fa-phone fa-3x"></i>
            <p class="ml-5">Telefone Number</p>
            <p class="ml-5">(+66)-55-555-5555</p>
        </div>
        <div class="mt-10 flex items-center text-[20px]">
            <i class="fas fa-envelope fa-3x"></i>
            <p class="ml-5">Email Address</p>
            <p class="ml-5">hotelbooking@gmail.com</p>
        </div>
        <div class="mt-10 flex items-center">
            <p>Follow us on other channels:</p>
            <i class="fa-brands fa-facebook text-[30px] ml-2"></i>
            <i class="fa-brands fa-instagram text-[30px] ml-2"></i>
            <i class="fa-brands fa-line text-[30px] ml-2"></i>
        </div>
    </div>

    
</body>
</html>

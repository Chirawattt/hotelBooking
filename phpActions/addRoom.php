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
    <title>Add Room</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include 'includes/navbar.php'; ?>
    <!-- sub bar -->
    <?php include 'includes/subbar.php'; ?>
    <!-- title -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">เพิ่มห้องพัก</h1>
    </div>
    <!-- main content -->
    <!-- form to add room -->
    <div class="flex items-center justify-center mt-5">
        <form action="includes/addRoomData.php" method="post" class="w-1/2 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="roomName">
                    ชื่อห้องพัก
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="roomName" id="roomName" type="text" placeholder="ชื่อห้องพัก">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="numberOfGuest">
                    จำวนวนผู้เข้าพัก
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="numberOfGuest" id="numberOfGuest" type="number" placeholder="จำนวนผู้เข้าพักสูงสุด">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="price">
                    ราคาห้องพัก/คืน
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="price" id="price" type="number" placeholder="ราคา">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
                    hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group">
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-3">เพิ่มห้องพัก</span>
                </button>
            </div>
        </form>
    </div>


</body>
</html>
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
    <?php include 'includes/navbar.php'; ?>

    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">เพิ่มประเภทของห้องพัก</h1>
    </div>
    <!-- main content -->
    <!-- form to add room -->
    <div class="flex items-center justify-center mt-5">
        <form action="phpActions/addTypeCheck.php" method="post" class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="typeName" class="text-sm">ชื่อประเภทห้องพัก</label>
                    <input type="text" name="typeName" id="typeName" class="w-full p-2 border border-gray-300 rounded mt-1" autofocus>
                </div>
                <div>
                    <button type="submit" name="addType" class="w-full py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-all duration-300 ease-in-out">เพิ่มประเภท</button>
                </div>
                <div class="flex items-center justify-center mt-3">
                    <a href="javascript:history.back()" class="flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-all duration-300 ease-in-out">
                        <i class="fas fa-chevron-left"></i>
                        <span>ย้อนกลับ</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
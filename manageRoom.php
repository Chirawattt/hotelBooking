<?php
    session_start();
    require 'config/database.php';

    $sql = "SELECT * FROM room";
    $result = mysqli_query($conn, $sql);
    $roomsData = [];
    while ($rooms = mysqli_fetch_array($result)) {
        $roomsData[] = Array(
            'id' => $rooms['id'],
            'name' => $rooms['name'],
            'number_of_guest' => $rooms['number_of_guest'],
            'price' => $rooms['price'],
            'status' => $rooms['status'],
            'create_at' => $rooms['create_at']
        );
    }

    global $roomData;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Manage Room</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include 'includes/navbar.php'; ?>
    <!-- sub bar -->
    <?php include 'includes/subbar.php'; ?>
    <!-- title -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">จัดการห้องพัก</h1>
    </div>
    <!-- main content -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto max-w-screen-xl mt-6">
        <!-- add button -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        รหัสห้องพัก
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ชื่อห้องพัก
                    </th>
                    <th scope="col" class="px-6 py-3">
                        จำนวนผู้เข้าพักสูงสุด
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ราคา/คืน
                    </th>
                    <th scope="col" class="px-6 py-3">
                        สถานะ
                    </th>
                    <th scope="col" class="px-6 py-3">
                        จัดการข้อมูล
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($roomsData as $room) {
                        $roomData = $room;
                        include 'includes/manageRoomData.php';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- add button -->
    <div class="flex items-center justify-center mt-5">
        <a href="addRoom.php" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
            hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group">
            <i class="fa-solid fa-plus"></i>
            <span class="ms-3">เพิ่มห้องพัก</span>
        </a>
    </div>
</body>
</html>
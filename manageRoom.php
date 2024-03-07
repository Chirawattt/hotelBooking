<?php
    session_start();
    require 'config/database.php';
    $_SESSION['form'] = 'basePath';

    $sql = "SELECT room.id, room.name, type_room.name as type, room.detail, room.facility,
    room.max_people, room.price, room.status, room.img, room.create_at FROM room 
    INNER JOIN type_room ON room.type_id = type_room.id 
    ORDER BY CAST(room.id AS UNSIGNED) ASC";
    $result = mysqli_query($conn, $sql);
    $roomsData = [];
    while ($rooms = mysqli_fetch_array($result)) {
        $roomsData[] = Array(
            'id' => $rooms['id'],
            'name' => $rooms['name'],
            'type' => $rooms['type'], 
            'detail' => $rooms['detail'],
            'facility' => $rooms['facility'],
            'max_people' => $rooms['max_people'],
            'price' => $rooms['price'],
            'status' => $rooms['status'],
            'create_at' => $rooms['create_at']
        );
    }
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
    <?php include 'includes/subbar.php'; ?>
    <!-- title -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">จัดการห้องพัก</h1>
    </div>
    <!-- main content -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto max-w-screen-xl mt-6">
        <!-- add button -->
        <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-normal">
                <tr>
                    <th scope="col" class="w-1/8 py-3 pl-5 text-center">
                        รหัส
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        ชื่อห้องพัก
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        ประเภทห้องพัก
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        สิ่งอำนวยความสะดวก
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        จำนวนคนสูงสุด
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        ราคา/คืน
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        สถานะ
                    </th>
                    <th scope="col" class="w-1/8 py-3 text-center">
                        จัดการข้อมูล
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roomsData as $room) { ?>
                    <tr class="bg-white dark:bg-gray-800 text-sm">
                        <td class="w-1/8 py-3 pl-5 text-center">
                            <p><?php echo $room['id']; ?></p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <p><?php echo $room['name']; ?></p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <p><?php echo $room['type']; ?></p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <p><?php echo $room['facility']; ?></p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <p><?php echo $room['max_people']; ?></p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <p><?php echo $room['price']; ?>฿</p>
                        </td>
                        <td class="w-1/8 px-3 py-4 text-center">
                            <?php $status = $room['status']; ?>
                            <?php if ($status == 'available') { 
                                echo "<p class='font-semibold text-green-500'>ว่าง</p>";
                            } else { 
                                echo "<p class='font-semibold text-red-500'>ติดจอง</p>"; }?>
                        </td>
                        <td class="w-1/8 px-3 py-4 flex flex-col justify-center items-center">
                            <a href="viewRoom.php?id=<?php echo $room['id']; ?>" class="text-gray-500 hover:text-amber-400 transition-all
                            duration-300 ease-in-out justify-center group">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="editRoom.php?id=<?php echo $room['id']; ?>" class="text-gray-500 hover:text-amber-400 transition-all 
                            duration-300 ease-in-out justify-center group">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a href="deleteRoom.php?id=<?php echo $room['id']; ?>" class="text-gray-500 hover:text-amber-400 transition-all 
                            duration-300 ease-in-out justify-center group">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
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
<?php
    session_start();
    require 'config/database.php';

    $roomId = $_GET['id'];
    $sql = "SELECT room.id, room.name, type_room.name as type, room.detail, room.facility,
    room.max_people, room.price, room.status, room.img, room.create_at FROM room 
    INNER JOIN type_room ON room.type_id = type_room.id where room.id = $roomId";
    $result = mysqli_query($conn, $sql);
    $room = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>View Room <?php echo $room['id'] ?></title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/subbar.php'; ?>
    <!-- title -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">ข้อมูลห้องพัก</h1>
    </div>
    <!-- main content -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto max-w-screen-xl mt-6">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-700">ห้องพัก <?php echo $room['name'] ?></h1>
                <a href="editRoom.php?id=<?php echo $room['id'] ?>" class="flex items-center justify-center 
                px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    <i class="fas fa-edit"></i>
                    <span class="ml-2">แก้ไข</span>
                </a>
            </div>
            <div class="flex flex-col items-center justify-center mt-4">
                <?php $roomImg = $room['img'] ?>
                <?php if ($roomImg != null){
                    echo "<img src='./assets/photos/$roomImg' alt='room' class='w-1/2 h-1/2 object-cover rounded-md'>
                            <p>$roomImg</p>";
                    }else {
                        echo "<p>ไม่มีรูปภาพ</p>";
                }  ?>
            </div>
            <div class="mt-4">
                <p class="text-gray-700 px-2 py-1">ประเภทห้องพัก: <?php echo $room['type'] ?></p>
                <p class="text-gray-700 px-2 py-1">จำนวนคนสูงสุด: <?php echo $room['max_people'] ?></p>
                <p class="text-gray-700 px-2 py-1">ราคา/คืน: <?php echo $room['price'] ?></p>
                <p class="text-gray-700 px-2 py-1">สถานะ: <?php echo $room['status'] ?></p>
                <p class="text-gray-700 px-2 py-1">วันที่สร้าง: <?php echo $room['create_at'] ?></p>
                <p class="text-gray-700 px-2 py-1">สิ่งอำนวยความสะดวก: <?php echo $room['facility'] ?></p>
                <p class="text-gray-700 px-2 py-1">รายละเอียดห้องพัก: <?php echo $room['detail'] ?></p>
            </div>
        </div>
    </div>
    <!-- back button -->
    <div class="flex items-center justify-center mt-4 pb-6">
        <a href="javascript:history.back()" class="flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-all duration-300 ease-in-out">
            <i class="fas fa-chevron-left"></i>
            <span>ย้อนกลับ</span>
        </a>
    </div>

</body>
</html>
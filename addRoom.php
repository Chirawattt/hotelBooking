<?php
    session_start();
    require 'config/database.php';

    $sql = "SELECT * FROM type_room";
    $result = mysqli_query($conn, $sql);
    $typesData = [];
    while ($type = mysqli_fetch_array($result)) {
        $typesData[] = $type;
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
    <title>Add Room</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">เพิ่มห้องพัก</h1>
    </div>
    <!-- main content -->
    <!-- form to add room -->
    <div class="flex items-center justify-center mt-5">
        <form action="phpActions/addRoomCheck.php" method="post" enctype="multipart/form-data" class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="roomName" class="text-sm">ชื่อห้องพัก</label>
                    <input type="text" name="roomName" id="roomName" class="w-full p-2 border border-gray-300 rounded mt-1" autofocus>
                </div>
                <!-- div for select type of room -->
                <div>
                    <label for="typeId" class="text-sm">ประเภทห้องพัก</label>
                    <select name="typeId" id="typeId" class="w-full p-2 border border-gray-300 rounded mt-1">
                        <?php foreach ($typesData as $type) { ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="roomDetail" class="text-sm">รายละเอียด</label>
                    <textarea name="roomDetail" id="roomDetail" class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
                </div>
                <div>
                    <label for="roomAmenities" class="text-sm">สิ่งอำนวยความสะดวก</label>
                    <textarea name="roomAmenities" id="roomAmenities" class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
                </div>
                <div>
                    <label for="maxGuest" class="text-sm">จำนวนผู้เข้าพักสูงสุด</label>
                    <input type="number" name="maxGuest" id="maxGuest" class="w-full p-2 border border-gray-300 rounded mt-1"
                    min="1" max="10">
                </div>
                <div>
                    <label for="price" class="text-sm">ราคา/คืน (฿)</label>
                    <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-1" min="500" max="20000" step="100">
                </div>
                <div class="relative">
                    <label for="roomImage" class="text-sm">รูปภาพห้องพัก</label>
                    <input type="file" name="roomImage" id="roomImage" class="w-full p-2 border border-gray-300 rounded mt-1">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2 justify-between items-center">
                            <span class="absolute top-1 right-0 text-gray-500">นามสกุล .jpg .png เท่านั้น</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="roomStatus" class="text-sm">สถานะ</label>
                    <select name="roomStatus" id="roomStatus" class="w-full p-2 border border-gray-300 rounded mt-1">
                        <option value="available">ว่าง</option>
                        <option value="unavailable">ไม่ว่าง</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="addRoom" class="w-full py-2 px-4 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-all duration-300 ease-in-out">เพิ่มห้องพัก</button>
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
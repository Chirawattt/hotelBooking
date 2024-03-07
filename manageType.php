<?php
    session_start();
    require 'config/database.php';

    $sql = "SELECT * FROM type_room";
    $result = mysqli_query($conn, $sql);
    $typesData = [];
    while ($type = mysqli_fetch_array($result)) {
        $typesData[] = Array(
            'id' => $type['id'],
            'name' => $type['name'],
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
        <h1 class="text-3xl font-semibold text-gray-700">จัดการประเภทของห้องพัก</h1>
    </div>
    <!-- main content -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto max-w-screen-xl mt-6">
        <!-- add button -->
        <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-normal text-sm">
                <tr>
                    <th scope="col" class="w-1/3 py-3 text-center">
                        รหัส
                    </th>
                    <th scope="col" class="w-1/3 py-3 text-center">
                        ชื่อประเภทห้องพัก
                    </th>
                    <th scope="col" class="w-1/3 py-3 text-center">
                        จัดการข้อมูล
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typesData as $type) { ?>
                    <tr class="bg-white dark:bg-gray-800 text-sm">
                        <td class="w-1/3 py-3 text-center">
                            <p><?php echo $type['id']; ?></p> 
                        </td>
                        <td class="w-1/3 py-3 text-center">
                            <p><?php echo $type['name']; ?></p>
                        </td>
                        <td class="w-1/3 py-3 text-center">
                            <a href="editType.php?id=<?php echo $type['id']; ?>" class="text-gray-500 hover:text-amber-400 transition-all 
                            duration-300 ease-in-out justify-center group">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a href="deleteType.php?id=<?php echo $type['id']; ?>" class="text-gray-500 hover:text-amber-400 transition-all 
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
        <a href="addType.php" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
            hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group">
            <i class="fa-solid fa-plus"></i>
            <span class="ms-3">เพิ่มประเภทของห้องพัก</span>
        </a>
    </div>
</body>
</html>
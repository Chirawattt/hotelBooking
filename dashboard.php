<?php
    session_start();
    require 'config/database.php';

    $userId = $_SESSION['user']['id'];

    $sql = "SELECT booking.id ,user.email as email ,booking.room_id, room.name as room_name, check_in_date as checkIn, check_out_date as checkOut,
    day_amount, num_people, total_price, booking_date, type_room.name as type_room_name, room.img FROM booking INNER JOIN user
    ON user_id = user.id INNER JOIN room ON room_id = room.id INNER JOIN type_room on room.type_id = type_room.id ORDER BY `booking`.`id` ASC";
    $result = mysqli_query($conn, $sql);
    $bookingData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($bookingData)) {
        $bookingData = null;
    }

    $sql = "SELECT * FROM room";
    $result = mysqli_query($conn, $sql);
    $roomData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($roomData)) {
        $roomData = null;
    }

    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $userData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($userData)) {
        $userData = null;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>My Booking</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    
    <!-- title for dashboard -->
    <div class="flex flex-col items-center justify-center mt-10">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <div class="w-[80%] h-[2px] bg-gray-300 my-2"></div>
        <div class="w-[80%] grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            <div class="flex flex-col items-center justify-center bg-white rounded-md shadow-md p-4">
                <h1 class="text-xl font-semibold mt-2">Total Booking</h1>
                <p class="text-sm text-gray-500">Total: <?= count($bookingData) ?></p>
            </div>
            <div class="flex flex-col items-center justify-center bg-white rounded-md shadow-md p-4">
                <h1 class="text-xl font-semibold mt-2">Total Room</h1>
                <p class="text-sm text-gray-500">Total: <?= count($roomData) ?></p>
            </div>
            <div class="flex flex-col items-center justify-center bg-white rounded-md shadow-md p-4">
                <h1 class="text-xl font-semibold mt-2">Total User</h1>
                <p class="text-sm text-gray-500">Total: <?= count($userData) ?></p>
            </div>
        </div>
    </div>

    <!-- display all booking data as table-->
    <div class="flex flex-col items-center justify-center mt-10">
        <h1 class="text-3xl font-semibold">Booking List</h1>
        <div class="w-[80%] h-[2px] bg-gray-300 my-2"></div>
        <table class="w-[80%] bg-white rounded-md shadow-md">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Room Name</th>
                    <th class="px-4 py-2">Check In</th>
                    <th class="px-4 py-2">Check Out</th>
                    <th class="px-4 py-2">Day Amount</th>
                    <th class="px-4 py-2">Num People</th>
                    <th class="px-4 py-2">Total Price</th>
                    <th class="px-4 py-2">Booking Date</th>
                    <th class="px-4 py-2">Type Room</th>
                    <th class="px-4 py-2">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bookingData !== null) {
                    foreach ($bookingData as $booking) {
                        echo "<tr class='hover:bg-gray-100 transition-all duration-300 ease-in-out'>";
                        echo "<td class='px-4 py-2'>" . $booking['id'] . "</td>";
                        echo "<td class='px-4 py-2'>" . $booking['email'] . "</td>";
                        echo "<td class='px-4 py-2'>" . $booking['room_name'] . "</td>";
                        echo "<td class='px-4 py-2'>" . $booking['checkIn'] . "</td>";
                        echo "<td class='px-2 py-2 text-center'>" . $booking['checkOut'] . "</td>";
                        echo "<td class='px-4 py-2 text-center'>" . $booking['day_amount'] . "</td>";
                        echo "<td class='px-4 py-2 text-center'>" . $booking['num_people'] . "</td>";
                        echo "<td class='px-4 py-2 text-center'>" . number_format($booking['total_price']) . "฿</td>";
                        echo "<td class='px-4 py-2'>" . $booking['booking_date'] . "</td>";
                        echo "<td class='px-4 py-2'>" . $booking['type_room_name'] . "</td>";
                        echo "<td class='px-4 py-2'><img src='./assets/photos/" . $booking['img'] . "' alt='room photo' class='w-20 h-20 rounded-md'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='text-center py-2'>No data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



</body>
</html>

<?php
    session_start();
    require 'config/database.php';

    $userId = $_SESSION['user']['id'];

    $sql = "SELECT booking.id ,user.email as email ,booking.room_id, room.name as room_name, check_in_date as checkIn, check_out_date as checkOut,
    day_amount, num_people, total_price, booking_date, type_room.name as type_room_name, room.img FROM booking INNER JOIN user
    ON user_id = user.id INNER JOIN room ON room_id = room.id INNER JOIN type_room on room.type_id = type_room.id where user_id = $userId";
    $result = mysqli_query($conn, $sql);
    $bookingData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($bookingData)) {
        $bookingData = null;
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
    <!-- title -->
    <?php if ($bookingData !== null) { ?>
        <div class="flex flex-col items-center justify-center mt-10">
            <h1 class="text-3xl font-semibold">My Booking</h1>
            <div class="w-[80%] h-[2px] bg-gray-300 my-2"></div>
            <div class="w-[80%] grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <?php foreach ($bookingData as $booking) { ?>
                    <?php 
                        $booking['checkIn'] = date('d/m/Y', strtotime($booking['checkIn']));
                        $booking['checkOut'] = date('d/m/Y', strtotime($booking['checkOut']));
                        $booking['booking_date'] = date('d/m/Y', strtotime($booking['booking_date']));
                        $booking['total_price'] = number_format($booking['total_price']);
                    ?>
                    <div class="flex flex-col items-center justify-center bg-white rounded-md shadow-md p-4">
                        <img src="./assets/photos/<?= $booking['img'] ?>" alt="room photo" class="w-[200px] h-[200px] object-cover rounded-md">
                        <h1 class="text-xl font-semibold mt-2"><?= $booking['room_name'] ?></h1>
                        <p class="text-sm text-gray-500"><?= $booking['type_room_name'] ?></p>
                        <p class="text-sm text-gray-500">Check-in: <?= $booking['checkIn'] ?></p>
                        <p class="text-sm text-gray-500">Check-out: <?= $booking['checkOut'] ?></p>
                        <p class="text-sm text-gray-500">Total Price: <?= $booking['total_price'] ?>฿</p>
                        <p class="text-sm text-gray-500">Booking Date: <?= $booking['booking_date'] ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="flex flex-col items-center justify-center mt-10">
            <h1 class="text-3xl font-semibold">My Booking</h1>
            <div class="w-[80%] h-[2px] bg-gray-300 my-2"></div>
            <h1 class="text-xl font-semibold">No Booking</h1>
        </div>
    <?php } ?>

    <!-- back button -->
    <div class="flex items-center justify-center mt-10">
        <a href="javascript:history.back()" class="flex items-center space-x-2 bg-white rounded-md shadow-md p-2 px-4 hover:bg-gray-100 transition-all duration-300 ease-in-out">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>




</body>
</html>

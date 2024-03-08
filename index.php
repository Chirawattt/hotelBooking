<?php
    session_start();
    require 'config/database.php';

    if (isset($_POST['checkIn'])) {
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
                'create_at' => $rooms['create_at'],
                'img' => $rooms['img']
            );
        }

        // get check in date to search available room
        $checkIn = $_POST['checkIn'];
        $checkInTime = strtotime($checkIn);

        // get all the booking data from database
        $sql = "SELECT * FROM booking";
        $result = mysqli_query($conn, $sql);
        $bookings = [];
        while ($booking = mysqli_fetch_array($result)) {
            $bookings[] = Array(
                'id' => $booking['id'],
                'user_id' => $booking['user_id'],
                'room_id' => $booking['room_id'],
                'num_people' => $booking['num_people'],
                'check_in_date' => $booking['check_in_date'],
                'check_out_date' => $booking['check_out_date'],
                'day_amount' => $booking['day_amount'],
                'total_price' => $booking['total_price'],
                'create_at' => $booking['booking_date']
            );
        }

        // foreach in booking data to get id room that already booked in check in date
        $bookedRoom = [];
        foreach ($bookings as $booking) {
            $checkInDate = strtotime($booking['check_in_date']);
            $checkOutDate = strtotime($booking['check_out_date']);
            if ($checkInTime >= $checkInDate && $checkInTime <= $checkOutDate) {
                $bookedRoom[] = $booking['room_id'];
            }
        }

        // foreach in rooms data to remove booked room from rooms data
        foreach ($roomsData as $key => $room) { // remove booked room from rooms data by check id in booked room array 
            if (in_array($room['id'], $bookedRoom)) { // if room id in booked room array remove it from rooms data
                unset($roomsData[$key]); // unset is used to remove element from array
            }
        }

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
    <title>Home</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">ค้นหาห้องพัก</h1>
    </div>

    <!-- input type date to check room available -->
    <div class="flex items-center justify-center mt-5">
        <form action="#" method="post">
            <div class="flex items-center justify-center space-x-3">
                <!-- label for date to check in to check available room -->
                <div class="flex flex-col items-center">
                    <label for="checkIn" class="text-gray-700 -mb-1">วันที่เข้าพัก:</label>
                    <label for="checkIn" class="text-gray-700 -mt-1">(mm-dd-yyyy)</label>
                </div>
                <!-- if isset $checkIn set the value of input to $checkIn -->
                <?php if (isset($_POST['checkIn'])) { ?>
                    <input type="date" name="checkIn" value="<?php echo $checkIn; ?>" min="<?php echo date('Y-m-d'); ?>" placeholder="dd-mm-yyyy" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <?php } else { ?>
                    <input type="date" name="checkIn" value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>" placeholder="dd-mm-yyyy" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <?php } ?>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">ค้นหา</button>
            </div>
        </form>
    </div>


    <!-- display all data room as table two columns data in row -->
    <?php if (isset($_POST['checkIn'])) { ?>
        <?php $searchDate = $_POST['checkIn'];
            $THdate = date('d/m/Y', strtotime($searchDate)); 
            echo "<div class='flex items-center justify-center flex-col mt-5'>
                <span class='text-base'>ห้องพักว่าง ณ วันที่: (dd-mm-yyyy) </span>
                <h1 class='text-2xl font-semibold text-gray-700'>$THdate</h1>
            </div>";
        ?>
        <div class="mx-auto max-w-screen-xl mt-6">
            <table class="w-full">
                <?php $tdCount = 1; ?>
                <?php foreach ($roomsData as $room) { ?>
                    <?php if ($tdCount === 1) { ?>
                        <tr>
                    <?php } ?>
                    <td>
                        <div class="flex px-3 py-2 bg-[#f3f4f6]">
                            <div class="flex flex-col items-center w-full bg-white rounded-md ">
                                <!-- div for id, status, max-guest -->
                                <div class="flex items-center justify-between w-full p-3 bg-gray-800 rounded-t-md shadow-md mb-3">
                                    <!-- Room id -->
                                    <p class="text-sm font-normal text-gray-100">ห้องที่: <?php echo $room['id']; ?></p>
                                    <!-- Room status -->
                                    <p class='text-sm font-normal text-green-500'>ว่าง</p>
                                    <!-- Room max people -->
                                    <p class="text-sm font-normal text-gray-100">สูงสุด: <?php echo $room['max_people']; ?> คน</p>
                                </div>

                                <!-- div for type -->
                                <div class="flex items-center justify-end w-full pr-4">
                                    <p class="text-sm font-normal text-gray-500"><?php echo $room['type']; ?></p>
                                </div>

                                <!-- div for name-->
                                <div class="flex items-center justify-center w-full pb-2 ">
                                    <h1 class="text-xl font-semibold text-gray-700"><?php echo $room['name']; ?></h1>
                                </div>

                                <!-- div for image -->
                                <div class="w-[500px] h-[260px] overflow-hidden flex justify-center">
                                    <?php $roomImg = $room['img'];  
                                        if ($roomImg !== null) {
                                            echo "<img src='assets/photos/$roomImg' alt='room' class='w-[600px] object-cover'>";
                                        }else {
                                            echo "<img src='assets/photos/room.jpg' alt='room' class='w-80 h-48 object-cover'>";
                                        }
                                    ?>
                                </div>

                                <!-- div for only room detail -->
                                <div class="flex flex-col items-start justify-center w-full px-10 pt-8">
                                    <p class="text-sm font-semibold text-gray-700">รายละเอียดห้องพัก:</p>
                                    <p class="text-sm font-normal text-gray-500"><?php echo $room['detail']; ?></p>
                                </div>

                                <!-- divider line-->
                                <div class="w-full px-10 py-1">
                                    <div class="w-full bg-gray-300 h-[2px]"></div>
                                </div>
                                
                                <!-- div for only room facility -->
                                <div class="flex flex-col items-start justify-center w-full px-10 pt-2">
                                    <p class="text-sm font-semibold text-gray-700">สิ่งอำนวยความสะดวก:</p>
                                    <p class="text-sm font-normal text-gray-500"><?php echo $room['facility']; ?></p>
                                </div>
                                
                                <!-- divider line-->
                                <div class="w-full px-10 py-1">
                                    <div class="w-full bg-gray-300 h-[2px]"></div>
                                </div>
                                
                                <!-- div for price and booking button -->
                                <div class="flex items-center justify-between w-full p-1 bg-gray-800 rounded-b-md shadow-md mt-3">
                                    <!-- div for price -->
                                    <div class="flex flex-col justify-center items-center px-4">
                                        <p class="text-sm text-gray-300 -mb-2">ราคา/คืน:</p>
                                        <span class="text-lg text-amber-400 "><?php echo $room['price']?> ฿</span>
                                    </div>
                                    <!-- booking button -->
                                    <div class="flex items-center justify-center mr-5">
                                        <a href="booking.php?room_id=<?php echo $room['id']; ?>&searchDate=<?php echo $searchDate ?>" class="px-4 py-1 text-white bg-amber-400 rounded-md hover:bg-amber-500">จอง</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php if ($tdCount === 2) { ?>
                        </tr>
                        <?php $tdCount = 1; ?>
                    <?php } else { ?>
                        <?php $tdCount++; ?>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    <?php } ?>
    


</body>
</html>









<!-- check list
    - type
    - reservation
    - display reservation in admin side and user sides
-->
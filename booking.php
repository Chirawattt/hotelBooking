<?php 
    session_start();
    require 'config/database.php';

    $room_id = $_GET['room_id'];
    $searchDate = $_GET['searchDate'];

    $sql = "SELECT room.id, room.name, type_room.name as type, room.detail, room.facility,
    room.max_people, room.price, room.status, room.img, room.create_at FROM room 
    INNER JOIN type_room ON room.type_id = type_room.id WHERE room.id = $room_id";

    $result = mysqli_query($conn, $sql);
    $room = mysqli_fetch_array($result);


    if (isset($_POST['calculate'])) {
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $checkInBackUp = $checkIn;
        $checkOutBackUp = $checkOut;
        $numPeople = $_POST['numPeople'];
        $room_id = $_POST['room_id'];

        $errorBooking = 0;

        $checkInPR = strtotime($checkIn);
        $checkOutPR = strtotime($checkOut);
        if ($checkInPR > $checkOutPR) {
            echo "
                <script>
                    alert('วันที่เข้าพักต้องไม่มากกว่าวันที่ออก');
                </script>
            ";
            $errorBooking++;
        }else if ($checkInPR < strtotime(date('Y-m-d'))) {
            echo "
                <script>
                    alert('วันที่เข้าพักต้องมากกว่าหรือเท่ากับวันปัจจุบัน');
                </script>
            ";
            $errorBooking++;
        }else if ($checkInPR == $checkOutPR) {
            echo "
                <script>
                    alert('วันที่เข้าพักและวันที่ออกต้องไม่เท่ากัน');
                </script>
            ";
            $errorBooking++;
        }else {
            $sql = "SELECT check_in_date, check_out_date FROM booking WHERE room_id = $room_id";
            $result = mysqli_query($conn, $sql);
            $bookings = [];
            while ($booking = mysqli_fetch_array($result)) {
                $bookings[] = $booking;
            }
            
            if ($bookings != null) {
                $canBook = 0;
                foreach ($bookings as $booking) {
                    $checkInDB = strtotime($booking['check_in_date']);
                    $checkOutDB = strtotime($booking['check_out_date']);
                    if ($checkInPR < $checkInDB && $checkOutPR < $checkInDB) {
                        $canBook++;
                    }else if ($checkInPR > $checkOutDB && $checkOutPR > $checkOutDB) {
                        $canBook++;
                    }else {
                        $errorBooking++;
                        echo "
                            <script>
                                alert('ห้องพักไม่ว่างในวันที่เลือก');
                            </script>
                        ";
                    }
                }
            }

            if ($errorBooking == 0) {
                $date1 = strtotime($checkIn); // strtotime is a function to convert date to number of seconds ex. 01-01-2021 to 1609459200
                $date2 = strtotime($checkOut);
                $diff = abs($date2 - $date1); // abs is a function to convert negative number to positive number
                $numNight = $diff / 86400; // 86400 is number of seconds in 1 day
                $totalPrice = $room['price'] * $numNight; // calculate total price
                // check checkIn and checkOut date to format d-m-Y
                $checkIn = date('d-m-Y', strtotime($checkIn)); 
                $checkOut = date('d-m-Y', strtotime($checkOut));
                // totalPrice format to number with comma
                $totalPrice = number_format($totalPrice);
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
        <title>Booking Room: <?php echo $room['id']; ?></title>
    </head>
    <body class="bg-[#f3f4f6] min-w-[360px] ">
        <?php include './includes/navbar.php'; ?>
        <div class="flex items-center justify-center mt-5">
            <h1 class="text-3xl font-semibold text-gray-700">จองห้องพัก</h1>
        </div>
        <div class="flex items-center justify-center mt-5">
            <form action="#" method="post">
                <div class="flex items-center justify-center space-x-3">
                    <label for="checkIn" class="text-gray-700" >วันที่เข้าพัก: </label>
                    <input type="date" name="checkIn" id="checkIn" min="<?php echo date('Y-m-d') ?>" value="<?php echo $searchDate ?>" 
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <label for="checkOut" class="text-gray-700">วันที่ออก: </label>
                    <?php 
                        // add 1 day to checkIn date
                        $minCheckOutDate = date('Y-m-d', strtotime($searchDate . ' +1 day'));
                    ?>
                    <input type="date" name="checkOut" id="checkOut" min="<?php echo $minCheckOutDate ?>" value="<?php echo $minCheckOutDate ?>" 
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <!-- for input num of people -->
                    <label for="numPeople" class="text-gray-700">จำนวนคน: </label>
                    <input type="number" name="numPeople" id="numPeople" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    min="1" max="<?php echo $room['max_people'] ?>" required>
                    <span id="alertNumPeople" class="hidden text-sm text-red-500">จำนวนคนไม่ถูกต้อง</span>
                    <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                    <!-- buttom for calculate price and onClick to scroll to divCalc-->
                    <button type="submit" name="calculate" id="calculateBtn" class="px-4 py-2 text-white bg-gray-300 cursor-not-allowed rounded-md transition-all duration-300 ease-in-out" disabled>คำนวณราคา</button>
                </div>
            </form>
        </div>
        <!-- card div for display detail of room -->
        <div class=" w-full flex justify-center">
            <div class="max-w-screen-xl flex justify-center items-center mt-8">
                <div class="flex flex-col items-center bg-white rounded-md shadow-md">
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
                    <div class="flex items-center justify-center w-full p-1 bg-gray-800 rounded-b-md shadow-md mt-3">
                        <!-- div for price -->
                        <div class="flex flex-col justify-center items-center px-4">
                            <p class="text-base text-gray-300 -mb-2">ราคา/คืน:</p>
                            <span class="text-xl text-amber-400 "><?php echo $room['price']?> ฿</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_POST['calculate'])) { ?>
            <?php if ($errorBooking == 0) { ?>
                
                <!-- div for display checkIn and checkOut date -->
                <div class="flex flex-col items-center">
                    <div class="max-w-screen-xl flex justify-center items-center mt-6 gap-14">
                        <!-- checkIn date -->
                        <div class="flex items-center justify-center flex-col">
                            <p class="text-base font-semibold text-gray-700">วันที่เข้าพัก</p>
                            <p class="text-xl font-semibold text-gray-700"><?php echo $checkIn;?></p>
                        </div>
                        <span class="text-2xl font-bold">-</span>
                        <!-- checkOut date -->
                        <div class="flex items-center justify-center flex-col">
                            <p class="text-base font-semibold text-gray-700">วันที่ออก</p>
                            <p class="text-xl font-semibold text-gray-700"><?php echo $checkOut; ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-base font-semibold text-gray-700">จำนวนคืน: <?php echo $numNight ?> คืน</p>
                    </div>
                    <!-- divider line -->
                    <div class="max-w-2xl w-full px-10 py-1">
                        <div class="w-full bg-gray-300 h-[2px]"></div>
                    </div>
                </div>


                <!-- div for display calculate after submit -->
                <div class="flex justify-center mt-2">
                    <div class="max-w-screen-xl flex justify-between items-center mt-1 gap-5">
                        <!-- div for calculate title -->
                        <div class="flex items-center justify-center">
                            <h1 class="text-2xl font-semibold text-gray-700">คำนวณราคา</h1>
                        </div>
                        <!-- div for calculate result -->
                        <div class="flex items-center justify-center">
                            <p class="text-xl font-semibold text-gray-700"> ราคารวม: <?php echo $totalPrice ?> ฿ </p>
                        </div>
                        <!-- div for number of people -->
                        <div class="flex items-center justify-center">
                            <p class="text-xl font-semibold text-gray-700"> จำนวนคน: <?php echo $numPeople ?> คน </p>
                        </div>
                    </div>
                </div>

                <!-- div for display booking button -->
                <div id="divCalc" class="flex justify-center pb-10">
                    <!-- button with icon -->
                    <form action="phpActions/bookingCheck.php" method="post">
                        <input type="hidden" name="roomId" value="<?php echo $room['id']?>">
                        <input type="hidden" name="checkIn" value="<?php echo $checkInBackUp; ?>">
                        <input type="hidden" name="checkOut" value="<?php echo $checkOutBackUp; ?>">
                        <input type="hidden" name="day_amount" value="<?php echo $numNight; ?>">
                        <input type="hidden" name="numPeople" value="<?php echo $numPeople; ?>">
                        <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">

                        <button type="submit" class="flex items-center justify-center px-4 py-2 text-green-500  rounded-md hover:bg-green-500 hover:text-white mt-5
                        transition-all duration-300 ease-in-out">
                            <i class="fas fa-check-circle text-xl mr-2"></i>
                            <span class="text-xl font-semibold">ยืนยันการจอง</span>
                        </button>
                    </form>
                </div>
            <?php } ?>
        <?php } ?>


        <script>
            var calculateBtn = document.getElementById('calculateBtn');
            function disabledBtn() {
                calculateBtn.setAttribute('disabled', true);
                calculateBtn.classList.remove('bg-green-500');
                calculateBtn.classList.add('bg-gray-300');
                calculateBtn.classList.remove('hover:bg-green-600');
            }
            function enabledBtn() {
                calculateBtn.removeAttribute('disabled');
                calculateBtn.classList.remove('bg-gray-300');
                calculateBtn.classList.add('bg-green-500');
                calculateBtn.classList.add('hover:bg-green-600');
                calculateBtn.classList.remove('cursor-not-allowed');
            }

            var checkIn = document.getElementById('checkIn');
            var checkOut = document.getElementById('checkOut');
            var numPeople = document.getElementById('numPeople');
            var alertNumPeople = document.getElementById('alertNumPeople');

            // checkIn event listener for change data
            checkIn.addEventListener('change', function() {
                if (checkIn.value.length > 0 && checkOut.value.length > 0 && numPeople.value.length > 0) {
                    enabledBtn();
                }else {
                    disabledBtn();
                }
            });

            // checkOut event listener for change data
            checkOut.addEventListener('change', function() {
                if (checkOut.value.length > 0 && checkIn.value.length > 0 && numPeople.value.length > 0) {
                    enabledBtn();
                }else {
                    disabledBtn();
                }
            });

            // numPeople event listener for change data
            numPeople.addEventListener('input', function() {
                if (numPeople.value > <?php echo $room['max_people'] ?> || numPeople.value < 1) {
                    alertNumPeople.classList.remove('hidden');
                    disabledBtn();
                }else {
                    alertNumPeople.classList.add('hidden');
                    if (checkIn.value.length > 0 && checkOut.value.length > 0) {
                        enabledBtn();
                    }else {
                        disabledBtn();
                    }
                }
            });

        </script>
    </body>
</html>
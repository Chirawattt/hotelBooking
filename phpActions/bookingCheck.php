<?php
    session_start();
    require '../config/database.php';

    $roomId = $_POST['roomId'];
    $CheckIn = $_POST['checkIn'];
    $CheckOut = $_POST['checkOut'];
    $numNight = $_POST['day_amount'];
    $numPeople = $_POST['numPeople'];
    $totalPrice = $_POST['totalPrice'];
    $userId = $_POST['user_id'];
    
    // cut , from totalPrice
    $totalPrice = str_replace(',', '', $totalPrice);

    $bookingId = 0;
    $sql = "SELECT id FROM booking ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $booking = mysqli_fetch_array($result);
        if ($booking['id'] == null) $bookingId = 0;
        else $bookingId = $booking['id'];
    }
    $bookingId += 1;
    
    $sql = "INSERT INTO booking (id, user_id, room_id, num_people, check_in_date, check_out_date, day_amount, total_price)
    VALUES ($bookingId, $userId, $roomId, $numPeople, '$CheckIn', '$CheckOut', $numNight, $totalPrice)";
    mysqli_query($conn, $sql);
    echo "
        <script>
            alert('จองห้องพักสำเร็จ');
            window.location.href = '../index.php';
        </script>
    ";

?>
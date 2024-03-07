<?php
    session_start();
    require '../config/database.php';

    $roomName = $_POST['roomName'];
    $typeId = $_POST['typeId'];
    $roomDetail = $_POST['roomDetail'];
    $roomAmenities = $_POST['roomAmenities'];
    $maxGuest = $_POST['maxGuest'];
    $price = $_POST['price'];
    $roomStatus = $_POST['roomStatus'];

    if (isset($_FILES['roomImage']) && $_FILES['roomImage']['name']) {
        $imageFileName = $_FILES['roomImage']['name'];
        $imageFileTmpName = $_FILES['roomImage']['tmp_name'];
        $imageFileSize = $_FILES['roomImage']['size'];
        $imageFileType = $_FILES['roomImage']['type'];
    }
    else {
        $imageFileName = "";
    }

    // check if the image file is jpg png or gif
    // if correct then upload the file to the server
    // if not correct then alert the user and history back

    if ($imageFileName != "") {
        if ($imageFileType=="image/jpeg" or $imageFileType=="image/png") {
            if ($imageFileSize < 500000) { // 500000 bytes = 500KB - 1000000 bytes = 1MB
                move_uploaded_file($imageFileTmpName,"../assets/photos/".$imageFileName);
                $picture = $imageFileName;
            }
            else {
                echo "<script>
                alert('รูปภาพมีขนาดใหญ่เกินไป');
                window.history.back();
                </script>";
                exit();
            }
        }
        else {
            // alert the user and history back
            echo "<script>
                alert('รูปภาพต้องเป็นไฟล์นามสกุล jpg หรือ png เท่านั้น');
                window.history.back();
            </script>";
            exit();
        }
    }
    else {
        $picture = "";
    }

    // query last id from room table
    $sql = "SELECT * FROM room ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $lastId = mysqli_fetch_array($result);
    $lastId = $lastId['id'];
    // add 1 to last id
    $lastId++;

    // insert new room data to room table
    $sql = "INSERT INTO room (id, name, type_id, detail, facility, max_people, price, status, img, create_at) VALUES ('$lastId', '$roomName', '$typeId', '$roomDetail', '$roomAmenities', '$maxGuest', '$price', '$roomStatus', '$picture', now())";
    mysqli_query($conn, $sql);
    
    echo " <script> alert('เพิ่มห้องพักเรียบร้อยแล้ว'); </script>";
    header('Location: ../manageRoom.php');
?>
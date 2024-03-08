<?php
    session_start();
    require '../config/database.php';

    $roomId = $_POST['roomId'];
    $sql = "SELECT img FROM room WHERE id = $roomId";
    $result = mysqli_query($conn, $sql);
    $room = mysqli_fetch_array($result);

    $roomId = $_POST['roomId'];
    $typeId = $_POST['typeId'];
    $roomName = $_POST['roomName'];
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
        if ($room['img'] != null) {
            $imageFileName = $room['img'];
            $isOldImg = true;
        }else {
            $imageFileName = "";
        }
    }

    // check if the image file is jpg png or gif
    // if correct then upload the file to the server
    // if not correct then alert the user and history back

    if (!$isOldImg) {
        if ($imageFileName != "") {
            if ($imageFileType=="image/jpeg" or $imageFileType=="image/png") {
                if ($imageFileSize < 500000) { // 500000 bytes = 500KB - 1000000 bytes = 1MB
                    move_uploaded_file($imageFileTmpName,"../assets/photos/".$imageFileName);
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
    }

    // update the room data to the database
    $sql = "UPDATE room SET name='$roomName', type_id='$typeId' ,detail='$roomDetail', facility='$roomAmenities', max_people='$maxGuest', price='$price', status='$roomStatus', img='$imageFileName' WHERE id='$roomId'";
    mysqli_query($conn, $sql);
    
    echo "<script> 
        alert('แก้ไขข้อมูลห้องพักเรียบร้อยแล้ว'); 
    </script>";
    header('Location: ../manageRoom.php');
?>
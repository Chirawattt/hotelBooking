<?php
    $Password = $_POST['password'];
    $Phone = $_POST['phone'];
    $Fname = $_POST['fname'];
    $Lname = $_POST['lname'];

    $oldImageFile = @$_POST['oldImageFile'];
    $imageFileName = @$_FILES['imageFile']['name'];
    $imageFileType = @$_FILES['imageFile']['type'];
    $imageFileSize = @$_FILES['imageFile']['size'];
    $imageFileTmpName = @$_FILES['imageFile']['tmp_name'];
    $picture="";

    // if ($imageFileName) {
        // if ($imageFileType=="image/jpeg" or $imageFileType=="image/png") {
            // if ($imageFileSize < 500000) {
                // if ($oldImageFile!="") {
                    // unlink("../assets/photos/".$oldImageFile);
                // }
                // move_uploaded_file($imageFileTmpName,"../assets/photos/".$imageFileName);
                // $picture = $imageFileName;
            // }
            // else {
                // echo '<b><li>รูปภาพมีขนาดใหญ่เกินไป</li></b><br>';
            // }
        // }
        // else {
            // echo '<b><li>รูปภาพต้องเป็นชนิด jpg หรือ png เท่านั้น</li></b><br>';
        // }
    // }
    // else {
        // $picture = $oldImageFile;
    // }
    if ($_FILES['imageFile']['name']=="") {
        echo '<b><li>คุณไม่ได้เลือกรูปภาพ</li></b><br>';
    }
    else {
        move_uploaded_file($_FILES["imageFile"]["tmp_name"],"../assets/photos/".$_FILES["imageFile"]["name"]);
        $picture = $_FILES['imageFile']['name'];
    }

?>
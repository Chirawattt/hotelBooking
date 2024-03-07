<?php
    session_start();
    require '../config/database.php';

    // check if password was post from the form
    if (isset($_POST['password'])) {
        $Password = $_POST['password'];
    }
    else {
        $Password = $_SESSION['user']['password'];
    }

    // check if phone was post from the form
    if (isset($_POST['phone'])) {
        $Phone = $_POST['phone'];
    }
    else {
        $Phone = $_SESSION['user']['phone'];
    }

    // check if fname was post from the form
    if (isset($_POST['fname'])) {
        $Fname = $_POST['fname'];
    }
    else {
        $Fname = $_SESSION['user']['fname'];
    }

    // check if lname was post from the form
    if (isset($_POST['lname'])) {
        $Lname = $_POST['lname'];
    }
    else {
        $Lname = $_SESSION['user']['lname'];
    }


    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['name']) {
        $imageFileName = $_FILES['imageFile']['name'];
        $imageFileTmpName = $_FILES['imageFile']['tmp_name'];
        $imageFileSize = $_FILES['imageFile']['size'];
        $imageFileType = $_FILES['imageFile']['type'];
        echo "imageFileName = $imageFileName<br>";
    }
    else {
        $imageFileName = "";
    }

    // check if the image file is jpg png or gif
    // if correct then upload the file to the server
    // if not correct then alert the user and history back

    $oldImageFile = $_SESSION['user']['img'];

    if ($imageFileName != "") {
        if ($imageFileType=="image/jpeg" or $imageFileType=="image/png") {
            if ($imageFileSize < 500000) {
                if ($oldImageFile!="") {
                    unlink("../assets/photos/".$oldImageFile);
                }
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
        $picture = $_SESSION['user']['img'];
    }

    // update user data in user table where user id = session user id
    $userId = $_SESSION['user']['id'];
    $sql = "UPDATE user SET password='$Password', phone='$Phone', fname='$Fname', lname='$Lname', img='$picture' WHERE id='$userId'";
    mysqli_query($conn, $sql);
    
    echo " <script> alert('แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว'); </script>";
    
    // clear data in $_SESSION['user']
    unset($_SESSION['user']);

    // update user data in session
    $sql = "SELECT * FROM user WHERE id='$userId'";
    $result = mysqli_query($conn, $sql);
    $userData = mysqli_fetch_array($result);

    $_SESSION['user'] = $userData;
    header('Location: ../profile.php');
?>
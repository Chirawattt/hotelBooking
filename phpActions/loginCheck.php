<?php
    session_start(); // Start the session and store the session data
    require "../config/database.php";

    $email = $_POST['email'];
    $Password = $_POST['password'];

    // query data from user table
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    $userData = mysqli_fetch_array($result);
    if ($userData) {
        if ($userData['password'] == $Password) {
            $_SESSION['user'][] = $userData;
            $_SESSION['userImg'] = $userData['img'];
            $_SESSION['isLogin'] = true;
            header('Location: ../index.php');
        }
        else {
            echo "<script>
                alert('รหัสผ่านไม่ถูกต้อง');
                window.history.back();
            </script>";
            exit();
            $_SESSION['isLogin'] = false;
        }
    }else {
        echo "<script>
            alert('ไม่พบอีเมลนี้ในระบบ');
            window.history.back();
        </script>";
        exit();
        $_SESSION['isLogin'] = false;
    }

   
?>
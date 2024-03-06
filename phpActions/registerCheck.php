<?php
    require '../config/database.php';

    $email = $_POST['email'];
    $Password = $_POST['password'];
    $Password2 = $_POST['password2'];
    $phone = $_POST['phone'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $isRegisterable = true;

    // check if the passwords are the same
    $isSamePassword = true;
    if($Password != $Password2){
        $isSamePassword = false;
        $isRegisterable = false;
        echo "<script>
            alert('รหัสผ่านไม่ตรงกัน');
            window.history.back();
        </script>";
        exit();
    }

    if ($isSamePassword) {
        // query data from user table
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);
        while ($users = mysqli_fetch_array($result)) {
            if ($email == $users['email']) {
                $isRegisterable = false;
                echo "<script>
                    alert('อีเมลนี้มีผู้ใช้งานแล้ว');
                    window.history.back();
                </script>";
                exit();
            }
            else if ($phone == $users['phone']) {
                $isRegisterable = false;
                echo "<script>
                    alert('หมายเลขโทรศัพท์นี้มีผู้ใช้งานแล้ว');
                    window.history.back();
                </script>";
                exit();
            }
            $strLastId = $users['id'];
        }
    }

    if ($isRegisterable) {
        $id = (int) $strLastId;
        $id++;
        $sql = "insert into user(id, email, password, phone, fname, lname) values ('$id', '$email', '$Password', '$phone', '$fname', '$lname')";
        mysqli_query($conn, $sql) or die("insert ลงตาราง book มีข้อผิดพลาดเกิดขึ้น" .mysqli_error());
        echo "<script>
            alert('ลงทะเบียนสำเร็จ');
            window.location.href = '../login.php';
        </script>";
    }

?>
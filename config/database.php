<?php
    require 'constants.php';

    global $conn;
    $conn = mysqli_connect(hostname, username, password);
    if (!$conn) die("ไม่สามารถติดต่อกับ mySQL ได้");
    mysqli_select_db($conn, dbname) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");
    // mysqli_query($conn, "set character_set_server=utf8mb4");
    
?>
<?php
    session_start();
    require '../config/database.php';

    $typeName = $_POST['typeName'];
    $lastId = 0;

    // query last id from room table
    $sql = "SELECT * FROM type_room ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $lastId = mysqli_fetch_array($result);
    $lastId = $lastId['id'];
    // add 1 to last id
    $lastId++;

    // insert new room data to room table
    $sql = "INSERT INTO type_room (id, name) VALUES ('$lastId', '$typeName')";
    mysqli_query($conn, $sql);
    
    echo " <script> alert('เพิ่มประเภทห้องพักเรียบร้อยแล้ว'); </script>";
    header('Location: ../manageType.php');
?>
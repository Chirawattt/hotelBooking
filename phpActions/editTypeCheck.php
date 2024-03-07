<?php
    session_start();
    require '../config/database.php';

    $typeId = $_POST['typeId'];
    $typeName = $_POST['typeName'];

    // update the type data to the database
    $sql = "UPDATE type_room SET name='$typeName' WHERE id='$typeId'";
    mysqli_query($conn, $sql);
    
    echo "<script> 
        alert('แก้ไขข้อมูลประเภทห้องพักเรียบร้อยแล้ว'); 
    </script>";
    header('Location: ../manageType.php');
?>
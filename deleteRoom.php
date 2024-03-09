<?php
    session_start();
    require 'config/database.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM room WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            header('Location: manageRoom.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>
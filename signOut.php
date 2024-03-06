<?php
    session_start();
    session_destroy();
    $Email = $_GET['Email'];
    echo "
    <script>
        let email = '$Email now Signout.';
        alert(email);
    </script>
    ";
    header('Location: login.php');
?>
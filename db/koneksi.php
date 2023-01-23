<?php 
    $host = "localhost";
    $user = "root";
    $pw   = "";
    $db   = "test";

    $conn = mysqli_connect($host, $user, $pw, $db);
    if (!$conn) {
        echo "gagal terhubung error" .mysqli_connect_errno();
        exit();
    }
?>

<?php

function shopConn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "r_store";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Koneksi Gagal!" . mysqli_connect_eror());
    }
    return $conn;
}

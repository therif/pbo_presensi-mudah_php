<?php

function connect_database(){
    $servername = "localhost";
    $database = "pbo_presensi";
    $username = "room";
    $password = "therif";
    $koneksi = mysqli_connect($servername, $username, $password, $database);
    // mengecek koneksi
    if (!$koneksi) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $koneksi;
}


?>
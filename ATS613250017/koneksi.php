<?php
$host     = "localhost";
$user     = "root";
$pass     = "";
$database = "ATS613250017"; // sesuaikan kalau nama databasemu berbeda

// Membuat koneksi ke database MySQL
$koneksi = new mysqli($host, $user, $pass, $database);

// Mengatur karakter agar huruf/simbol tampil benar
$koneksi->set_charset('utf8mb4');

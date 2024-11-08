<?php

// Konfigurasi database
$host     = "localhost";
$username = "root";
$password = "";
$database = "Kewer-kewer";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
<?php

session_start();

require_once __DIR__ . '/connect-database.php';
require_once __DIR__ . '/components.php';

// Fungsi untuk menampilkan semua query(data) dari database
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function baseUrl($path = '', $secure = null)
{
    $is_production = getenv('APP_ENV') === 'production';
    $is_https      = $is_production || ($secure ?? (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'));

    // Deteksi environment server
    $is_built_in_server = php_sapi_name() === 'cli-server';
    $is_xampp           = strpos($_SERVER['SERVER_SOFTWARE'], 'XAMPP') !== false;
    $is_laragon         = strpos($_SERVER['SERVER_SOFTWARE'], 'Laragon') !== false;

    if ($is_built_in_server) {
        $domain = $_SERVER['HTTP_HOST'];
    } elseif ($is_xampp || $is_laragon) {
        // Untuk XAMPP dan Laragon, gunakan nama host dari request
        $domain = $_SERVER['HTTP_HOST'];
    } else {
        $domain = getenv('APP_DOMAIN') ?: 'Kewer-Kewer.test';
    }

    $base_url = ($is_https ? "https://" : "http://") . $domain;

    // Remove file extension if it's .php
    $path = preg_replace('/\.php$/', '', $path);

    // Add .php extension if the file exists
    $full_path = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($path, '/') . '.php';
    if (file_exists($full_path)) {
        $path .= '.php';
    }

    return rtrim($base_url, '/') . '/' . ltrim($path, '/');
}

function isActive($route)
{
    $currentUrl = trim($_SERVER['REQUEST_URI'], '/');

    return $currentUrl === trim($route, '/') ? 'active fw-semibold underline' : '';
}

function sanitizeInput($data)
{
    return htmlspecialchars(trim($data));
}

// function register
function Register($register)
{
    global $conn;

    // Ambil data dari form
    $name      = sanitizeInput(ucwords($register['nama']));
    $email     = sanitizeInput($register['email']);
    $phone     = sanitizeInput($register['phone']);
    $address   = sanitizeInput($register['address']);
    $password  = sanitizeInput($register['password']);
    $password2 = sanitizeInput($register['password2']);
    $level     = "Customer";
    $status    = "ON";

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return "Maaf, Email Sudah Terdaftar";
    }

    // Cek kesamaan password dan konfirmasi password
    if ($password !== $password2) {
        return "Konfirmasi password tidak sesuai";
    }

    // Enkripsi password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Menyimpan data pengguna menggunakan prepared statement
    $insert = $conn->prepare("INSERT INTO users (name, email, phone, address, password, level, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param("sssssss", $name, $email, $phone, $address, $hashedPassword, $level, $status);

    if ($insert->execute()) {
        return "Pendaftaran berhasil!";
    } else {
        return "Error: " . $insert->error;
    }
}

function Login($login)
{
    global $conn;

    $email    = sanitizeInput($login['email']);
    $password = sanitizeInput($login['password']);

    // Cek apakah email ada di database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika email ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Buat session
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_level'] = $user['level'];

            // Jika opsi "Ingat Saya" dipilih, simpan informasi ke dalam cookie
            if (!empty($login['remember_me'])) {
                setcookie('user_email', $user['email'], time() + (86400 * 30), "/"); // 30 hari
            }

            return "Login berhasil!";
        } else {
            return "Password salah.";
        }
    } else {
        return "Email tidak ditemukan.";
    }
}

function Logout()
{
    // Hapus session
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    header('Location: ' . baseUrl());
    exit;
}

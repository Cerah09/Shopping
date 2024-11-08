<?php

require_once __DIR__ . '/components/header.php';

if (isset($_SESSION['user_id'])) {
    // Redirect jika user sudah login
    header('Location: ' . baseUrl());
    exit;
}

$message     = ''; // Untuk menyimpan pesan hasil pendaftaran
$messageType = ''; // Untuk menyimpan tipe pesan (success atau error)

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $register = [
        'nama'      => $_POST['name'],
        'email'     => $_POST['email'],
        'phone'     => $_POST['phone'],
        'address'   => $_POST['address'],
        'password'  => $_POST['password'],
        'password2' => $_POST['confirm-password'],
    ];

    // Panggil fungsi Register dan simpan hasilnya
    $registerResult = Register($register);

    if ($registerResult === "Pendaftaran berhasil!") {
        $message     = $registerResult;
        $messageType = 'success'; // Jika sukses, beri tipe 'success'
    } else {
        $message     = $registerResult;
        $messageType = 'error'; // Jika gagal, beri tipe 'error'
    }
}
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Register</h2>

                    <!-- Kondisi untuk menampilkan pesan alert -->
                    <?php if ($message): ?>
                    <?php if ($messageType === 'success'): ?>
                    <div class="alert alert-info text-center">
                        <?=htmlspecialchars($message) . ' <a href="' . baseUrl('/login') . '">Login</a> sekarang untuk mulai berbelanja dan temukan penawaran menarik kami!'?>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-danger text-center">
                        <?=htmlspecialchars($message)?>
                    </div>
                    <?php endif;?>
                    <?php endif;?>

                    <form method="POST" action="<?=baseUrl('/register')?>">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="name" required
                                    value="<?=$messageType === 'error' && isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''?>">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required
                                    value="<?=$messageType === 'error' && isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="phone" class="form-label">No Telepon</label>
                                <input type="text" name="phone" class="form-control" id="phone" required
                                    value="<?=$messageType === 'error' && isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''?>">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea name="address" class="form-control"
                                    id="address"><?=$messageType === 'error' && isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''?></textarea>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="confirm-password" class="form-control"
                                    id="confirm-password" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-6">
                                    <a href="<?=baseUrl()?>" class="">
                                        Back to Home
                                    </a>
                                </div>
                                <div class="col-6 text-end">
                                    <span>
                                        Already have an account?
                                        <a href="<?=baseUrl('/login')?>" class="">
                                            Log in
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/components/footer.php';
?>
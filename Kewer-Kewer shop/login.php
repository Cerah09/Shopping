<?php

require_once __DIR__ . '/components/header.php';

if (isset($_SESSION['user_id'])) {
    // Redirect jika user sudah login
    header('Location: ' . baseUrl());
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginData = [
        'email'       => $_POST['email'],
        'password'    => $_POST['password'],
        'remember_me' => isset($_POST['remember_me']),
    ];

    $loginResult = Login($loginData);

    if ($loginResult === "Login berhasil!") {
        // Redirect ke halaman home setelah berhasil login
        header('Location: ' . baseUrl());
        exit;
    } else {
        // Tampilkan pesan error
        $message = $loginResult;
    }
}
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    <form method="POST" action="">

                        <!-- message -->
                        <?php if (!empty($message)): ?>
                        <div class="alert alert-danger">
                            <?=$message?>
                        </div>
                        <?php endif;?>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required
                                value="<?=isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me"
                                <?=isset($_POST['remember_me']) ? 'checked' : ''?>>
                            <label class="form-check-label" for="remember_me">Ingat saya</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-6">
                                    <a href="<?=baseUrl()?>" class="">
                                        Back to Home
                                    </a>
                                </div>
                                <div class="col-6 text-end">
                                    <span>
                                        Don't have an account?
                                        <a href="<?=baseUrl('/register')?>" class="">
                                            Sign up
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
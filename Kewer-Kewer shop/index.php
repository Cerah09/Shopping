<?php
require_once __DIR__ . '/components/header.php';

/*
if (!isset($_SESSION['user_id'])) {
Redirect jika user belum login
header('Location: ' . baseUrl('/login'));
exit;
}

<?=isset($_SESSION['user_name']) ? "Selamat datang, " . $_SESSION['user_name'] : "";?>
*/
?>

<?=component('navbar');?>



<?php
require_once __DIR__ . '/components/footer.php';
?>
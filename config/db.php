<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'kasir_db';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'proses_login.php') {
    header('Location: ../login.php');
    exit;
}
?>

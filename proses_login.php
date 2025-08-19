<?php
session_start();
include 'config/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE username = '$username'");
$user = $result->fetch_assoc();

if ($user && $password === $user['password']) {
    $_SESSION['user'] = $user['username'];
    header('Location: index.php');
} else {
    header('Location: login.php?error=1');
}
?>

<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM menu WHERE id = $id");
}

header('Location: menu.php');
exit;
?>

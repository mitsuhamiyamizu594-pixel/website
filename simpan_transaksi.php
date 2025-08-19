<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu'])) {
    $menu_ids = $_POST['menu'];
    $qtys     = $_POST['qty'];
    $pelanggan = $conn->real_escape_string($_POST['pelanggan'] ?? 'Umum');

    $total = 0;

    // Hitung total
    foreach ($menu_ids as $id) {
        $id = intval($id);
        $qty = intval($qtys[$id]);
        if ($qty < 1) continue;

        $menu = $conn->query("SELECT * FROM menu WHERE id = $id")->fetch_assoc();
        if (!$menu) continue;

        $subtotal = $menu['harga'] * $qty;
        $total += $subtotal;
    }

    // Simpan transaksi (sudah include nama pelanggan)
    $conn->query("INSERT INTO transaksi (pelanggan, total) VALUES ('$pelanggan', $total)");
    $id_transaksi = $conn->insert_id;

    // Simpan detail transaksi
    foreach ($menu_ids as $id) {
        $id = intval($id);
        $qty = intval($qtys[$id]);
        if ($qty < 1) continue;

        $menu = $conn->query("SELECT * FROM menu WHERE id = $id")->fetch_assoc();
        if (!$menu) continue;

        $subtotal = $menu['harga'] * $qty;

        $conn->query("INSERT INTO detail_transaksi (id_transaksi, id_menu, qty, subtotal) 
                      VALUES ($id_transaksi, $id, $qty, $subtotal)");
    }

    header('Location: pages/riwayat.php');
    exit();
} else {
    echo "<script>alert('Tidak ada menu yang dipilih.');window.history.back();</script>";
    exit();
}
?>

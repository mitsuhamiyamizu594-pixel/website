<?php
include '../config/db.php';

if (!isset($_GET['id'])) {
    header('Location: riwayat.php');
    exit;
}

$id = intval($_GET['id']);
$transaksi = $conn->query("SELECT * FROM transaksi WHERE id = $id")->fetch_assoc();
$detail = $conn->query("
    SELECT dt.*, m.nama 
    FROM detail_transaksi dt
    JOIN menu m ON dt.id_menu = m.id
    WHERE dt.id_transaksi = $id
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi - Njoo Coffee & Chocolate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7e8d0;
            margin: 0;
        }
        .sidebar {
            background-color: #6f4e37;
            color: white;
            height: 100vh;
            width: 220px;
            position: fixed;
            padding: 20px;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #8b5e3c;
        }
        .content {
            margin-left: 220px;
            padding: 40px;
        }
        footer {
            background-color: #6f4e37;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4><i class="bi bi-cup-hot-fill"></i> Njoo Coffee</h4>
    <a href="../dashboard.php"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
    <a href="menu.php"><i class="bi bi-list-ul me-2"></i>Kelola Menu</a>
    <a href="transaksi.php"><i class="bi bi-cash-stack me-2"></i>Transaksi</a>
    <a href="riwayat.php"><i class="bi bi-clock-history me-2"></i>Riwayat</a>
    <a href="../logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<!-- Main Content -->
<div class="content">
    <h2 class="mb-4"><i class="bi bi-receipt-cutoff me-2"></i>Detail Transaksi #<?= $transaksi['id']; ?></h2>

    <div class="mb-3">
        <p><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($transaksi['pelanggan']); ?></p>
        <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal'])); ?></p>
        <p><strong>Total:</strong> Rp<?= number_format($transaksi['total'], 0, ',', '.'); ?></p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Menu</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($detail->num_rows > 0): ?>
                        <?php while ($row = $detail->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= $row['qty']; ?></td>
                            <td>Rp<?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada item.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <a href="cetak_nota.php?id=<?= $transaksi['id']; ?>" target="_blank" class="btn btn-warning mt-3">
    <i class="bi bi-printer"></i> Cetak Nota
</a>

            <a href="riwayat.php" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>
</div>

<footer>
    &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
</footer>

</body>
</html>

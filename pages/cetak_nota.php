<?php
include '../config/db.php';

if (!isset($_GET['id'])) {
    echo "ID tidak valid.";
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
    <title>Cetak Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .nota {
            max-width: 400px;
            margin: auto;
        }

        .nota h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="nota">
    <h4>Njoo Coffee & Chocolate</h4>
    <p><strong>Nota Transaksi</strong></p>
    <p>ID: #<?= $transaksi['id']; ?><br>
       Pelanggan: <?= htmlspecialchars($transaksi['pelanggan']); ?><br>
       Tanggal: <?= date('d/m/Y H:i', strtotime($transaksi['tanggal'])); ?></p>

    <table class="table table-sm table-borderless">
        <thead>
            <tr>
                <th>Menu</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $detail->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td class="text-end"><?= $row['qty']; ?></td>
                <td class="text-end">Rp<?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <hr>
    <p class="text-end"><strong>Total: Rp<?= number_format($transaksi['total'], 0, ',', '.'); ?></strong></p>

    <p class="text-center mt-4">Terima kasih telah berkunjung! ☕</p>
</div>

</body>
</html>

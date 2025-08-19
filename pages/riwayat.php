<?php
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Transaksi - Njoo Coffee & Chocolate</title>
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
      height: 100vh;
      padding: 20px;
      color: #fff;
      position: fixed;
      width: 220px;
    }

    .sidebar h4 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: #fff;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: 0.3s;
    }

    .sidebar a:hover {
      background-color: #8b5e3c;
    }

    .content {
      margin-left: 220px;
      padding: 40px;
    }

    .card {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    footer {
      margin-top: 60px;
      padding: 20px;
      text-align: center;
      background-color: #6f4e37;
      color: #fff;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .content {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4><i class="bi bi-cup-hot-fill"></i> Njoo Coffee</h4>
  <a href="../index.php"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
  <a href="menu.php"><i class="bi bi-list-ul me-2"></i>Kelola Menu</a>
  <a href="transaksi.php"><i class="bi bi-cash-stack me-2"></i>Transaksi</a>
  <a href="riwayat.php"><i class="bi bi-clock-history me-2"></i>Riwayat</a>
  <a href="../logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<!-- Content -->
<div class="content">
  <div class="card">
    <h2 class="mb-4 text-dark"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi</h2>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>ID Transaksi</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("SELECT * FROM transaksi ORDER BY tanggal DESC");
          while ($row = $result->fetch_assoc()):
          ?>
          <tr>
            <td>#<?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['pelanggan']); ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['tanggal'])); ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
            <td>
              <a href="detail_transaksi.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-info">
                <i class="bi bi-eye"></i> Detail
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
          <?php if ($result->num_rows === 0): ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada transaksi.</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">
      <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
  </div>
</div>

<!-- Footer -->
<footer>
  &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
</footer>

</body>
</html>

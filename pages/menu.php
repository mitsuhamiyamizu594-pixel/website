<?php
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Menu - Njoo Coffee & Chocolate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f7e8d0;
      margin: 0;
      padding: 0;
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
      margin-bottom: 30px;
      text-align: center;
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
      background-color: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn-primary {
      background-color: #6f4e37;
      border-color: #6f4e37;
    }

    .btn-primary:hover {
      background-color: #5c3e2e;
      border-color: #5c3e2e;
    }

    .btn-warning, .btn-danger {
      font-size: 0.9rem;
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

<div class="wrapper d-flex flex-column min-vh-100">

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
  <div class="content flex-grow-1">
    <h2 class="mb-4 text-dark"><i class="bi bi-list-ul me-2"></i>Data Menu</h2>

    <div class="card mb-4">
      <a href="tambah.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Menu
      </a>

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>Nama Menu</th>
              <th>Jenis</th>
              <th>Harga</th>
              <th style="width: 150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $menu = $conn->query("SELECT * FROM menu ORDER BY nama ASC");
            while ($row = $menu->fetch_assoc()) {
              echo "<tr>
                      <td>" . htmlspecialchars($row['nama']) . "</td>
                      <td>" . htmlspecialchars($row['jenis']) . "</td>
                      <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                      <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning me-1'>
                          <i class='bi bi-pencil-square'></i> Edit
                        </a>
                        <a href='hapus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus menu ini?');\">
                          <i class='bi bi-trash'></i> Hapus
                        </a>
                      </td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <a href="../index.php" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
  </div>

  <!-- Footer -->
  <footer>
    &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
  </footer>

</div>

</body>
</html>

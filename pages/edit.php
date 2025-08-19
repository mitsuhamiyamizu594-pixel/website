<?php
include '../config/db.php';

if (!isset($_GET['id'])) {
    header('Location: menu.php');
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM menu WHERE id = $id");
if ($result->num_rows == 0) {
    header('Location: menu.php');
    exit;
}

$menu = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = $conn->real_escape_string($_POST['nama']);
    $jenis = $conn->real_escape_string($_POST['jenis']);
    $harga = intval($_POST['harga']);

    $conn->query("UPDATE menu SET nama = '$nama', jenis = '$jenis', harga = $harga WHERE id = $id");
    header('Location: menu.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu - Njoo Coffee & Chocolate</title>
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

    .form-container {
      max-width: 600px;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn-primary {
      background-color: #6f4e37;
      border: none;
    }

    .btn-primary:hover {
      background-color: #5c3e2e;
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

<div class="sidebar">
  <h4><i class="bi bi-cup-hot-fill"></i> Njoo Coffee</h4>
  <a href="../index.php"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
  <a href="menu.php"><i class="bi bi-list-ul me-2"></i>Kelola Menu</a>
  <a href="transaksi.php"><i class="bi bi-cash-stack me-2"></i>Transaksi</a>
  <a href="riwayat.php"><i class="bi bi-clock-history me-2"></i>Riwayat</a>
  <a href="../logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<div class="content flex-grow-1">
    <h2 class="mb-4 text-dark"><i class="bi bi-list-ul me-2"></i>Data Menu</h2>

  <div class="form-container">

    <form method="POST">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Menu</label>
        <input type="text" name="nama" id="nama" class="form-control" required value="<?= htmlspecialchars($menu['nama']) ?>">
      </div>

      <div class="mb-3">
        <label for="jenis" class="form-label">Jenis Menu</label>
        <select name="jenis" id="jenis" class="form-select" required>
          <option value="">-- Pilih Jenis --</option>
          <option value="Makanan" <?= $menu['jenis'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
          <option value="Minuman" <?= $menu['jenis'] == 'Minuman' ? 'selected' : '' ?>>Minuman</option>
          <option value="Camilan" <?= $menu['jenis'] == 'Camilan' ? 'selected' : '' ?>>Camilan</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" required value="<?= $menu['harga'] ?>">
      </div>

      <div class="d-flex justify-content-between">
        <a href="menu.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
      </div>
    </form>
  </div>
</div>

<footer>
  &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
</footer>

</body>
</html>

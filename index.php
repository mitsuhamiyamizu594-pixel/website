<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Kasir - Njoo Coffee & Chocolate</title>
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

    .btn-dashboard {
      padding: 30px;
      font-size: 1.1rem;
      border-radius: 15px;
      transition: all 0.3s ease;
    }

    .btn-dashboard:hover {
      transform: translateY(-5px);
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
  <div class="sidebar">
    <h4><i class="bi bi-cup-hot-fill"></i> Njoo Coffee</h4>
    <a href="dashboard.php"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
    <a href="pages/menu.php"><i class="bi bi-list-ul me-2"></i>Kelola Menu</a>
    <a href="pages/transaksi.php"><i class="bi bi-cash-stack me-2"></i>Transaksi</a>
    <a href="pages/riwayat.php"><i class="bi bi-clock-history me-2"></i>Riwayat</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
  </div>

  <!-- Content -->
  <div class="content flex-grow-1">
    <h2 class="mb-5 text-dark">Selamat Datang, Kasir</h2>

    <div class="row g-4">
      <div class="col-md-4">
        <a href="pages/menu.php" class="btn btn-outline-primary w-100 btn-dashboard">
          <i class="bi bi-list-ul me-2"></i> Kelola Menu
        </a>
      </div>
      <div class="col-md-4">
        <a href="pages/transaksi.php" class="btn btn-outline-success w-100 btn-dashboard">
          <i class="bi bi-cash-stack me-2"></i> Transaksi
        </a>
      </div>
      <div class="col-md-4">
        <a href="pages/riwayat.php" class="btn btn-outline-dark w-100 btn-dashboard">
          <i class="bi bi-clock-history me-2"></i> Riwayat
        </a>
      </div>
    </div>
  </div>
  <footer class="mt-auto">
      &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
    </footer>
</div>
</body>
</html>

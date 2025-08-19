<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Transaksi - Njoo Coffee & Chocolate</title>
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
    <h2 class="mb-4 text-dark"><i class="bi bi-cash-stack me-2"></i>Transaksi</h2>

    <form method="POST" action="../simpan_transaksi.php" id="formTransaksi">
      <div class="mb-3">
        <label for="pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" name="pelanggan" id="pelanggan" class="form-control" required>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle" id="tabelTransaksi">
          <thead class="table-light">
            <tr>
              <th>Pilih</th>
              <th>Nama Menu</th>
              <th>Jenis</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $menu = $conn->query("SELECT * FROM menu ORDER BY jenis ASC, nama ASC");
            while ($row = $menu->fetch_assoc()) {
              echo "<tr>
                      <td><input type='checkbox' name='menu[]' value='{$row['id']}' class='pilih'></td>
                      <td>" . htmlspecialchars($row['nama']) . "</td>
                      <td>" . htmlspecialchars($row['jenis']) . "</td>
                      <td class='harga' data-harga='{$row['harga']}'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                      <td><input type='number' name='qty[{$row['id']}]' value='1' class='form-control qty' style='width:80px;' min='1' disabled></td>
                      <td class='subtotal'>Rp 0</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-between align-items-center mt-3">
        <strong class="fs-5">Total: <span id="totalHarga">Rp 0</span></strong>
        <div>
          <a href="../index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
          <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Transaksi</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Footer -->
<footer>
  &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
</footer>

<!-- JavaScript: Hitung Total -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.pilih');
  const totalSpan = document.getElementById('totalHarga');
  const qtyInputs = document.querySelectorAll('.qty');
  const rows = document.querySelectorAll('#tabelTransaksi tbody tr');

  function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID');
  }

  function updateTotal() {
    let total = 0;
    rows.forEach(row => {
      const checkbox = row.querySelector('.pilih');
      const qtyInput = row.querySelector('.qty');
      const harga = parseInt(row.querySelector('.harga').dataset.harga);
      const subtotalTd = row.querySelector('.subtotal');

      if (checkbox.checked) {
        qtyInput.disabled = false;
        if (!qtyInput.value || qtyInput.value == 0) {
          qtyInput.value = 1; // set default qty
        }
        const qty = parseInt(qtyInput.value);
        const subtotal = harga * qty;
        subtotalTd.textContent = formatRupiah(subtotal);
        total += subtotal;
      } else {
        qtyInput.disabled = true;
        subtotalTd.textContent = 'Rp 0';
      }
    });
    totalSpan.textContent = formatRupiah(total);
  }

  // Event listener
  checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
  qtyInputs.forEach(qty => qty.addEventListener('input', updateTotal));

  updateTotal(); // panggil pertama kali
});
</script>

</body>
</html>

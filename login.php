<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Njoo Coffee & Chocolate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7e8d0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-container {
            max-width: 400px;
            background: #fff;
            padding: 40px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #6f4e37;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #6f4e37;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5c3e2e;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Kasir</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">Login gagal! Periksa username dan password.</div>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Njoo Coffee & Chocolate. All rights reserved.
</div>

</body>
</html>

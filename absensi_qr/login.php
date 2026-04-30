<?php
session_start();
include "koneksi.php";

$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        $_SESSION['email'] = $data['email'];
        $_SESSION['unit'] = $data['unit'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Yayasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="text-center">
            <img src="logo.png" class="logo mb-2">
            <h4 class="login-title">YAYASAN AL-ISTIQOMAH</h4>
            <p class="text-muted small">Silakan masuk ke sistem</p>
        </div>

        <?php if($error != ""): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control custom-input" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control custom-input" required>
            </div>

            <button type="submit" class="btn btn-login w-100">
                MASUK
            </button>
        </form>

    </div>
</div>

</body>
</html>
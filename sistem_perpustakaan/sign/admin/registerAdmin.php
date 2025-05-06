<?php
require "../../loginSystem/connect.php";

if (isset($_POST["register"])) {
    $nama = strtolower(trim($_POST["nama_admin"]));
    $password = trim($_POST["password"]);

    // Cek apakah nama admin sudah ada
    $cek = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Nama admin sudah digunakan!";
    } else {
        // Simpan ke database
        mysqli_query($connect, "INSERT INTO admin (nama_admin, password) VALUES ('$nama', '$password')");
        $success = "Admin berhasil ditambahkan. Silakan login.";
        header("refresh:2; url=loginAdmin.php"); // Ganti sesuai file loginmu
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Admin Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <div class="card p-4">
    <h3 class="text-center">Registrasi Admin Baru</h3>
    <form action="" method="post" class="needs-validation" novalidate>
      <div class="mb-3">
        <label for="nama_admin" class="form-label">Nama Admin</label>
        <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" onclick="history.back()">← Kembali</button>
        <button type="submit" class="btn btn-primary" name="register">Daftar</button>
      </div>
    </form>
    
    <?php if(isset($error)) : ?>
      <div class="alert alert-danger mt-2"><?= $error ?></div>
    <?php endif; ?>
    
    <?php if(isset($success)) : ?>
      <div class="alert alert-success mt-2"><?= $success ?></div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>

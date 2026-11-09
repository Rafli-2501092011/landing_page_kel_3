<?php
require '../koneksi.php';
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = mysqli_query($db, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
  $cek = mysqli_num_rows($sql);

  if ($cek > 0) {
    $_SESSION['username'] = $username;
    header("Location: ../CRUD/index.php");
    exit;
  } else {
    echo "<script>
              alert('Username atau Password salah!');
              window.location='login.php';
              </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="admin authentication page">
  <title>Login | Toko Kayla Aletha</title>

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/authStyle.css">
  
</head>

<body class="auth-body">


  <div class="auth-page">
    <section class="auth-card">

      <!-- header form login -->
      <a class="auth-brand" href="../index.php">
        <span class="brand-icon">
          <i class="bi bi-shop" aria-hidden="true"></i>
        </span>

        <span>
          <strong>Toko Kayla Aletha</strong>
          <small>Sign in to your admin workspace.</small>
        </span>
      </a>

      <!-- gambar library -->
      <div class="auth-visual">
        <img src="../gambar/logoToko.png" alt="admin dashboard interface">
      </div>

      <!-- form login -->
      <form method="POST" class="needs-validation" novalidate>

        <!-- label login -->
        <div class="mb-4">
          <p class="eyebrow mb-1">Secure Access</p>
          <h1 class="h3 mb-1">Login</h1>
          <p class="text-muted mb-0">Sign in to your admin workspace.</p>
        </div>

        <!-- bagian username -->
        <div class="mb-3">
          <label class="form-label" for="loginEmail">username</label>
          <input class="form-control" id="loginEmail" type="text" name="username" required>
          <div class="invalid-feedback">Username is invalid username.</div>
        </div>

        <!-- bagian password -->
        <div class="mb-3">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="loginPassword">Password</label>
          </div>

          <input name="password" class="form-control" id="loginPassword" type="password" minlength="6" required>
          <div class="invalid-feedback">Password must be at least 6 characters.</div>
        </div>

        <!-- tombol login -->
        <button name="submit" class="btn btn-primary w-100" type="submit"><i class="bi bi-box-arrow-in-right"
            aria-hidden="true"></i>
          Sign In</button>
      </form>

      
    </section>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>
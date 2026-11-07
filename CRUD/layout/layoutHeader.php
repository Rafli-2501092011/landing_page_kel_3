<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Toko Kayla Aletha</title>
  <link href="../style1.css" rel="stylesheet">

</head>

<body>

  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="light">
    <div class="container-fluid">

      <a class="navbar-brand" href="index.php?landing_page_kel_3=home">Kayla Aletha Mart  | </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" style="color: black" href="index.php?landing_page_kel_3=barang/barang">Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color: black" href="index.php?landing_page_kel_3=informasi_toko/informasi">Informasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color: black" href="#../index.php?">Landing Page</a>
          </li>


        </ul>
        <a class="nav-link" href="../admin/logout.php">
          <button class="btn btn-outline-success" style="color: black">Logout</button>
        </a>
      </div>
    </div>
  </nav>

  <?php if (isset($_SESSION['pesan'])): ?>
    <div class="alert alert-<?= $_SESSION['pesan']['tipe'] ?> alert-dismissible">
      <?= $_SESSION['pesan']['teks'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['pesan']); ?>
  <?php endif; ?>
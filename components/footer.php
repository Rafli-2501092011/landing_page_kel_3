<?php
// Pastikan koneksi sudah disertakan ($db)
$query = mysqli_query($db, "SELECT * FROM informasi_toko WHERE id = 1");
$toko = mysqli_fetch_assoc($query);
?>

<footer id="footer" class="py-5" style="background-color: #EAF1FB;">
  <div class="container-lg">
    <div class="row">

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer-menu">
          <img src="gambar/logoToko.png" width="240" height="70" alt="logo toko">
          <div class="social-links mt-3">
            <ul class="d-flex list-unstyled gap-2">
              <p class="mt-3" style="max-width: 300px; line-height: 1.4;"><?= htmlspecialchars($toko['slogan']); ?></p>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-6">
        <div class="footer-menu">
          <h5 class="widget-title">Tentang Kami</h5>
          <ul class="menu-list list-unstyled">
            <li class="menu-item"><a href="#informasi-toko" class="nav-link">Profil Toko</a></li>
            <li class="menu-item"><a href="https://maps.app.goo.gl/v81JwgmDFu1YUC8Q7" target="_blank"
                class="nav-link">Lokasi</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-2 col-sm-6">
        <div class="footer-menu">
          <h5 class="widget-title">Kategori</h5>
          <ul class="menu-list list-unstyled">
            <li class="menu-item"><a href="#makanan-instan" class="nav-link">Makanan Instan</a></li>
            <li class="menu-item"><a href="#minuman" class="nav-link">Minuman</a></li>
            <li class="menu-item"><a href="#snack" class="nav-link">Snack</a></li>
            <li class="menu-item"><a href="#bumbu-dapur" class="nav-link">Bumbu Dapur</a></li>
            <li class="menu-item"><a href="#alat-tulis" class="nav-link">Alat Tulis</a></li>
            <li class="menu-item"><a href="#perlengkapan-mandi" class="nav-link">Perlengkapan Mandi</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-2 col-sm-6">
        <div class="footer-menu">
          <h5 class="widget-title">Hubungi Kami</h5>
          <ul class="menu-list list-unstyled">
            <li class="menu-item"><?= htmlspecialchars($toko['alamat']); ?></li>
            <li class="menu-item"><a href="https://wa.me/6281276535870" class="nav-link">WhatsApp:
                <?= htmlspecialchars($toko['wa']); ?></a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer-menu">
          <h5 class="widget-title">Jam Buka</h5>
          <p>Senin – Minggu<br><?= htmlspecialchars($toko['jam_buka']); ?></p>
        </div>
      </div>


    </div>
  </div>
</footer>

<div id="footer-bottom">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-6 copyright">
        <p>© 2026 Kayla Aletha Mart. Hak cipta dilindungi</p>
      </div>

    </div>
  </div>
</div>
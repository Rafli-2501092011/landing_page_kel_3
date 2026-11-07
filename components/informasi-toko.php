<?php
// Pastikan koneksi sudah disertakan ($db)
$query = mysqli_query($db, "SELECT * FROM informasi_toko WHERE id = 1");
$toko = mysqli_fetch_assoc($query);
?>

<section id="informasi-toko" class="pb-4 my-4">
  <div class="container-lg">
    <div class="pt-5 pb-5 px-4 rounded-5 shadow-sm" style="background-color: #FFF1D6;">
      <div class="container">
        <div class="row align-items-center justify-content-between g-4">

          <div class="col-lg-6">
            <span class="badge bg-warning text-dark mb-2 px-3 py-2 rounded-pill fw-semibold">Tentang Kami</span>
            <h2 class="fw-bold mb-3" style="color: #333;">Kayla Aletha Mart</h2>
            <p class="text-secondary lh-lg mb-4">
              <?= htmlspecialchars($toko['deskripsi']); ?>
            </p>

            <div class="d-flex gap-3 align-items-center">
              <a href="#all-produk" class="btn btn-dark rounded-pill px-4 py-2">Lihat Produk</a>
              <div class="text-muted small">
                <i class="bi bi-geo-alt-fill text-danger"></i> Buka Setiap Hari
              </div>
            </div>
          </div>

          <div class="col-lg-5 text-center">
            <div class="mb-3">
              <img src="gambar/<?= htmlspecialchars($toko['logo']); ?>" alt="Logo Kayla Aletha Mart" class="img-fluid rounded-4 shadow-sm"
                style="max-height: 250px; object-fit: contain;">
            </div>
            <div>
              <a href="<?= htmlspecialchars($toko['maps_url']); ?>" target="_blank">
                <img src="gambar/<?= htmlspecialchars($toko['lokasi_img']); ?>" alt="Lokasi Kayla Aletha Mart"
                  class="img-fluid rounded-4 shadow-sm border border-white border-3"
                  style="max-height: 180px; width: 100%; object-fit: cover;">
              </a>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
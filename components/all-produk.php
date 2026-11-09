<?php
// Ambil kata kunci pencarian
$keyword = isset($_GET['kata']) ? trim($_GET['kata']) : '';

$daftarKategori = [
  'Makanan Instan',
  'Minuman',
  'Snack',
  'Bumbu Dapur',
  'Alat Tulis',
  'Perlengkapan Mandi',
];

$foundMatchCategory = '';

foreach ($daftarKategori as $kategori):
  $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $kategori), '-'));

  // Ambil semua produk per kategori tanpa menghilangkan kategori lain
  $stmt = mysqli_prepare($db, "SELECT * FROM barang WHERE kategori = ?");
  mysqli_stmt_bind_param($stmt, "s", $kategori);
  mysqli_stmt_execute($stmt);
  $hasil = mysqli_stmt_get_result($stmt);

  // Cek apakah ada barang di kategori ini yang cocok dengan pencarian untuk target scroll
  $isMatch = false;
  if (!empty($keyword)) {
    while($rowMatch = mysqli_fetch_assoc($hasil)) {
      if (stripos($rowMatch['nama'], $keyword) !== false || stripos($rowMatch['kategori'], $keyword) !== false) {
        $isMatch = true;
        break;
      }
    }
    mysqli_data_seek($hasil, 0);
    
    if ($isMatch && empty($foundMatchCategory)) {
      $foundMatchCategory = $slug;
    }
  }
  ?>

  <section id="all-produk">
    <section id="<?= $slug ?>" class="pb-5">
      <div class="container-lg">

        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title"><?= htmlspecialchars($kategori) ?></h2>

          <!-- <div class="d-flex align-items-center">
            <div class="swiper-buttons">
              <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
            </div>
          </div> -->
        </div>

        <?php if (mysqli_num_rows($hasil) === 0): ?>
          <p>Belum ada barang di kategori ini.</p>
        <?php endif; ?>

        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3">
          <?php while ($b = mysqli_fetch_assoc($hasil)): ?>
            <div class="col">
              <div class="product-item">
                <figure>
                  <img src="gambar/<?= htmlspecialchars($b['gambar']) ?>" alt="<?= htmlspecialchars($b['nama']) ?>"
                    class="tab-image">
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-6 fw-normal"><?= htmlspecialchars($b['nama']) ?></h3>
                  <div>
                    <span class="rating">
                      <?php for ($i = 1; $i <= 5; $i++):
                        if ($b['rating'] >= $i): ?>
                          <svg width="18" height="18" class="text-warning">
                            <use xlink:href="#star-full"></use>
                          </svg>
                        <?php elseif ($b['rating'] >= $i - 0.5): ?>
                          <svg width="18" height="18" class="text-warning">
                            <use xlink:href="#star-half"></use>
                          </svg>
                        <?php endif; endfor; ?>
                    </span>
                    <span>(<?= number_format($b['rating'], 1, ',', '.') ?>)</span>
                  </div>
                  <span class="text-dark fw-semibold">Rp <?= number_format($b['harga'], 0, ',', '.') ?></span>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

      </div>
    </section>
  </section>
<?php endforeach; ?>

<!-- Script JavaScript untuk otomatis mengarahkan (scroll) ke kategori yang cocok -->
<?php if (!empty($foundMatchCategory)): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const targetElement = document.getElementById('<?= $foundMatchCategory; ?>');
    if (targetElement) {
      targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });
</script>
<?php endif; ?>
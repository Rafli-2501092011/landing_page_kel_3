<?php
$keyword = isset($_GET['kata']) ? trim($_GET['kata']) : '';

$stmt = mysqli_prepare($db, "SELECT * FROM barang ORDER BY rating DESC LIMIT 10");
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
?>

<section id="produk-terlaris" class="pb-5">
  <div class="container-lg">

    <div class="section-header d-flex flex-wrap justify-content-between my-4">
      <h2 class="section-title">Produk Terlaris</h2>

      <div class="d-flex align-items-center">
        <a href="#all-produk" class="btn btn-primary me-2">Lihat Semua</a>
      </div>
    </div>

    <?php if (mysqli_num_rows($hasil) === 0): ?>
      <p>Belum ada produk.</p>
    <?php endif; ?>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3">
      <?php while ($b = mysqli_fetch_assoc($hasil)):
        $isProductMatch = false;
        $namaProduk = htmlspecialchars($b['nama']);

        if (!empty($keyword)) {
          if (stripos($b['nama'], $keyword) !== false || stripos($b['kategori'], $keyword) !== false) {
            $isProductMatch = true;
            $esc = preg_quote(htmlspecialchars($keyword), '/');
            $namaProduk = preg_replace('/(' . $esc . ')/i', '<mark class="search-highlight">$1</mark>', $namaProduk);
          }
        }
      ?>
        <div class="col">
          <div class="product-item <?= $isProductMatch ? 'is-match search-match-item' : '' ?>">
            <?php if ($isProductMatch): ?>
              <span class="search-match-badge">Ditemukan</span>
            <?php endif; ?>
            <figure>
              <img src="gambar/<?= htmlspecialchars($b['gambar']) ?>" alt="<?= htmlspecialchars($b['nama']) ?>"
                class="tab-image">
            </figure>
            <div class="d-flex flex-column text-center">
              <h3 class="fs-6 fw-normal"><?= $namaProduk ?></h3>
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
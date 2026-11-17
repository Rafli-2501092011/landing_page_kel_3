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

// Hitung total kecocokan dan siapkan data
$totalMatch = 0;
$firstMatchIdAssigned = false;
?>

<style>
  .product-item.is-match {
    border: 2px solid #ffc107 !important;
    box-shadow: 0 0 18px rgba(255, 193, 7, 0.5) !important;
    position: relative;
    background-color: #fffdf5 !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }
  .product-item.is-match:hover {
    box-shadow: 0 0 24px rgba(255, 193, 7, 0.75) !important;
  }
  mark.search-highlight {
    background-color: #ffe066;
    color: #111;
    font-weight: 600;
    padding: 1px 4px;
    border-radius: 3px;
  }
  .search-match-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ffc107;
    color: #212529;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 4px;
    z-index: 2;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
  }
</style>

<section id="all-produk">
  <div class="container-lg">
    <?php if (!empty($keyword)): ?>
      <div id="search-result-banner" class="alert alert-light border border-warning shadow-sm mt-4 mb-2 d-flex flex-wrap justify-content-between align-items-center">
        <div>
          <span class="fs-5">🔍</span>
          Pencarian untuk: <strong class="text-primary"><?= htmlspecialchars($keyword) ?></strong>
          <span class="text-muted ms-2">(Barang yang cocok ditandai highlight kuning)</span>
        </div>
        <a href="index.php" class="btn btn-sm btn-outline-secondary mt-2 mt-md-0">✕ Reset Pencarian</a>
      </div>
    <?php endif; ?>
  </div>

  <?php
  foreach ($daftarKategori as $kategori):
    $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $kategori), '-'));

    // Ambil semua produk per kategori
    $stmt = mysqli_prepare($db, "SELECT * FROM barang WHERE kategori = ?");
    mysqli_stmt_bind_param($stmt, "s", $kategori);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
  ?>

    <section id="<?= $slug ?>" class="pb-5">
      <div class="container-lg">

        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title"><?= htmlspecialchars($kategori) ?></h2>
        </div>

        <?php if (mysqli_num_rows($hasil) === 0): ?>
          <p>Belum ada barang di kategori ini.</p>
        <?php endif; ?>

        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3">
          <?php while ($b = mysqli_fetch_assoc($hasil)):
            $isProductMatch = false;
            $namaProduk = htmlspecialchars($b['nama']);

            if (!empty($keyword)) {
              if (stripos($b['nama'], $keyword) !== false || stripos($b['kategori'], $keyword) !== false) {
                $isProductMatch = true;
                $totalMatch++;
                $esc = preg_quote(htmlspecialchars($keyword), '/');
                $namaProduk = preg_replace('/(' . $esc . ')/i', '<mark class="search-highlight">$1</mark>', $namaProduk);
              }
            }

            $firstAttr = '';
            if ($isProductMatch && !$firstMatchIdAssigned) {
              $firstAttr = 'id="first-search-match"';
              $firstMatchIdAssigned = true;
            }
          ?>
            <div class="col">
              <div <?= $firstAttr ?> class="product-item <?= $isProductMatch ? 'is-match search-match-item' : '' ?>">
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
  <?php endforeach; ?>
</section>

<!-- Script JavaScript untuk otomatis mengarahkan (scroll) ke produk pertama yang cocok dengan offset yang pas (tidak offside) -->
<?php if (!empty($keyword)): ?>
<script>
  (function() {
    function scrollToMatch() {
      const targetElement = document.getElementById('first-search-match') || document.getElementById('search-result-banner');
      if (targetElement) {
        // Gunakan offset agar elemen berada pas di bawah header/navbar dan tidak offside/terpotong
        const navbarHeight = 120;
        const rect = targetElement.getBoundingClientRect();
        const targetPosition = rect.top + window.pageYOffset - navbarHeight;

        window.scrollTo({
          top: Math.max(0, targetPosition),
          behavior: 'smooth'
        });
      }
    }

    // Jalankan saat load selesai atau setelah timeout agar render gambar & preloader stabil
    if (document.readyState === 'complete') {
      setTimeout(scrollToMatch, 350);
    } else {
      window.addEventListener('load', () => {
        setTimeout(scrollToMatch, 350);
      });
      // Fallback jika event load sudah lewat
      document.addEventListener('DOMContentLoaded', () => {
        setTimeout(scrollToMatch, 400);
      });
    }
  })();
</script>
<?php endif; ?>
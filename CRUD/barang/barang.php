<?php
include "../koneksi.php";
$keyword = isset($_GET['cari_barang']) ? trim($_GET['cari_barang']) : '';

if ($keyword !== '') {
    $stmt = mysqli_prepare($db, "SELECT * FROM barang WHERE nama LIKE ? OR kategori LIKE ?");
    $like = "%$keyword%";
    mysqli_stmt_bind_param($stmt, "ss", $like, $like);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
} else {
    $data = mysqli_query($db, "SELECT * FROM barang");
}
?>

<div class="container">
    <h1>Kelola Barang Toko</h1>

    <!-- Search Bar -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body py-2">
            <form method="GET" action="" class="d-flex gap-2 align-items-center">
                <input type="hidden" name="landing_page_kel_3" value="barang/barang">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i>🔍</span>
                    <input
                        type="search"
                        name="cari_barang"
                        id="cari_barang"
                        class="form-control"
                        placeholder="Cari nama atau kategori barang..."
                        value="<?= htmlspecialchars($keyword) ?>"
                        autofocus
                    >
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <?php if ($keyword !== ''): ?>
                        <a href="index.php?landing_page_kel_3=barang/barang" class="btn btn-outline-secondary">Reset</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if ($keyword !== ''): ?>
        <div class="alert alert-info py-2">
            Hasil pencarian untuk: <strong><?= htmlspecialchars($keyword) ?></strong>
            — ditemukan <strong><?= mysqli_num_rows($data) ?></strong> barang.
        </div>
        <?php mysqli_data_seek($data, 0); ?>
    <?php endif; ?>

    <div class="col mb-2">
        <a href="index.php?landing_page_kel_3=barang/tambah" class="btn btn-info">+ Tambah Barang</a>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $found = false;
        while ($row = mysqli_fetch_assoc($data)):
            $found = true;
            // Highlight matching text
            $nama     = htmlspecialchars($row['nama']);
            $kategori = htmlspecialchars($row['kategori']);
            if ($keyword !== '') {
                $esc = preg_quote(htmlspecialchars($keyword), '/');
                $nama     = preg_replace('/(' . $esc . ')/i', '<mark class="bg-warning px-1 rounded">$1</mark>', $nama);
                $kategori = preg_replace('/(' . $esc . ')/i', '<mark class="bg-warning px-1 rounded">$1</mark>', $kategori);
            }
        ?>
            <tr class="<?= ($keyword !== '' && (stripos($row['nama'], $keyword) !== false || stripos($row['kategori'], $keyword) !== false)) ? 'table-warning' : '' ?>">
                <td><?= $no++ ?></td>
                <td><img src="../gambar/<?= htmlspecialchars($row['gambar']) ?>" width="100px"></td>
                <td><?= $nama ?></td>
                <td><?= $kategori ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= $row['rating'] ?></td>
                <td>
                    <a href="index.php?landing_page_kel_3=barang/edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?landing_page_kel_3=barang/hapus&id=<?= $row['id'] ?>"
                       onclick="return confirm('Yakin hapus data ini?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php if (!$found): ?>
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <?= $keyword !== '' ? 'Tidak ada barang yang cocok dengan pencarian "<strong>' . htmlspecialchars($keyword) . '</strong>".' : 'Belum ada data barang.' ?>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
// Auto-scroll ke tabel setelah pencarian agar hasil langsung terlihat
(function() {
    const keyword = <?= json_encode($keyword) ?>;
    if (keyword !== '') {
        const tabel = document.querySelector('table');
        if (tabel) {
            setTimeout(() => {
                tabel.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
    }
})();
</script>

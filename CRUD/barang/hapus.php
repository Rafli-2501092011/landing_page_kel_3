<?php
if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];   // dipaksa jadi angka

  // Ambil nama gambar SEBELUM barisnya dihapus
  $cek = $db->prepare("SELECT gambar FROM barang WHERE id = ?");
  $cek->bind_param("i", $id);
  $cek->execute();
  $baris = $cek->get_result()->fetch_assoc();
  $gambar_lama = $baris['gambar'] ?? '';
  $cek->close();

  // pakai prepared statement
  $hapus = $db->prepare("DELETE FROM barang WHERE id = ?");
  $hapus->bind_param("i", $id);

  if ($hapus->execute()) {

    // Hapus file gambar setelah datanya terhapus
    if ($gambar_lama !== '') {
      $nama_file = basename($gambar_lama);

      // jangan hapus kalau masih dipakai barang lain
      $pakai = $db->prepare("SELECT COUNT(*) FROM barang WHERE gambar = ?");
      $pakai->bind_param("s", $nama_file);
      $pakai->execute();
      $jumlah = $pakai->get_result()->fetch_row()[0];
      $pakai->close();

      $path = __DIR__ . '/../../gambar/' . $nama_file;
      if ($jumlah == 0 && is_file($path)) {
        unlink($path);
      }
    }

    echo "<script>
                alert('Berhasil hapus data!');
                window.location='index.php?landing_page_kel_3=barang/barang';
              </script>";
  } else {
    echo "<script>
                alert('Gagal hapus data!');
                window.location='index.php?landing_page_kel_3=barang/barang';
              </script>" . mysqli_error($db);;
  }
}
?>
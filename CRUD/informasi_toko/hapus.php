<?php
if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];   // dipaksa jadi angka

  // Ambil nama gambar SEBELUM barisnya dihapus
  $cek = $db->prepare("SELECT logo, lokasi_img  FROM informasi_toko WHERE id = ?");
  $cek->bind_param("i", $id);
  $cek->execute();
  $baris = $cek->get_result()->fetch_assoc();
  $logo_lama = $baris['logo'] ?? '';
  $lokasi_lama = $baris['lokasi_img'] ?? '';
  $cek->close();

  // pakai prepared statement
  $hapus = $db->prepare("DELETE FROM informasi_toko WHERE id = ?");
  $hapus->bind_param("i", $id);

  if ($hapus->execute()) {

    // Hapus file logo setelah datanya terhapus
    if ($logo_lama !== '') {
      $nama_file = basename($logo_lama);

      // jangan hapus kalau masih dipakai informasi lain
      $pakai = $db->prepare("SELECT COUNT(*) FROM informasi_toko WHERE logo = ?");
      $pakai->bind_param("s", $nama_file);
      $pakai->execute();
      $jumlah = $pakai->get_result()->fetch_row()[0];
      $pakai->close();

      $path = __DIR__ . '/../../gambar/' . $nama_file;
      if ($jumlah == 0 && is_file($path)) {
        unlink($path);
      }
    }

    // Hapus file gambar lokasi setelah datanya terhapus
    if ($lokasi_lama !== '') {
      $nama_file = basename($lokasi_lama);

      // jangan hapus kalau masih dipakai informasi lain
      $pakai = $db->prepare("SELECT COUNT(*) FROM informasi_toko WHERE lokasi_img = ?");
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
                window.location='index.php?landing_page_kel_3=informasi_toko/informasi';
              </script>";
  } else {
    echo "<script>
                alert('Gagal hapus data!');
                window.location='index.php?landing_page_kel_3=informasi_toko/informasi';
              </script>" . mysqli_error($db);;
  }
}
?>
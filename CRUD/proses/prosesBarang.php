<!-- proses input data barang -->

<?php
include "../../koneksi.php";

//blok kode unutk insert data ke tabel buku
if (isset($_POST['simpan'])) {
  $nama = trim($_POST['nama']);
  $kategori = trim($_POST['kategori']);
  $harga = (int) $_POST['harga'];
  $rating = (float) $_POST['rating'];


  $gambar = $_FILES['gambar'];
  $nama_file = $gambar['name'];
  move_uploaded_file($gambar['tmp_name'], '../../gambar/' . $nama_file);

  $cek = $db->prepare("SELECT nama FROM barang WHERE nama = ?");
  $cek->bind_param("s", $nama);
  $cek->execute();
  $cek->store_result();

  if ($cek->num_rows > 0) {
    $kode = htmlspecialchars($nama);
    echo "<script>
                alert('Kode buku $kode sudah terdaftar. Gunakan kode lain.');
                window.location='../index.php?landing_page_kel_3=barang/barang';
              </script>";
  } else {
    //deklarasi variabel
    $sql = "INSERT INTO barang (nama, gambar, harga, rating, kategori)
          Values (?, ?, ?, ?, ?)";
    //eksekusi query sql ke database
    $query = $db->prepare($sql);
    $query->bind_param("ssids", $nama, $nama_file, $harga, $rating, $kategori);



    //kondisi
    if ($query->execute()) {
      echo "<script>
                alert('Berhasil menambah data!');
                window.location='../index.php?landing_page_kel_3=barang/barang';
              </script>";
    } else {
      echo "<script>
                alert('Gagal menambah data!');
                window.location='../index.php?landing_page_kel_3=barang/barang';
              </script>" . mysqli_error($db);
    }
  }

}
?>


<!-- proses update data barang -->

<?php
require '../../koneksi.php';

function hapusFileGambar($db, $nama_file, $kecuali_id)
{
  $nama_file = basename($nama_file);
  if ($nama_file === '')
    return;

  // jangan hapus kalau masih dipakai barang lain
  $cek = $db->prepare("SELECT COUNT(*) FROM barang WHERE gambar = ? AND id <> ?");
  $cek->bind_param("si", $nama_file, $kecuali_id);
  $cek->execute();
  $jumlah = 0;
  $cek->bind_result($jumlah);
  $cek->fetch();
  $cek->close();

  $path = '../../gambar/' . $nama_file;
  if ($jumlah == 0 && is_file($path)) {
    unlink($path);
  }
}

if (isset($_POST['ubah'])) {
  $id = (int) $_POST['id'];
  $nama = trim($_POST['nama']);
  $kategori = trim($_POST['kategori']);
  $harga = (int) $_POST['harga'];
  $rating = (float) $_POST['rating'];

  // Ambil nama gambar lama sebelum data diubah
  $cek = $db->prepare("SELECT gambar FROM barang WHERE id = ?");
  $cek->bind_param("i", $id);
  $cek->execute();
  $baris = $cek->get_result()->fetch_assoc();
  $gambar_lama = $baris['gambar'] ?? '';
  $cek->close();

  $gambar = $_FILES['gambar'];
  $nama_file = $gambar['name'];

  // upload hanya kalau memang ada file baru 
  if ($nama_file) {
    move_uploaded_file($gambar['tmp_name'], '../../gambar/' . $nama_file);
  }

  if ($nama_file) {
    // Ada gambar baru -> kolom gambar ikut diubah
    $sql = "UPDATE barang SET 
            nama = ?, gambar = ?, harga = ?, rating = ?, kategori = ? 
            WHERE id = ?";

    $query = $db->prepare($sql);
    $query->bind_param("ssidsi", $nama, $nama_file, $harga, $rating, $kategori, $id);

  } else {
    // Tidak ada gambar baru -> kolom gambar tidak diubah
    $sql = "UPDATE barang SET 
            nama = ?, harga = ?, rating = ?, kategori = ?
            WHERE id = ?";

    $query = $db->prepare($sql);
    $query->bind_param("sidsi", $nama, $harga, $rating, $kategori, $id);

  }


  //kondisi
  if ($query->execute()) {
    // [BARU] 3. Hapus file gambar lama kalau diganti gambar baru
    if ($nama_file && $gambar_lama !== '' && $gambar_lama !== $nama_file) {
      hapusFileGambar($db, $gambar_lama, $id);
    }

    echo "<script>
                alert('Berhasil merubah data!');
                window.location='../index.php?landing_page_kel_3=barang/barang';
              </script>";
  } else {
    echo "<script>
                alert('Gagal merubah data!');
                window.location='../index.php?landing_page_kel_3=barang/barang';
              </script>" . mysqli_error($db);
  }
}
?>
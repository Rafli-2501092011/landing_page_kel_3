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
?>




<?php
require '../../koneksi.php';

if (isset($_POST['update'])) {
  $id = (int) $_POST['id'];
  $nama = trim($_POST['nama']);
  $kategori = trim($_POST['kategori']);
  $harga = (int) $_POST['harga'];
  $rating = (float) $_POST['rating'];


  $gambar = $_FILES['gambar'];
  $nama_file = $gambar['name'];
  move_uploaded_file($gambar['tmp_name'], '../../gambar/' . $nama_file);

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

  // if ($_FILES['gambar']['name'] != "") {
  //     $gambar = $_FILES['gambar']['name'];
  //     move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
  // }

  // mysqli_query($db, "UPDATE barang SET nama='$nama', gambar='$gambar', harga='$harga', rating='$rating', kategori='$kategori' WHERE id='$id'");
  // header("Location: barang.php");

  //kondisi
  if ($query->execute()) {
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
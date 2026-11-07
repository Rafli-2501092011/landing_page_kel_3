<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $rating   = $_POST['rating'];

    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);

    mysqli_query($db, "INSERT INTO barang (nama, gambar, harga, rating, kategori) VALUES ('$nama', '$gambar', '$harga', '$rating', '$kategori')");
    header("Location: barang.php");
}
?>
<h1>Tambah Barang</h1>

<form method="post" enctype="multipart/form-data">
    Nama<br>
    <input type="text" name="nama" required><br><br>

    Kategori<br>
    <input type="text" name="kategori" required><br><br>

    Harga<br>
    <input type="number" name="harga" required><br><br>

    Rating (0 - 5)<br>
    <input type="number" name="rating" step="0.1" min="0" max="5" required><br><br>

    Gambar<br>
    <input type="file" name="gambar" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="barang.php">Batal</a>
</form>
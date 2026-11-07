<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $judul    = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $isi      = $_POST['isi'];
    $tanggal  = $_POST['tanggal_berlaku'];

    mysqli_query($conn, "INSERT INTO informasi (judul, kategori, isi, tanggal_berlaku) VALUES ('$judul', '$kategori', '$isi', '$tanggal')");
    header("Location: index.php");
}
?>
<h1>Tambah Informasi</h1>

<form method="post">
    Judul<br>
    <input type="text" name="judul" required><br><br>

    Kategori<br>
    <input type="text" name="kategori" required><br><br>

    Isi<br>
    <textarea name="isi" required></textarea><br><br>

    Tanggal Berlaku<br>
    <input type="date" name="tanggal_berlaku" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="index.php">Batal</a>
</form>
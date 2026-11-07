<?php
include "../koneksi.php";

$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM barang WHERE id = '$id'"));

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $rating   = $_POST['rating'];
    $gambar   = $data['gambar'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
    }

    mysqli_query($db, "UPDATE barang SET nama='$nama', gambar='$gambar', harga='$harga', rating='$rating', kategori='$kategori' WHERE id='$id'");
    header("Location: barang.php");
}
?>
<h1>Edit Barang</h1>

<form method="post" enctype="multipart/form-data">
    Nama<br>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>

    Kategori<br>
    <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required><br><br>

    Harga<br>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br><br>

    Rating (0 - 5)<br>
    <input type="number" name="rating" step="0.1" min="0" max="5" value="<?= $data['rating'] ?>" required><br><br>

    Gambar (kosongkan jika tidak diganti)<br>
    <img src="uploads/<?= $data['gambar'] ?>" width="100"><br>
    <input type="file" name="gambar"><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="barang.php">Batal</a>
</form>
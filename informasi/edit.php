<?php
include "../koneksi.php";

$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM informasi WHERE id_informasi = '$id'"));

if (isset($_POST['simpan'])) {
    $judul    = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $isi      = $_POST['isi'];
    $tanggal  = $_POST['tanggal_berlaku'];

    mysqli_query($db, "UPDATE informasi SET judul='$judul', kategori='$kategori', isi='$isi', tanggal_berlaku='$tanggal' WHERE id_informasi='$id'");
    header("Location: informasi.php");
}
?>
<h1>Edit Informasi</h1>

<form method="post">
    Judul<br>
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required><br><br>

    Kategori<br>
    <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required><br><br>

    Isi<br>
    <textarea name="isi" required><?= $data['isi'] ?></textarea><br><br>

    Tanggal Berlaku<br>
    <input type="date" name="tanggal_berlaku" value="<?= $data['tanggal_berlaku'] ?>" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="informasi.php">Batal</a>
</form>
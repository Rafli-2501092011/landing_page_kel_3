<?php
include "../koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM informasi");
?>
<h1>Kelola Informasi Toko</h1>
<a href="tambah.php">+ Tambah Informasi</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Isi</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['judul'] ?></td>
        <td><?= $row['kategori'] ?></td>
        <td><?= $row['isi'] ?></td>
        <td><?= $row['tanggal_berlaku'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_informasi'] ?>">Edit</a> |
            <a href="hapus.php?id=<?= $row['id_informasi'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
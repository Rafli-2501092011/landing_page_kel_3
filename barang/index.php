<?php
include "../koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM barang");
?>
<h1>Kelola Barang Toko</h1>
<a href="tambah.php">+ Tambah Barang</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Rating</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><img src="uploads/<?= $row['gambar'] ?>" width="60"></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['kategori'] ?></td>
        <td><?= $row['harga'] ?></td>
        <td><?= $row['rating'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
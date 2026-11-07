<?php
include "../koneksi.php";
$data = mysqli_query($db, "SELECT * FROM barang");
?>

<div class="container">
    <h1>Kelola Barang Toko</h1>
    <div class="col">
        <a href="index.php?landing_page_kel_3=barang/tambah" class="btn btn-info mb-2">+ Tambah Barang</a>
    </di>


    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Rating</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><img src="../gambar/<?= $row['gambar'] ?>" width="100px" ></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['kategori'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['rating'] ?></td>
                <td>
                    <a href="index.php?landing_page_kel_3=barang/edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?landing_page_kel_3=barang/hapus&id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')"
                        class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include "../koneksi.php";
$data = mysqli_query($db, "SELECT * FROM informasi_toko");
?>

<div class="container">
    <h1>Kelola Informasi Toko</h1>
    <div class="col">
        <a href="index.php?landing_page_kel_3=informasi_toko/tambah" class="btn btn-info mb-2">Tambah Informasi</a>
    </di>


    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Slogan</th>
            <th>Deskripsi</th>
            <th>Alamat</th>
            <th>Nomor Hp</th>
            <th>Jam Buka</th>
            <th>Logo Toko</th>
            <th>Gambar Lokasi</th>
            <th>URL Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['slogan'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['wa'] ?></td>
                <td><?= $row['jam_buka'] ?></td>
                <td><img src="../gambar/<?= $row['logo'] ?>" width="100px" ></td>
                <td><img src="../gambar/<?= $row['lokasi_img'] ?>" width="100px" ></td>
                <td><?= $row['maps_url'] ?></td>
                <td>
                    <a href="index.php?landing_page_kel_3=informasi_toko/edit&id=<?= $row['id'] ?>"
                        class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?landing_page_kel_3=informasi_toko/hapus&id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')"
                        class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
require '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM barang WHERE id = '$id'"));

?>
<form action="proses/prosesBarang.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">


    <div class="class container">

        <h1>Edit Barang</h1>
        <div class="card-body">

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input value="<?= $data['nama'] ?>" id="nama" class="form-control" name="nama" type="text" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <input value="<?= $data['kategori'] ?>" id="kategori" class="form-control" name="kategori"
                        type="text" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input value="<?= $data['harga'] ?>" id="harga" class="form-control" name="harga" type="text"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Rating</label>
                <div class="col-sm-10">
                    <input value="<?= $data['rating'] ?>" id="rating" class="form-control" name="rating" type="text"
                        required>
                </div>
            </div>


            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <img src="../gambar/<?php echo $data['gambar']; ?>" width="100px" class="mb-2">

                    <input class="form-control" name="gambar" type="file" accept="image/*">
                </div>
            </div>

            <button class="btn btn-primary" type="submit" name="ubah" value="ubah">Update</button>

        </div>
    </div>

</form>
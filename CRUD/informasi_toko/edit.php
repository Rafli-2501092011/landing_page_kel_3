<?php
require '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM informasi_toko WHERE id = '$id'"));

?>
<form action="proses/prosesInformasiToko.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">


  <div class="class container">

    <h1>Edit Informasi Toko</h1>
    <div class="card-body">

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Slogan</label>
        <div class="col-sm-10">
          <input value="<?= $data['slogan'] ?>" id="slogan" class="form-control" name="slogan" type="text" required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
          <input value="<?= $data['deskripsi'] ?>" id="deskripsi" class="form-control" name="deskripsi" type="text"
            required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <input value="<?= $data['alamat'] ?>" id="alamat" class="form-control" name="alamat" type="text" required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Nomor Hp</label>
        <div class="col-sm-10">
          <input value="<?= $data['wa'] ?>" id="wa" class="form-control" name="wa" type="text" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Jam Buka</label>
        <div class="col-sm-10">
          <input value="<?= $data['jam_buka'] ?>" id="jam_buka" class="form-control" name="jam_buka" type="text"
            required>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Logo Toko</label>
        <div class="col-sm-10">
          <img src="../gambar/<?php echo $data['logo']; ?>" width="100px" class="mb-2">

          <input class="form-control" name="logo" type="file" accept="image/*">
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Gambar Lokasi</label>
        <div class="col-sm-10">
          <img src="../gambar/<?php echo $data['lokasi_img']; ?>" width="100px" class="mb-2">

          <input class="form-control" name="lokasi_img" type="file" accept="image/*">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">URL Lokasi</label>
        <div class="col-sm-10">
          <input value="<?= $data['maps_url'] ?>" id="maps_url" class="form-control" name="maps_url" type="text"
            required>
        </div>
      </div>

      <button class="btn btn-primary" type="submit" name="ubah" value="ubah">Update</button>

    </div>
  </div>

</form>
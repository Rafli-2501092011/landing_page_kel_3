
<form action="proses/prosesInformasiToko.php" method="POST" enctype="multipart/form-data">

  <div class="class container">

    <h1>Edit Informasi Toko</h1>
    <div class="card-body">

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Slogan</label>
        <div class="col-sm-10">
          <input class="form-control" name="slogan" type="text" required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
          <input class="form-control" name="deskripsi" type="text"
            required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <input class="form-control" name="alamat" type="text" required>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Nomor Hp</label>
        <div class="col-sm-10">
          <input class="form-control" name="wa" type="text" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Jam Buka</label>
        <div class="col-sm-10">
          <input class="form-control" name="jam_buka" type="text"
            required>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Logo Toko</label>
        <div class="col-sm-10">
          <input class="form-control" name="logo" type="file" accept="image/*">
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Gambar Lokasi</label>
        <div class="col-sm-10">
          <input class="form-control" name="lokasi_img" type="file" accept="image/*">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">URL Lokasi</label>
        <div class="col-sm-10">
          <input class="form-control" name="maps_url" type="text"
            required>
        </div>
      </div>

      <button class="btn btn-primary" type="submit" name="simpan" value="simpan">Simpan</button>

    </div>
  </div>

</form>
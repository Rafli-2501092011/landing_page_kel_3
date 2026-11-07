
  <form action="proses/prosesBarang.php" method="POST" enctype="multipart/form-data" >
    <div class="class container">
        <div class="card-header">
          <h2>Input Data Barang</h2>
        </div>

        <div class="card-body">

          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input class="form-control" name="nama" type="text" placeholder="" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Kategoi</label>
            <div class="col-sm-10">
              <input class="form-control" name="kategori" type="text" placeholder="" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
              <input class="form-control" name="harga" type="text" placeholder="" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Rating</label>
            <div class="col-sm-10">
              <input class="form-control" name="rating" type="text" placeholder="" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
              <input class="form-control" name="gambar" type="file" accept="image/*" placeholder="" required>
            </div>
          </div>
          

          <button class="btn btn-primary" type="simpan" name="simpan">Simpan</button>

        </div>
      </div>
  </form>
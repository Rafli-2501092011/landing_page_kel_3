<header style="background-color: #EAF1FB;" class="text-white">
  <div class="container-fluid">
    <div class="row py-3 border-bottom">

      <div
        class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
        <div class="d-flex align-items-center my-3 my-sm-0">
          <a href="index.php">
            <img src="gambar/logoToko.png" alt="logo" height="60">
          </a>
        </div>

      </div>

      <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
        <div class="search-bar row bg-light p-2 rounded-4">

          <form method="GET" action="index.php" role="search" class="d-flex align-items-center">
            <input type="hidden" name="landing_page_kel_3" value="index">

            <div class="input-group">
              <input name="kata" class="form-control" type="search" placeholder="Cari..." aria-label="Search" />
              <button name="cari" value="Cari" class="btn btn-outline-dark" type="submit" aria-label="Cari">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                </svg>
              </button>
            </div>
          </form>

        </div>
      </div>

      <div class="col-lg-4">
        <ul
          class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
          <li class="nav-item active">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown"
              aria-expanded="false">Pages</a>
            <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
              <li><a href="#kategori" class="dropdown-item">Kategori </a></li>
              <li><a href="#produk-terlaris" class="dropdown-item">Produk Terlaris </a></li>
              <li><a href="#all-produk" class="dropdown-item">Produk</a></li>
              <li><a href="#banner-informasi" class="dropdown-item">Banner Informasi </a></li>
              <li><a href="#blog" class="dropdown-item">Blog </a></li>
              <li><a href="#informasi-toko" class="dropdown-item">Informasi Toko </a></li>
              <li><a href="#footer" class="dropdown-item">Kontak </a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
        <ul class="d-flex justify-content-end list-unstyled m-0">
          <li>
            <a href="admin/login.php" class="p-2 mx-1">
              <svg width="27" height="27">
                <use xlink:href="#user"></use>
              </svg>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</header>
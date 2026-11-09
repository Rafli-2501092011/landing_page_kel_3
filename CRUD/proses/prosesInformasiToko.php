                  <!-- proses tambah informasi toko -->
<?php
require '../../koneksi.php';

if (isset($_POST['simpan'])) {
  $slogan = trim($_POST['slogan']);
  $deskripsi = trim($_POST['deskripsi']);
  $alamat = trim($_POST['alamat']);
  $wa = trim($_POST['wa']);
  $jam_buka = trim($_POST['jam_buka']);
  $maps_url = trim($_POST['maps_url']);

  // Menangkap file logo
  $file_logo = $_FILES['logo'];
  $nama_logo = $file_logo['name'];

  // Menangkap file gambar lokasi
  $file_lokasi = $_FILES['lokasi_img'];
  $nama_lokasi = $file_lokasi['name'];

  // Memindahkan file yang diunggah ke folder tujuan
  if ($nama_logo) {
    move_uploaded_file($file_logo['tmp_name'], '../../gambar/' . $nama_logo);
  }

  if ($nama_lokasi) {
    move_uploaded_file($file_lokasi['tmp_name'], '../../gambar/' . $nama_lokasi);
  }

  // Deklarasi query SQL dengan prepared statement
  $sql = "INSERT INTO informasi_toko (slogan, deskripsi, alamat, wa, jam_buka, logo, lokasi_img, maps_url) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
          
  $query = $db->prepare($sql);
  $query->bind_param("ssssssss", $slogan, $deskripsi, $alamat, $wa, $jam_buka, $nama_logo, $nama_lokasi, $maps_url);

  // Kondisi pengecekan hasil eksekusi
  if ($query->execute()) {
    echo "<script>
            alert('Berhasil menambah informasi toko!');
            window.location='../index.php?landing_page_kel_3=informasi_toko/informasi';
          </script>";
  } else {
    echo "<script>
            alert('Gagal menambah informasi toko!');
            window.location='../index.php?landing_page_kel_3=informasi_toko/informasi';
          </script>" . mysqli_error($db);
  }
}
?>


                  <!-- proses update informasi toko -->
<?php
require '../../koneksi.php';

function hapusFileGambar($db, $nama_file)
{
  $nama_file = basename($nama_file);
  if ($nama_file === '')
    return;

  $path = '../../gambar/' . $nama_file;
  if (is_file($path)) {
    unlink($path);
  }
}

if (isset($_POST['ubah'])) {
  $id = (int) $_POST['id'];
  $slogan = trim($_POST['slogan']);
  $deskripsi = trim($_POST['deskripsi']);
  $alamat = trim($_POST['alamat']);
  $wa = trim($_POST['wa']);
  $jam_buka = trim($_POST['jam_buka']);
  $maps_url = trim($_POST['maps_url']);

  // Ambil data gambar lama (logo dan lokasi_img) sebelum data diubah
  $cek = $db->prepare("SELECT logo, lokasi_img FROM informasi_toko WHERE id = ?");
  $cek->bind_param("i", $id);
  $cek->execute();
  $baris = $cek->get_result()->fetch_assoc();
  $logo_lama = $baris['logo'] ?? '';
  $lokasi_lama = $baris['lokasi_img'] ?? '';
  $cek->close();

  // Tangkap file upload baru
  $file_logo = $_FILES['logo'];
  $nama_logo = $file_logo['name'];

  $file_lokasi = $_FILES['lokasi_img'];
  $nama_lokasi = $file_lokasi['name'];

  // Upload file logo jika ada
  if ($nama_logo) {
    move_uploaded_file($file_logo['tmp_name'], '../../gambar/' . $nama_logo);
  }

  // Upload file lokasi_img jika ada
  if ($nama_lokasi) {
    move_uploaded_file($file_lokasi['tmp_name'], '../../gambar/' . $nama_lokasi);
  }

  // Tentukan query berdasarkan file gambar yang diunggah
  if ($nama_logo && $nama_lokasi) {
    $sql = "UPDATE informasi_toko SET slogan = ?, deskripsi = ?, alamat = ?, wa = ?, jam_buka = ?, logo = ?, lokasi_img = ?, maps_url = ? WHERE id = ?";
    $query = $db->prepare($sql);
    $query->bind_param("ssssssssi", $slogan, $deskripsi, $alamat, $wa, $jam_buka, $nama_logo, $nama_lokasi, $maps_url, $id);
  } elseif ($nama_logo) {
    $sql = "UPDATE informasi_toko SET slogan = ?, deskripsi = ?, alamat = ?, wa = ?, jam_buka = ?, logo = ?, maps_url = ? WHERE id = ?";
    $query = $db->prepare($sql);
    $query->bind_param("sssssssi", $slogan, $deskripsi, $alamat, $wa, $jam_buka, $nama_logo, $maps_url, $id);
  } elseif ($nama_lokasi) {
    $sql = "UPDATE informasi_toko SET slogan = ?, deskripsi = ?, alamat = ?, wa = ?, jam_buka = ?, lokasi_img = ?, maps_url = ? WHERE id = ?";
    $query = $db->prepare($sql);
    $query->bind_param("sssssssi", $slogan, $deskripsi, $alamat, $wa, $jam_buka, $nama_lokasi, $maps_url, $id);
  } else {
    $sql = "UPDATE informasi_toko SET slogan = ?, deskripsi = ?, alamat = ?, wa = ?, jam_buka = ?, maps_url = ? WHERE id = ?";
    $query = $db->prepare($sql);
    $query->bind_param("ssssssi", $slogan, $deskripsi, $alamat, $wa, $jam_buka, $maps_url, $id);
  }

  // Kondisi Eksekusi
  if ($query->execute()) {
    // Hapus file logo lama jika diganti baru
    if ($nama_logo && $logo_lama !== '' && $logo_lama !== $nama_logo) {
      hapusFileGambar($db, $logo_lama);
    }
    // Hapus file lokasi lama jika diganti baru
    if ($nama_lokasi && $lokasi_lama !== '' && $lokasi_lama !== $nama_lokasi) {
      hapusFileGambar($db, $lokasi_lama);
    }

    echo "<script>
            alert('Berhasil merubah informasi toko!');
            window.location='../index.php?landing_page_kel_3=informasi_toko/informasi';
          </script>";
  } else {
    echo "<script>
            alert('Gagal merubah informasi toko!');
            window.location='../index.php?landing_page_kel_3=informasi_toko/informasi';
          </script>" . mysqli_error($db);
  }
}
?>
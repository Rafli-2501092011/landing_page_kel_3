<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];


  $query = $db->query("DELETE FROM barang WHERE id='$id'");

  if ($query) {
    echo "<script>
                alert('Berhasil hapus data!');
                window.location='index.php?landing_page_kel_3=barang/barang';
              </script>";
  } else {
    // echo "Gagal menghapus data";

    echo "<script>
                alert('Gagal hapus data!');
                window.location='index.php?landing_page_kel_3=barang/barang';
              </script>" . mysqli_error($db);
  }
}
?>
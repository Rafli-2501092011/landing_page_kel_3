<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($db, "DELETE FROM informasi WHERE id_informasi = '$id'");
header("Location: informasi.php");
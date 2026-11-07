<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($db, "DELETE FROM barang WHERE id = '$id'");
header("Location: barang.php");
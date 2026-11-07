<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM informasi WHERE id_informasi = '$id'");
header("Location: index.php");
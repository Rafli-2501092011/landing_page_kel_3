<!-- ini pakai konsep oop/pbo -->
<?php

// mulai session (dipakai untuk menyimpan pesan setalah redirect)
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//koneksikan ke database
$db = mysqli_connect("localhost", "root", "", "toko");

if ($db->connect_error) {
  die("Koneksi Gagal: " . $db->connect_error);
}

//supaya karakter khusus (huruf beraksen, emoji) tersimpan dan tampil dengan benar
$db->set_charset("utf8mb4");

?>
<?php
require 'koneksi.php';
require 'layout/layoutHeader.php';

$page = $_GET['page'] ?? 'home';
$allowed = ['home'];              // tambah nama halaman lain di sini
if (!in_array($page, $allowed)) {
    $page = 'home';
}
include "layout/$page.php";

require 'layout/layoutFooter.php';
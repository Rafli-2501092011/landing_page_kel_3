<?php
require '../koneksi.php';
require 'layout/layoutHeader.php';
?>

<?php
$page = $_GET['landing_page_kel_3'] ?? 'home';
include "$page.php";
?>

<?php require 'layout/layoutFooter.php'; ?>
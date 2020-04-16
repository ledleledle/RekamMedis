<script src="../assets/modules/sweetalert/sweet2.js"></script>
<link rel="stylesheet" href="../assets/modules/sweetalert/sweet2.css">

<?php
include 'connect.php';

$tipe = $_GET['type'];
$id = $_GET['id'];
$datenow = date('Y-m-d');

$sql = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id_pasien='$id'");
$getdata = mysqli_num_rows($sql);
$tglmasuk = $getdata['tgl_masuk'];

$riwayat = mysqli_query($conn, "INSERT INTO riwayat_rawatinap (id_pasien, ) VALUES ()");
$ruangan = mysqli_query($conn, "");
?>
<?php
$page = "Detail pembayaran rawat inap";
include "part/head.php";
include 'part_func/umur.php';
include 'part_func/tgl_ind.php';
include 'auth/connect.php';

$id = $_GET['id'];
$datenow = date('Y-m-d');

$sql = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id_pasien='$id'");
$getdata = mysqli_fetch_array($sql);
$tglmasuk = $getdata['tgl_masuk'];
$biaya = $getdata['biaya'];

$date1=date_create($tglmasuk);
$date2=date_create($datenow);
$diff=date_diff($date1,$date2);
$hitunghari = $diff->format("%a");

echo $id." id pasien<br>";
echo $tglmasuk." masuk<br>";
echo $datenow." keluar<br>";
echo $biaya." biaya / day<br>";
echo $hitunghari."<br>";
echo $hitunghari*$biaya;
//$riwayat = mysqli_query($conn, "INSERT INTO riwayat_rawatinap (id_pasien, tgl_masuk, tgl_keluar, biaya) VALUES ('$id', '$tglmasuk', '$datenow', '$biaya')");
//$ruangan = mysqli_query($conn, "");
?>
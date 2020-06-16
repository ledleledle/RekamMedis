<?php
include "auth/connect.php";
include "part/style_kartu.php";
include "part_func/tgl_ind.php";
$page = "Print Kartu Rawat Jalan";

$page1 = $_POST['page'];
if ($page1 == "raw00") {
	include "part/head.php";
	$id = $_POST['id'];
	$no = $_POST['no_urut'];
	$pas = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
	$pasien = mysqli_fetch_array($pas); ?>
	<div class='card-antri text-dark'>
		<h3>NOMOR ANTRIAN PASIEN R.S. EMPPS AHH</h3>
		<table class="table table-striped text-dark">
			<tr>
				<th><?php echo ucwords($pasien['nama_pasien']) . " / " . $pasien['kode_pasien']; ?></th>
			</tr>
			<tr>
				<th>No. Antrian</th>
			</tr>
			<tr>
				<th>
					<h1><?php echo $no; ?></h1>
				</th>
			</tr>
		</table>
	<?php
} elseif ($page1 == "raw01") {
	$nama = $_POST['nama'];
	$tgl = $_POST['tgl'];
	$alm = $_POST['alamat'];
	$tmp = $_POST['tmp'];
	$jk = $_POST['jk'];
	$kode = $_POST['kode'];
	?>
		<div class='card'>
			<div class='card_left'>
				<img src='assets/img/logo.png'>
			</div>
			<div class='card_right'>
				<h1>R.S. EMPPS AHH</h1>
				<div class='card_right__details'>
					<ul>
						<li>Jl. R. A. Kartini No. 666 Mojoroto, Kode Pos : 66669</li>
						<li>Kediri, Jawa Timur.</li>
					</ul>
					<div class='card_right__review'>
						<h2><?php echo $kode; ?></h2>
						<h3><?php echo strtoupper($nama); ?></h3>
						<table>
							<tr>
								<td>Tempat/Tgl. Lahir</td>
								<td> : </td>
								<td><?php echo ucwords($tmp) . "/" . tgl_indo($tgl); ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td> : </td>
								<td>
									<?php if ($jk == "0") {
										echo "Laki - Laki";
									} else {
										echo "Perempuan";
									} ?>
								</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td> : </td>
								<td><?php echo $alm; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

		<?php } ?>
		</div>
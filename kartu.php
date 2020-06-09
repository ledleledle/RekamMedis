<?php
include "part/style_kartu.php";
include "part_func/tgl_ind.php";
$kode = "1040490";
$nama = "leon prasetya";
$tmpt = "depok";
$lahir = "1998-08-04";
$jk = "0";
$alam = "kediri";
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
						<td><?php echo ucwords($tmpt)."/".tgl_indo($lahir); ?></td>
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
						<td><?php echo $alam; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
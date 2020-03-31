<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$page = "Status Ruangan Rawat Inap";
	session_start();
	include 'auth/connect.php';
	include "part/head.php";
	include "part_func/tgl_ind.php";

	if (isset($_POST['submit'])) {
		$id = $_POST['iduser'];
		$nama = $_POST['nama'];
		$user = $_POST['username'];
		$alam = $_POST['alamat'];
		$old_pass = $_POST['old_password'];
		$new_pass = $_POST['new_password'];

		if ($old_pass == "" && $new_pass == "") {
			$up1 = mysqli_query($conn, "UPDATE pegawai SET nama_pegawai='$nama', username='$user', alamat='$alam' WHERE id_pegawai='$id'");
			echo '<script>
			setTimeout(function() {
				swal({
					title: "Data Diubah",
					text: "Data berhasil diubah!",
					icon: "success"
					});
					}, 500);
					</script>';
		} elseif ($old_pass != "" && $new_pass != "") {
			$cekpass = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai='$id' AND password='$old_pass'");
			$cekada = mysqli_num_rows($cekpass);
			if ($cekada == 0) {
				echo '<script>
						setTimeout(function() {
							swal({
								title: "Password salah",
								text: "Password salah, cek kembali form password anda!",
								icon: "error"
								});
								}, 500);
								</script>';
			} else {
				$up2 = mysqli_query($conn, "UPDATE pegawai SET nama_pegawai='$nama', username='$user', password='$new_pass', alamat='$alam' WHERE id_pegawai='$id'");
				echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data atau Password berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
			}
		}
	}

	if (isset($_POST['submit2'])) {
		$nama = $_POST['nama'];
		$user = $_POST['username'];
		$alam = $_POST['alamat'];
		$pass = $_POST['password'];
		$job = $_POST['pekerjaan'];

		$cekuser = mysqli_query($conn, "SELECT * FROM pegawai WHERE username='$user'");
		$baris = mysqli_num_rows($cekuser);
		if ($baris >= 1) {
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Username sudah digunakan",
						text: "Username sudah digunakan, gunakan username lain!",
						icon: "error"
						});
					}, 500);
			</script>';
		} else {
			$add = mysqli_query($conn, "INSERT INTO pegawai (username, password, nama_pegawai, alamat, pekerjaan) VALUES ('$user', '$pass', '$nama', '$alam', '$job')");
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Pegawai telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
		}
	}
	?>
</head>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>

			<?php
			include 'part/navbar.php';
			include 'part/sidebar.php';
			?>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Detail Ruangan Rawat Inap</h1>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4><?php echo $page; ?></h4>
										<div class="card-header-action">
											<a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah Ruangan</a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th>Nama Ruangan</th>
														<th>Dipakai Sejak</th>
														<th>Dipakai Oleh</th>
														<th>Status</th>
														<th>Harga per hari</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = mysqli_query($conn, "SELECT * FROM ruang_inap");
													$i = 0;
													while ($row = mysqli_fetch_array($sql)) {
														$defpasien = $row['id_pasien'];
														$i++;
													?>
														<tr>
															<td><?php echo $i; ?></td>
															<th><?php echo ucwords($row['nama_ruang']); ?></th>
															<td><?php if ($row['tgl_masuk'] == "") {
																	echo 'Belum digunakan';
																} else {
																	echo tgl_indo($row['tgl_masuk']);
																} ?></td>
															<td><?php
																if ($defpasien == '') {
																	echo 'Belum ada pasien';
																} else {
																	$sqlnama = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$defpasien'");
																	$namapasien = mysqli_fetch_array($sqlnama);
																	echo '<b>Sdr. ' . ucwords($namapasien["nama_pasien"]) . '</b>';
																} ?></td>
															<td><?php
																if ($row["status"] == "") {
																	echo '<div class="badge badge-pill badge-success mb-1">';
																	echo '<i class="ion-checkmark-round"></i> Tersedia';
																} elseif ($row["status"] == "1") {
																	echo '<div class="badge badge-pill badge-danger mb-1">';
																	echo '<i class="ion-close"></i> Dipakai';
																} else {
																	echo '<div class="badge badge-pill badge-warning mb-1">';
																	echo '<i class="ion-gear-b"></i>  Dalam Perbaikan';
																} ?>
										</div>
										</td>
										<td>Rp. <?php number_format("872812617", 2); ?></td>
										<td>
											<span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id_pegawai']; ?>" data-nama="<?php echo $row['nama_pegawai']; ?>" data-user="<?php echo $row['username']; ?>" data-alam="<?php echo $row['alamat']; ?>">
												<a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
											</span>
											<a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/hapususer.php?id=<?php echo $row['id_pegawai']; ?>'" ;><i class="fas fa-trash"></i></a>
										</td>
										</tr>
									<?php } ?>
									</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			</section>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="addUser">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Tambah Pegawai</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="needs-validation" novalidate="">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="nama" required="">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="username" required="">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Pekerjaan</label>
								<select class="form-control selectric" name="pekerjaan">
									<option value="1">Dokter</option>
									<option value="2">Apoteker</option>
								</select>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" required="" name="alamat"></textarea>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-9">
									<input type="password" name="password" class="form-control">
								</div>
							</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="editUser">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="needs-validation" novalidate="">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" name="iduser" required="" id="getId">
									<input type="text" class="form-control" name="nama" required="" id="getNama">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="username" required="" id="getUser">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" required="" name="alamat" id="getAddrs"></textarea>
							</div>
							<div class="alert alert-light text-center">
								Jika password tidak diganti, form dibawah dikosongi saja.
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Lama</label>
								<div class="col-sm-9">
									<input type="password" name="old_password" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Baru</label>
								<div class="col-sm-9">
									<input type="password" name="new_password" class="form-control">
								</div>
							</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit">Edit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include 'part/footer.php'; ?>
	</div>
	</div>
	<?php include "part/all-js.php"; ?>

	<script>
		$('#editUser').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var nama = button.data('nama')
			var user = button.data('user')
			var alam = button.data('alam')
			var id = button.data('id')
			var modal = $(this)
			modal.find('#getId').val(id)
			modal.find('#getNama').val(nama)
			modal.find('#getUser').val(user)
			modal.find('#getAddrs').val(alam)
		})
	</script>
</body>

</html>
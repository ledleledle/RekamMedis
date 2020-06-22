<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  include 'auth/connect.php';
  include 'part/navbar.php';
  include 'part_func/tgl_ind.php';
  $cek_pasien = mysqli_query($conn, "SELECT * FROM pasien");
  $cek_pas = mysqli_num_rows($cek_pasien);
  $page1 = $_POST['page'];
  if ($page1 == "raw00") {
    $cek_antrian = mysqli_query($conn, "SELECT * FROM antrian");
    $antrian = mysqli_num_rows($cek_antrian);
    $page = "Pendaftaran Antrian Pasien";
    $bread = "rawat_jalan.php";
    $id = $_POST['pasien'];
    $no_urut = $antrian + 1;
    $cek_keberadaan = mysqli_query($conn, "SELECT * FROM antrian WHERE id_pasien='$id'");
    $ceque = mysqli_num_rows($cek_keberadaan);
    if ($ceque == '0') {
      $info = "0";
      $insert = mysqli_query($conn, "INSERT INTO antrian (no_urut, id_pasien, status) VALUES ('$no_urut', '$id', '0')");
    } else {
      $no_urut = $no_urut - 1;
      $info = "1";
      echo '<script>
				setTimeout(function() {
					swal({
						title: "Pasien sudah terdaftar dalam antrian!",
						text: "Pasien sudah didaftarkan dalam antrian, pasien diharapkan menunggu diruang tunggu sekarang juga.",
						icon: "warning"
						});
					}, 500);
      </script>';
    }
  } elseif ($page1 == "raw01") {
    $page = "Pendaftaran Pasien";
    $bread = "rawat_jalan.php";
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl'];
    $alm = $_POST['alamat'];
    $tmp = $_POST['tmp'];
    $jk = $_POST['jk'];
    $ibu = $_POST['ibu'];
    $job = $_POST['job'];
    $nikah = $_POST['nikah'];
    $cek_pas2 = mysqli_num_rows($cek_pasien) + 1;
    $forcode = str_replace("-", "", $tgl);
    $kode = $cek_pas2 . $forcode;

    $insert = mysqli_query($conn, "INSERT INTO pasien (nama_pasien, tgl_lahir, alamat, kode_pasien, jk, tmp_lahir, ibu, pekerjaan, pernikahan) VALUES ('$nama', '$tgl', '$alm', $kode, '$jk', '$tmp', '$ibu', '$job', '$nikah')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Pasien Telah Terdaftar!",
						text: "Pasien yang bernama ' . ucwords($nama) . ' sudah terdaftar. Pasien sudah bisa mendaftarkan dirinya ke untuk pemeriksaan kesehatan. Jangan lupa print kartu pasien",
						icon: "success"
						});
					}, 500);
			</script>';
  } elseif ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
    $bread = "rawat_jalan1.php";
    $id = $_POST['idlae'];
    $penyakit = $_POST['penyakit'];
    $diagnosa = $_POST['diagnosa'];
    $biaya = $_POST['biaya'];
    $tglnow = date('Y-m-d');
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi  = $_POST['tensi'];
    $statusnya = $_POST['status'];
    $doc = $_POST['dokter'];
    $kodeobat = $_POST['kode'];

    $submit = mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, biaya_pengobatan, tinggi, berat, tensi, id_dokter) VALUES ('$id', '$penyakit', '$diagnosa', '$tglnow', '$biaya', '$tinggi', '$berat', '$tensi', '$doc')");
    $update_antrian = mysqli_query($conn, "UPDATE antrian SET status='$statusnya' WHERE id_pasien='$id'");
  } elseif ($page1 == "raw2") {
    $page = "Tindakan untuk Pasien";
    $bread = "rawat_jalan2.php";
  } elseif ($page1 == "raw3") {
    $page = "Pemberian Obat untuk Pasien";
    $bread = "rawat_jalan3.php";
    $kode = $_POST['kode'];
    $cek = mysqli_query($conn, "SELECT * FROM obat2 WHERE kode='$kode' GROUP BY kode");
    $cek2 = mysqli_num_rows($cek);
    if ($cek2 == 0) {
      echo '<script>
				setTimeout(function() {
					swal({
						title: "Gagal!",
						text: "Kode salah, cek kembali kode anda!",
						icon: "error"
						});
					}, 500);
			</script>';
    } else {
      $cekcek = mysqli_query($conn, "SELECT * FROM obat2 WHERE kode='$kode'");
      while ($row = mysqli_fetch_array($cekcek)) {
        $penyakit = $row['id_penyakit'];
        $obat = $row['id_obat'];
        $jum = $row['jum_obat'];
        $pasien = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id='$penyakit'");
        $cekpasien = mysqli_fetch_array($pasien);
        $pasien1 = $cekpasien['id_pasien'];
        $penyakit2 = $cekpasien['penyakit'];
        $input = mysqli_query($conn, "INSERT INTO riwayat_obat (id_penyakit, id_pasien, id_obat, jumlah) VALUES ('$penyakit', '$pasien1', '$obat', '$jum')");
        $delete = mysqli_query($conn, "DELETE * FROM obat2 WHERE id_pasien='$pasien1'");
      }
      $deleteantrian = mysqli_query($conn, "DELETE * FROM antrian WHERE id_pasien='$pasien1'");
    }
  } else {
    header("location: index.php");
  }

  include "part/head.php";
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $mbuh; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><?php echo "<a href='" . $bread . "'> " . $page; ?></a></div>
              <div class="breadcrumb-item">Print</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                  </div>
                  <div class="card-body">
                    <?php
                    if ($page1 == "raw00") {
                      if ($info == "0") {
                        echo "Silahkan cetak bukti pendaftaran, ini juga berfungsi sebagai nomer antrian pasien";
                      } elseif ($info == "1") {
                        echo "<i class='fas fa-info-circle'></i> Pasien telah terdaftar, silahkan cek kembali bukti pendaftaran/nomer antrian pasien. Atau cetak ulang nomer antrian berikut...";
                      }
                      $pas = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
                      $pasien = mysqli_fetch_array($pas);
                    ?>
                      <table class="table table-striped">
                        <tr>
                          <th><?php echo ucwords($pasien['nama_pasien']) . " / " . $pasien['kode_pasien']; ?></th>
                        </tr>
                        <tr>
                          <th>No. Antrian</th>
                        </tr>
                        <tr>
                          <th>
                            <h1><?php echo $no_urut; ?></h1>
                          </th>
                        </tr>
                      </table>
                      <form action="kartu.php" method="POST" target="_blank">
                        <input type="hidden" name="page" value="raw00">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="no_urut" value="<?php echo $no_urut; ?>">
                      <?php
                    } elseif ($page1 == "raw01") { ?>
                        <table class="table table-striped">
                          <tr>
                            <th>Nama / Kode Pasien</th>
                            <td> : </td>
                            <th><?php echo ucwords($nama) . " / " . $kode; ?></th>
                          </tr>
                          <tr>
                            <th>Tempat / Tanggal Lahir</th>
                            <td> : </td>
                            <td><?php echo ucwords($tmp) . " / " . tgl_indo($tgl); ?></td>
                          </tr>
                          <tr>
                            <th>Jenis Kelamin</th>
                            <td> : </td>
                            <td><?php
                                if ($jk == 0) {
                                  echo "Laki - Laki";
                                } elseif ($jk == 1) {
                                  echo "Perempuan";
                                } else {
                                  echo "Tidak terdeteksi";
                                }
                                ?></td>
                          </tr>
                          <tr>
                            <th>Status Pernikahan</th>
                            <td> : </td>
                            <td><?php
                                if ($jk == 0) {
                                  echo "Menikah";
                                } elseif ($jk == 1) {
                                  echo "Belum Menikah";
                                } else {
                                  echo "Tidak terdeteksi";
                                }
                                ?></td>
                          </tr>
                          <tr>
                            <th>Pekerjaan</th>
                            <td> : </td>
                            <td><?php echo ucwords($job); ?></td>
                          </tr>
                          <tr>
                            <th>Nama Ibu</th>
                            <td> : </td>
                            <td><?php echo ucwords($ibu); ?></td>
                          </tr>
                          <tr>
                            <th>Alamat</th>
                            <td> : </td>
                            <td><?php echo ucwords($alm); ?></td>
                          </tr>
                        </table>
                        <form action="kartu.php" method="POST" target="_blank">
                          <input type="hidden" name="page" value="raw01">
                          <input type="hidden" name="nama" value="<?php echo $nama; ?>">
                          <input type="hidden" name="tgl" value="<?php echo $tgl; ?>">
                          <input type="hidden" name="alamat" value="<?php echo $alm; ?>">
                          <input type="hidden" name="tmp" value="<?php echo $tmp; ?>">
                          <input type="hidden" name="jk" value="<?php echo $jk; ?>">
                          <input type="hidden" name="kode" value="<?php echo $kode; ?>">
                          <input type="hidden" name="job" value="<?php echo $job; ?>">
                        <?php
                      } elseif ($page1 == "raw1") {
                        $name = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
                        $name2 = mysqli_fetch_array($name); ?>
                          <table class="table table-striped">
                            <tr>
                              <th>Nama</th>
                              <td> : </td>
                              <th><?php echo ucwords($name2['nama_pasien']); ?></th>
                            </tr>
                            <tr>
                              <th>Penyakit</th>
                              <td> : </td>
                              <th><?php echo ucwords($penyakit); ?></th>
                            </tr>
                            <tr>
                              <th>Kode Pengambilan Obat</th>
                              <td> : </td>
                              <th><?php echo $kodeobat; ?></th>
                            </tr>
                          </table>
                          <form action="kartu.php" method="POST" target="_blank">
                            <input type="hidden" name="page" value="raw1">
                            <input type="hidden" name="kode" value="<?php echo $kodeobat; ?>">
                            <input type="hidden" name="nama" value="<?php echo $name2['nama_pasien']; ?>">
                          <?php
                        } elseif ($page1 == "raw2") {
                          echo "2";
                        } elseif ($page1 == "raw3") {
                          $nama = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$pasien1'");
                          $nama2 = mysqli_fetch_array($nama);
                          ?>
                            <table class="table table-striped">
                              <tr>
                                <th>Nama</th>
                                <td> : </td>
                                <th><?php echo ucwords($nama2['nama_pasien']); ?></th>
                              </tr>
                              <tr>
                                <th>Penyakit</th>
                                <td> : </td>
                                <th><?php echo ucwords($penyakit); ?></th>
                              </tr>
                              <tr>
                                <th>Kode Pengambilan Obat</th>
                                <td> : </td>
                                <th><?php echo $kode; ?></th>
                              </tr>
                            </table>
                            <form action="print.php" method="POST" target="_blank">
                              <input type="hidden" name="id" value="<?php echo $nama2['nama_pasien']; ?>">
                              <input type="hidden" name="idriwayat" value="<?php echo $penyakit ?>">
                            <?php } ?>
                            <div class="row justify-content-center">
                              <div class="btn-group">
                                <button class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
                                <a href="<?php echo $bread; ?>" class="btn btn-danger">Kembali ke menu sebelumnya</a>
                              </div>
                            </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </section>
    </div>
    <?php include 'part/footer.php'; ?>
  </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
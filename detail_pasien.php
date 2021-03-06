<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $idnama = $_POST['id'];
  $page1 = "det";
  $page = "Detail Pasien : " . $idnama;
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
  $pasien = mysqli_fetch_array($cek);
  $idid = $pasien['id'];
  $terakhir = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY id DESC LIMIT 1");
  $riwayat_terakhir = mysqli_fetch_array($terakhir);
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      include 'part_func/umur.php';
      include 'part_func/tgl_ind.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Pasien</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="pasien.php">Data Pasien</a></div>
              <div class="breadcrumb-item">Detail Pasien : <?php echo ucwords($idnama); ?></div>
            </div>
          </div>

          <div class="section-body">
            <?php include 'part/info_pasien.php'; ?>

            <div class="section-body">
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Info Pasien</h4>
                    </div>
                    <div class="card-body">
                      <div class="gallery">
                        <table class="table table-striped table-sm">
                          <tbody>
                            <tr>
                              <th scope="row">Nama Lengkap</th>
                              <td> : <?php echo ucwords($idnama); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tempat / Tanggal Lahir</th>
                              <td> : <?php echo ucwords($pasien['tmp_lahir']) . " / " . tgl_indo($pasien['tgl_lahir']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Jenis Kelamin</th>
                              <td> :
                                <?php if ($pasien['jk'] == "0") {
                                  echo "Laki - Laki";
                                } else {
                                  echo "Perempuan";
                                } ?>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Tinggi Bandan Terakhir</th>
                              <td> : <?php echo (@$riwayat_terakhir['tinggi'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['tinggi'] . " cm"; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Berat Badan Terakhir</th>
                              <td> : <?php echo (@$riwayat_terakhir['berat'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['berat'] . " kg"; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tekanan Darah Terakhir</th>
                              <td> : <?php echo (@$riwayat_terakhir['tensi'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['tensi'] . " mmHg"; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Pekerjaan</th>
                              <td> : <?php echo ucwords($pasien['pekerjaan']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Status Pernikahan</th>
                              <td> : <?php
                              if($pasien['pernikahan'] == 0){
                                echo "Menikah";
                              } elseif($pasien['pernikahan'] == 1){
                                echo "Belum Menikah";
                              }
                              ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Alamat</th>
                              <td> : <?php echo ucwords($pasien['alamat']); ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Catatan Riwayat Penyakit Pasien</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                          <thead>
                            <tr>
                              <th>Tanggal Berobat</th>
                              <th>Penyakit</th>
                              <th>Diagnosa</th>
                              <th>Obat</th>
                              <th>Keterangan Lanjutan</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid'");
                            $i = 0;
                            while ($row = mysqli_fetch_array($sql)) {
                              $idpenyakit = $row['id'];
                              $id_dokter = $row['id_dokter'];
                            ?>
                              <tr>
                                <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                                <td><?php echo ucwords($row['penyakit']); ?></td>
                                <td><?php echo $row['diagnosa']; ?>
                                </td>
                                <td>
                                  <?php
                                  $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_penyakit='$idpenyakit' AND id_pasien='$idid'");
                                  $jumobat = mysqli_num_rows($obat2an);
                                  if ($jumobat == 0) {
                                    echo "Tidak ada obat yang diberikan";
                                  } else {
                                    $count = 0;
                                    while ($showobat = mysqli_fetch_array($obat2an)) {
                                      $idobat = $showobat['id_obat'];
                                      $obatlagi = mysqli_query($conn, "SELECT * FROM obat WHERE id='$idobat'");
                                      $namaobat = mysqli_fetch_array($obatlagi);
                                      echo $str = ucwords($namaobat['nama_obat']);
                                      $count = $count + 1;

                                      if ($count < $jumobat) {
                                        echo ", ";
                                      }
                                    }
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $rotgensql = mysqli_query($conn, "SELECT * FROM foto_rotgen WHERE id_pasien='$idid' AND id_penyakit='$idpenyakit'");
                                  $jumrotgen = mysqli_num_rows($rotgensql);
                                  if ($jumrotgen == 0) {
                                    echo '- Tidak ada foto rotgen<br>';
                                  } else { ?>
                                    <form action="detail_rotgen.php" method="POST">
                                      <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                      <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">
                                      <button type="submit" title="Detail Foto Rotgen Pasien" data-toggle="tooltip" id="btn-link"><i class="fas fa-info-circle text-info"></i> <?php echo $jumrotgen; ?> Foto</button>
                                    </form>
                                  <?php
                                  }
                                  echo "- Berat : " . $row['berat'] . " kg, ";
                                  echo "Tinggi : " . $row['tinggi'] . " cm, ";
                                  echo "Tekanan Darah : " . $row['tensi'] . " mmHg";
                                  $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE id='$id_dokter'");
                                  $doc = mysqli_fetch_array($dokter);
                                  echo "<br>- Diperiksa oleh Dr. " . ucwords($doc['nama_pegawai']);
                                  ?>
                                </td>
                                <td>
                                  <form method="POST" action="print.php" target="_blank">
                                    <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                    <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">
                                    <div class="btn-group">
                                      <button type="submit" class="btn btn-info" name="detail" title="Detail" data-toggle="tooltip"><i class="fas fa-info"></i></button>
                                      <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i></button>
                                    </div>
                                  </form>
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
        </section>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
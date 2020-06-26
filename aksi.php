<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'auth/connect.php';
  $idnama = $_POST['id'];
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
  $ceque = mysqli_fetch_array($cek);
  $realid = $ceque['id'];
  $page1 = $_POST['page'];
  
  $cekriwayat = mysqli_query($conn, "SELECT * FROM `riwayat_penyakit` ORDER BY id DESC LIMIT 1");
  $datapasien = mysqli_fetch_array($cekriwayat);

  if ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
    $bread = "<a href='rawat_jalan1.php'>";
  } else {
    header("location:index.php");
  }

  session_start();
  include "part/head.php";
  include "part_func/tgl_ind.php";

  if (isset($_POST['submitfoto'])) {
    @$idpeny = $datapasien['id']+1;
    $idnama = $_POST['id'];
    $page1 = $_POST['page'];
    $biaya = "10000";

    if (count($_FILES['upload']['name']) > 0) {
      for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
        $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
        if ($tmpFilePath != "") {
          $filePath = "assets/img/uploads/" . date('d-m-Y-H-i-s') . '-' . $_FILES['upload']['name'][$i];
          if (move_uploaded_file($tmpFilePath, $filePath)) {
            $split = count($_FILES['upload']['tmp_name']);
            $sql = mysqli_query($conn, "INSERT INTO foto_rotgen (id_pasien, id_penyakit, biaya, directory) VALUES ('$realid', '$idpeny','$biaya', '$filePath')");
          }
        }
      }
    }
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Foto terupload!",
						text: "' . $split . ' Foto Telah Berhasil Diupload",
						icon: "success"
						});
					}, 500);
			</script>';
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
            <h1><?php echo $mbuh; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><?php echo $bread . " " . $page; ?></a></div>
              <div class="breadcrumb-item">Nama Pasien : <?php echo ucwords($idnama); ?></div>
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
                    <div class="row">
                      <div class="col-4">
                        <div class="list-group" id="list-tab" role="tablist">
                          <a class="list-group-item list-group-item-action active" id="list-diagnosa-list" data-toggle="list" href="#list-diagnosa" role="tab">Diagnosa</a>
                          <a class="list-group-item list-group-item-action" id="list-info-list" data-toggle="list" href="#list-info" role="tab">Info Pasien</a>
                          <a class="list-group-item list-group-item-action" id="list-rekam-list" data-toggle="list" href="#list-rekam" role="tab">Rekam Medis Pasien</a>
                          <a class="list-group-item list-group-item-action" id="list-rotgen-list" data-toggle="list" href="#list-rotgen" role="tab">Upload Foto Rotgen</a>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="list-diagnosa" role="tabpanel" aria-labelledby="list-diagnosa-list">
                            <form action="rawat_jalan_obat.php" method="POST" class="needs-validation" novalidate="">
                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Berat Badan</label>
                                  <div class="input-group">
                                    <input type="hidden" name="idlae" value="<?php echo $realid; ?>" readonly required>
                                    <input type="hidden" name="dokter" value="<?php echo $sessionid; ?>" readonly required>
                                    <input type="number" class="form-control" value="0" required="" min="0" name="berat" placeholder="Berat Badan Pasien">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        kg
                                      </div>
                                    </div>
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Tinggi Badan</label>
                                  <div class="input-group">
                                    <input type="number" class="form-control" value="0" required="" min="0" name="tinggi" placeholder="Tinggi Badan Pasien">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        cm
                                      </div>
                                    </div>
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tekanan Darah</label>
                                <div class="input-group col-sm-9">
                                  <input type="hidden" name="id" required="">
                                  <input type="number" class="form-control" name="tensi" required="" placeholder="Tekanan Darah Pasien">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      mmHg
                                    </div>
                                  </div>
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Diagnosa Penyakit</label>
                                <div class="col-sm-9">
                                  <textarea placeholder="Wajib" class="summernote-simple" name="diagnosa" required></textarea>
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fonis Penyakit</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="penyakit" required="" placeholder="Nama Penyakit yang menyerang Pasien">
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" name="status" required readonly value="1">
                              <input type="hidden" class="form-control" name="biaya" required readonly value="50000">
                              <button type="submit" class="btn btn-primary" name="submit">Pemeriksaan Selesai</button>
                            </form>
                          </div>
                          <div class="tab-pane fade" id="list-info" role="tabpanel" aria-labelledby="list-info-list">
                            <?php
                            $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
                            $pasien = mysqli_fetch_array($cek);
                            $idid = $pasien['id'];
                            $terakhir = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY id DESC LIMIT 1");
                            $riwayat_terakhir = mysqli_fetch_array($terakhir);
                            ?>
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
                                  <th scope="row">Alamat</th>
                                  <td> : <?php echo ucwords($pasien['alamat']); ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="tab-pane fade" id="list-rekam" role="tabpanel" aria-labelledby="list-rekam-list">
                            <table class="table table-striped table-bordered" id="table-1">
                              <thead>
                                <tr>
                                  <th>Tanggal Berobat</th>
                                  <th>Penyakit</th>
                                  <th>Diagnosa</th>
                                  <th>Obat</th>
                                  <th>Keterangan Lanjutan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$realid'");
                                $i = 0;
                                while ($row = mysqli_fetch_array($sql)) {
                                  $idpenyakit = $row['id'];
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
                                      echo "<br>- ";
                                      $status = substr($row['id_rawatinap'], 0, 3);
                                      $idrawatinap = substr($row['id_rawatinap'], 3);
                                      if ($row['id_rawatinap'] == '0') {
                                        echo 'Pasien tidak membutuhkan Rawat Inap';
                                      } else {
                                        if ($status == "tmp") {
                                          $ruang = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id='$idrawatinap'");
                                          $showruang = mysqli_fetch_array($ruang);
                                          echo "<a href='ruangan.php' title='Detail Ruang Rawat Inap Pasien' data-toggle='tooltip'><i class='fas fa-info-circle text-info'></i> Pasien masih dirawat di ruang " . $showruang['nama_ruang'] . " sejak tgl " . tgl_indo($showruang['tgl_masuk']) . "</a>";
                                        } else {
                                          $riw1 = mysqli_query($conn, "SELECT * FROM riwayat_rawatinap WHERE id='$idrawatinap'");
                                          $riwayatinap = mysqli_fetch_array($riw1);
                                          echo "<a href='riwayat_inap.php' title='Riwayat Rawat Inap Pasien' data-toggle='tooltip'><i class='fas fa-info-circle text-info'></i> Pasien pernah dirawat pada tgl " . tgl_indo($riwayatinap['2']) . ' s.d. ' . tgl_indo($riwayatinap['3']) . "</a>";
                                        }
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="tab-pane fade" id="list-rotgen" role="tabpanel" aria-labelledby="list-rotgen-list">
                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Foto</label>
                              <div class="col-sm-12 col-md-7">
                                <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="page" value="<?php echo $page1; ?>">
                                <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                <input id='upload' class="form-control" name="upload[]" type="file" multiple="multiple" />
                                <div class="invalid-feedback">
                                  Mohon data diisi!
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-6"></div>
                              <div class="col-lg-4 col-md-6 text-right">
                                <input type="submit" class="btn btn-icon icon-right btn-primary" name="submitfoto" value="Upload Foto">
                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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
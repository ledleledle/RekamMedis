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
  if ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
    $bread = "<a href='rawat_jalan1.php'>";
  } elseif ($page1 == "raw2") {
    $page = "Tindakan untuk Pasien";
    $bread = "<a href='rawat_jalan2.php'>";
  } else {
    header("location:index.php");
  }

  session_start();
  include "part/head.php";
  include "part_func/tgl_ind.php";
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
                    <!-- RAWAT JALAN : Menu Pemeriksaan Pasien -->
                    <?php if ($page1 == "raw1") { ?>
                      <div class="row">
                        <div class="col-4">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-diagnosa-list" data-toggle="list" href="#list-diagnosa" role="tab">Diagnosa</a>
                            <a class="list-group-item list-group-item-action" id="list-info-list" data-toggle="list" href="#list-info" role="tab">Info Pasien</a>
                            <a class="list-group-item list-group-item-action" id="list-rekam-list" data-toggle="list" href="#list-rekam" role="tab">Rekam Medis Pasien</a>
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
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Butuh tidakan lebih lanjut?</label>
                                  <div class="col-sm-9">
                                    <select class="form-control selectric" name="status" required>
                                      <option value="1">Tidak</option>
                                      <option value="2">Ya</option>
                                    </select>
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" class="form-control" name="biaya" required="" value="50000">
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
                          </div>
                        </div>
                      </div>
                      <!-- RAWAT JALAN : Menu Tindakan Pasien -->
                    <?php } elseif ($page1 == "raw2") { ?>
                      <div class="row">
                        <div class="col-4">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-inap-list" data-toggle="list" href="#list-inap" role="tab">Rawat Inap</a>
                            <a class="list-group-item list-group-item-action" id="list-foto-list" data-toggle="list" href="#list-foto" role="tab">Foto Rotgen</a>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-inap" role="tabpanel" aria-labelledby="list-inap-list">
                              Deserunt cupidatat anim ullamco ut dolor anim sint nulla amet incididunt tempor ad ut pariatur officia culpa laboris occaecat. Dolor in nisi aliquip in non magna amet nisi sed commodo proident anim deserunt nulla veniam occaecat reprehenderit esse ut eu culpa fugiat nostrud pariatur adipisicing incididunt consequat nisi non amet.
                            </div>
                            <div class="tab-pane fade" id="list-foto" role="tabpanel" aria-labelledby="list-foto-list">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
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
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Pendaftaran Pasien";
  $page1 = "raw0";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
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
                      <div class="col-12 col-sm-12 col-md-4">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="profile-tab4" data-toggle="tab" href="#sudah_daftar" role="tab" aria-controls="profile" aria-selected="false">Memiliki Kartu Berobat</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="home-tab4" data-toggle="tab" href="#daftar" role="tab" aria-controls="home" aria-selected="true">Belum Memiliki Kartu Berobat</a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-12 col-sm-12 col-md-8">
                        <div class="tab-content no-padding" id="myTab2Content">
                          <div class="tab-pane fade" id="daftar" role="tabpanel" aria-labelledby="home-tab4">
                            <div class="card-header">
                              <h4>Daftar Pasien Baru</h4>
                            </div>
                            <div class="card-body">
                              <form class="needs-validation" novalidate="" method="POST" autocomplete="off" action="rawat_jalan_print.php">
                                <div class="form-group row align-items-center">
                                  <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
                                  <div class="col-lg-6 col-md-6">
                                    <input type="hidden" name="page" value="raw01" readonly>
                                    <input type="text" class="form-control" required="" name="nama" placeholder="Nama Lengkap Pasien">
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-md-4 text-md-right text-left">Tempat lahir</label>
                                  <div class="col-lg-6 col-md-6">
                                    <input type="text" class="form-control" name="tmp" required="" placeholder="Tempat lahir pasien">
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-md-4 text-md-right text-left">Tanggal lahir</label>
                                  <div class="col-lg-6 col-md-6">
                                    <input type="text" class="form-control datepicker" name="tgl" required="" value="<?php echo date('Y-m-d'); ?>">
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-md-4 text-md-right text-left">Jenis Kelamin</label>
                                  <div class="col-lg-6 col-md-6">
                                    <select class="form-control selectric" name="jk" required>
                                      <option value="">Pilih Jenis Kelamin Pasien</option>
                                      <option value="0">Laki - Laki</option>
                                      <option value="1">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-md-4 text-md-right text-left">Alamat</label>
                                  <div class="col-lg-6 col-md-6">
                                    <textarea type="number" class="form-control" name="alamat" required="" placeholder="Alamat Pasien"></textarea>
                                    <div class="invalid-feedback">
                                      Mohon data diisi!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-4"></div>
                                  <div class="col-lg-6 col-md-6 text-right">
                                    <button class="btn btn-icon icon-right btn-primary" name="daftar">Daftar Pasien Baru</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="tab-pane fade show active" id="sudah_daftar" role="tabpanel" aria-labelledby="profile-tab4">
                            <div class="card-header">
                              <h4>Pasien Yang Memiliki Kartu Berobat</h4>
                            </div>
                            <div class="card-body">
                              <form class="needs-validation" novalidate="" method="POST" autocomplete="off" action="rawat_jalan_print.php">
                                <div class="form-group row align-items-center">
                                  <label class="col-md-4 text-md-right text-left">Nama Lengkap / ID Pasien / Alamat</label>
                                  <div class="col-lg-6 col-md-6">
                                    <input type="hidden" name="page" value="raw00" readonly>
                                    <select class="form-control select2" name="pasien" id="myselect" required="">
                                      <option value="">Cari Nama / ID Pasien / Alamat</option>
                                      <?php
                                      $pas = mysqli_query($conn, "SELECT * FROM pasien");
                                      while ($pasien = mysqli_fetch_array($pas)) {
                                        echo "<option value='" . $pasien['id'] . "'>" . ucwords($pasien['nama_pasien']) . " / " . $pasien['kode_pasien'] . " / " . $pasien['alamat'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                    <div class="invalid-feedback">
                                      Mohon Pilih Salah Satu Pasien!
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-4"></div>
                                  <div class="col-lg-6 col-md-6 text-right">
                                    <button class="btn btn-icon icon-right btn-primary" name="daftar1">Daftar</button>
                                  </div>
                                </div>
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
        </section>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
  <script>
    $(document).ready(function() {
      $("#myselect").select2({
        width: '285px'
      });
    });
  </script>
</body>

</html>
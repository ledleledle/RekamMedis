<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Dashboard";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';

  $pegawai = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='2'");
  $jumlahpegawai = mysqli_num_rows($pegawai);
  $pasien = mysqli_query($conn, "SELECT * FROM pasien");
  $jumpasien = mysqli_num_rows($pasien);
  $rawat_inap = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id_pasien IS NOT NULL");
  $jumrawatinap = mysqli_num_rows($rawat_inap);
  $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='1'");
  $jumlahdokter = mysqli_num_rows($dokter);
  ?>
  <style>
    #link-no{
      text-decoration: none;
    }
  </style>
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
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Apoteker</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahpegawai; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-user-injured"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Data Pasien</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumpasien; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-bed"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pasien Rawat Inap</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumrawatinap; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-diagnoses"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dokter</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahdokter; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Status Ruang Rawat Inap</h4>
                  <div class="card-header-action">
                    <a href="ruangan.php">Detail</a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $sqlruangan = mysqli_query($conn, "SELECT * FROM ruang_inap ORDER BY nama_ruang ASC");
                  while ($showruangan = mysqli_fetch_array($sqlruangan)) {
                    $defpasien = $showruangan['id_pasien'];
                  ?>
                    <ul class="list-unstyled list-unstyled-border">
                      <li class="media">
                        <div class="media-body">
                          <?php
                          if ($showruangan["status"] == "0") {
                            echo '<div class="badge badge-pill badge-success mb-1 float-right">';
                            echo '<i class="ion-checkmark-round"></i> Tersedia';
                          } elseif ($showruangan["status"] == "1") {
                            echo '<div class="badge badge-pill badge-danger mb-1 float-right">';
                            echo '<i class="ion-close"></i> Dipakai';
                          } else {
                            echo '<div class="badge badge-pill badge-warning mb-1 float-right">';
                            echo '<i class="ion-gear-b"></i>  Dalam Perbaikan';
                          } ?>
                        </div>
                        <h6 class="media-title"><a href="#">Ruang <?php echo $showruangan["nama_ruang"]; ?></a></h6>
                        <div class="text-small text-muted">
                          <?php
                          if ($showruangan["status"] == "0") {
                            echo 'Tersedia';
                          } elseif ($showruangan["status"] == "1") {
                            $sqlnama = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$defpasien'");
                            $namapasien = mysqli_fetch_array($sqlnama);
                            echo 'Sdr. ' . ucwords($namapasien["nama_pasien"]);
                            echo '<div class="bullet"></div> <span class="text-primary">Sejak ' . tgl_indo($showruangan["tgl_masuk"]) . ' | ' . $showruangan["jam_masuk"] . '</span></div>';
                          } else {
                            echo '<div class="text-small text-muted">Tidak Tersedia</div>';
                          } ?>
                        </div>
                      </li>
                    </ul>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Menu Utama</h4>
                </div>
                <div class="card-body">
                  <a href="ruangan.php" id="link-no">
                    <div class="alert alert-primary alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-bed"></i> </div>
                      <div class="alert-body">
                        <div class="alert-title"> Rawat Inap</div>
                      </div>
                    </div>
                  </a>
                  <a href="rotgen.php" id="link-no">
                    <div class="alert alert-danger alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-skull"></i></div>
                      <div class="alert-body">
                        <div class="alert-title">Foto Rotgen</div>
                      </div>
                    </div>
                  </a>
                  <a href="obat.php" id="link-no">
                    <div class="alert alert-warning alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-briefcase-medical"></i></div>
                      <div class="alert-body">
                        <div class="alert-title">Data Obat</div>
                      </div>
                    </div>
                  </a>
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
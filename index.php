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
  $admin = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='3'");
  $jumlahadmin = mysqli_num_rows($admin);
  $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='1'");
  $jumlahdokter = mysqli_num_rows($dokter);
  ?>
  <style>
    #link-no {
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
                  <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Administrator</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahadmin; ?>
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
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Dokter</h4>
                  <div class="card-header-action">
                    <a href="pegawai.php">Detail</a>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <tbody>
                      <?php
                      $sql = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='1'");
                      while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <tr>
                          <td>
                            <div class="gallery">
                              <?php if ($row['foto'] == "") { ?>
                                <div class="gallery-item rounded-circle mr-1" data-image="assets/img/profile/default.png" data-title="<?php echo "Dr. " . ucwords($row['nama_pegawai']); ?>"></div>
                              <?php } else { ?>
                                <div class="gallery-item rounded-circle mr-1" data-image="<?php echo $row['foto']; ?>" data-title="<?php echo "Dr. " . ucwords($row['nama_pegawai']); ?>"></div>
                              <?php } ?>
                            </div>
                          </td>
                          <th><?php echo ucwords($row['nama_pegawai']); ?></th>
                          <td><?php echo ucwords($row['alamat']); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Menu Utama</h4>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-primary text-white">
                        <i class="fas fa-bed"></i>
                      </div>
                      <div class="card-body">
                        <h4>Rawat Jalan</h4>
                        <a href="rawat_jalan.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-danger text-white">
                        <i class="fas fa-skull"></i>
                      </div>
                      <div class="card-body">
                        <h4>Foto Rotgen</h4>
                        <a href="rotgen.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card card-large-icons">
                      <div class="card-icon bg-warning text-white">
                        <i class="fas fa-briefcase-medical"></i>
                      </div>
                      <div class="card-body">
                        <h4>Data Obat</h4>
                        <a href="obat.php" class="card-cta">Detail <i class="fas fa-chevron-right"></i></a>
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
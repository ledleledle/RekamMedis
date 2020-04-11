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
            <h2 class="section-title"><?php echo ucwords($idnama); ?> (<?php echo umur($pasien['tgl_lahir']); ?>) </h2>
            <p class="section-lead">
              <?php
              $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id='$idid'");
              $cekrekam = mysqli_num_rows($rekam);
              if ($cekrekam == 0) {
                echo 'Pasien belum memiliki catatan medis';
              } else {
                echo 'Pasien memiliki ' . $cekrekam . ' catatan medis';
              }
              ?>
            </p>

            <div class="row">
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Info Pasien</h4>
                      </div>
                      <div class="card-body">
                        <div class="gallery">
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th scope="row">Nama Lengkap</th>
                                <td> : <?php echo ucwords($idnama); ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Tanggal Lahir</th>
                                <td> : <?php echo tgl_indo($pasien['tgl_lahir']); ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Tinggi Bandan</th>
                                <td> : <?php echo $pasien['tinggi_badan'] . " cm"; ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Berat Badan</th>
                                <td> : <?php echo $pasien['berat_badan'] . " kg"; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Gallery</h4>
                      </div>
                      <div class="card-body">
                        <div class="gallery">
                          <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 1"></div>
                          <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 2"></div>
                          <div class="gallery-item" data-image="assets/img/news/img04.jpg" data-title="Image 3"></div>
                          <div class="gallery-item" data-image="assets/img/news/img11.jpg" data-title="Image 4"></div>
                          <div class="gallery-item" data-image="assets/img/news/img02.jpg" data-title="Image 5"></div>
                          <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 6"></div>
                          <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 7"></div>
                          <div class="gallery-item gallery-more" data-image="assets/img/news/img02.jpg" data-title="Image 8">
                            <div>+2</div>
                          </div>
                          <div class="gallery-item gallery-hide" data-image="assets/img/news/img11.jpg" data-title="Image 9"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Gallery <code>.gallery-md</code></h4>
                  </div>
                  <div class="card-body">
                    <div class="gallery gallery-md">
                      <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 1"></div>
                      <div class="gallery-item" data-image="assets/img/news/img14.jpg" data-title="Image 2"></div>
                      <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 3"></div>
                      <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 4"></div>
                      <div class="gallery-item" data-image="assets/img/news/img11.jpg" data-title="Image 5"></div>
                      <div class="gallery-item" data-image="assets/img/news/img09.jpg" data-title="Image 6"></div>
                      <div class="gallery-item" data-image="assets/img/news/img12.jpg" data-title="Image 8"></div>
                      <div class="gallery-item" data-image="assets/img/news/img13.jpg" data-title="Image 9"></div>
                      <div class="gallery-item" data-image="assets/img/news/img14.jpg" data-title="Image 10"></div>
                      <div class="gallery-item" data-image="assets/img/news/img15.jpg" data-title="Image 11"></div>
                      <div class="gallery-item gallery-more" data-image="assets/img/news/img08.jpg" data-title="Image 12">
                        <div>+2</div>
                      </div>
                      <div class="gallery-item gallery-hide" data-image="assets/img/news/img01.jpg" data-title="Image 9"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Gallery <code>.gallery-fw</code></h4>
                  </div>
                  <div class="card-body">
                    <div class="gallery gallery-fw" data-item-height="100">
                      <div class="gallery-item" data-image="assets/img/news/img09.jpg" data-title="Image 1"></div>
                      <div class="gallery-item" data-image="assets/img/news/img10.jpg" data-title="Image 2"></div>
                      <div class="gallery-item gallery-more" data-image="assets/img/news/img08.jpg" data-title="Image 3">
                        <div>+2</div>
                      </div>
                      <div class="gallery-item gallery-hide" data-image="assets/img/news/img01.jpg" data-title="Image 4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php include 'part/footer.php'; ?>
      </div>
    </div>
    <?php include "part/all-js.php"; ?>
</body>

</html>
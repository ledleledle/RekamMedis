<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Tindakan untuk Pasien";
  $page1 = "raw2";
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
                    <div class="table-responsive">
                      <table class="table table-striped" id="antrian">
                        <thead>
                          <tr>
                            <th>No. Antrian</th>
                            <th>ID Pasien</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM antrian WHERE status='2'");
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id_pasien'];
                          ?>
                            <tr>
                              <td><?php echo $row['no_urut']; ?></td>
                              <?php
                              $pasien = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
                              $pas = mysqli_fetch_array($pasien);
                              ?>
                              <td><?php echo $pas['kode_pasien']; ?></td>
                              <td><?php echo ucwords($pas['nama_pasien']); ?></td>
                              <td>
                                <div class="badge badge-pill badge-primary mb-1">Butuh Tindakan Lebih Lanjut</div>
                              </td>
                              <td>
                                <?php if ($row['status'] == 2) { ?>
                                  <span data-target="#editPasien" data-toggle="modal" data-id="<?php echo $idpasien; ?>" data-whatever="<?php echo ucwords($pas['nama_pasien']); ?>" data-lahir="<?php echo $row['tgl_lahir']; ?>" data-tinggi="<?php echo $row['tinggi_badan']; ?>" data-berat="<?php echo $row['berat_badan']; ?>">
                                    <a class="btn btn-primary btn-action mr-1" title="Beri tindakan pada pasien" data-toggle="tooltip"><i class="fas fa-bed"></i> Beri tindakan pada pasien</a>
                                  </span>
                                <?php } else { ?>
                                  <a class="btn btn-secondary btn-action mr-1" title="Pasien sudah diperiksa" data-toggle="tooltip"><i class="fas fa-stethoscope"></i> Pasien sudah diperiksa</a>
                                <?php } ?>
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
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
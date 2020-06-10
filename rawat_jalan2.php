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
                            <th>Nama Pasien</th>
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
                                <form action="aksi.php" method="POST">
                                  <input type="hidden" name="page" value="raw2" readonly>
                                  <input type="hidden" name="id" value="<?php echo $pas['nama_pasien']; ?>" readonly>
                                  <button class="btn btn-primary btn-action mr-1" name="raw2" title="Beri tindakan pada pasien" data-toggle="tooltip"><i class="fas fa-bed"></i> Beri tindakan pada pasien</button>
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
          </div>
        </section>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
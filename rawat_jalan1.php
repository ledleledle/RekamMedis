<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Pemeriksaan Pasien";
  $page1 = "raw1";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['reset_ant'])) {
    #$del = mysqli_query($conn, "DELETE FROM antrian WHERE status='1' OR status='0'");
    $del = mysqli_query($conn, "TRUNCATE TABLE antrian");
    echo '<script>
    setTimeout(function() {
      swal({
        title: "Antrian Berhasil Di Reset!",
        text: "Antrian Pasien Berhasil Di Reset",
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
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Antrian <?php echo $page; ?></h4>
                    <div class="card-header-action">
                      <a href="#" data-target="#reset_ant" data-toggle="modal" class="btn btn-danger">Reset Antrian</a>
                    </div>
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
                          $sql = mysqli_query($conn, "SELECT * FROM antrian WHERE status='0'");
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
                                <div class="badge badge-pill badge-primary mb-1">Belum diperiksa</div>
                              </td>
                              <td>
                                <form action="aksi.php" method="POST">
                                  <input type="hidden" name="page" value="raw1" readonly>
                                  <input type="hidden" name="id" value="<?php echo $pas['nama_pasien']; ?>" readonly>
                                  <button class="btn btn-primary btn-action mr-1" name="raw2" title="Periksa Pasien" data-toggle="tooltip"><i class="fas fa-stethoscope"></i> Periksa Pasien</button>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="reset_ant">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Antrian Pasien</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                Apakah anda yakin ingin menghapus antrian pasien?
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger" name="reset_ant">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
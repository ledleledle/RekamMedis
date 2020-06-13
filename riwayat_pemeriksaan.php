<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Riwayat Pemeriksaan Pasien";
  $page1 = "det2";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include "part_func/tgl_ind.php";
  include "part_func/umur.php";
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
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Riwayat Pemeriksaan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-2">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Penyakit</th>
                            <th>Dokter</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit");
                          while ($row = mysqli_fetch_array($rekam)) {
                            $id = $row['id_pasien'];
                            $id_doc = $row['id_dokter'];
                          ?>
                            <tr>
                              <th><?php echo tgl_indo($row['tgl']); ?></th>
                              <?php
                              $nama = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
                              $listnama = mysqli_fetch_array($nama);
                              ?>
                              <td><?php echo $listnama['kode_pasien']; ?></td>
                              <?php
                              echo "<td>" . ucwords($listnama['nama_pasien']) . "</td>";
                              ?>
                              <td><?php echo ucwords($row['penyakit']); ?></td>
                              <td><?php
                              $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE id='$id_doc'");
                              $doc = mysqli_fetch_array($dokter);
                              echo ucwords($doc['nama_pegawai']);
                              ?></td>
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
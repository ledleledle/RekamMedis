<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Foto Rotgen";
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
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Pasien yang memiliki foto rotgen</h4>
                    <div class="card-header-action">
                      <a href="rawat_jalan.php" class="btn btn-primary">Tambah Foto Rotgen</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Nama Pasien</th>
                            <th>Jumlah Foto Rotgen</th>
                            <th>Biaya</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM foto_rotgen GROUP BY id_pasien");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id_pasien'];
                            $sqlpasien = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
                            $pasien = mysqli_fetch_array($sqlpasien);
                            $sqlpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idpasien'");
                            $penyakit = mysqli_fetch_array($sqlpenyakit);
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo ucwords($pasien['nama_pasien']); ?></td>
                              <td>* <?php echo ucwords($penyakit['penyakit']); ?></td>
                              <td>Rp. <?php echo number_format($row['biaya'], 0, ".", "."); ?></td>
                              <td align="center">
                                <span data-target="#editObat" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_obat']; ?>" data-harga="<?php echo $row['harga']; ?>" data-stok="<?php echo $row['stok']; ?>">
                                  <a class="btn btn-primary btn-action mr-1" title="Edit Data Obat" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                </span>
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=obat&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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
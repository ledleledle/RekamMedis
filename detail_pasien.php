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
              $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid'");
              $cekrekam = mysqli_num_rows($rekam);
              if ($cekrekam == 0) {
                echo 'Pasien belum memiliki catatan medis';
              } else {
                echo 'Pasien memiliki ' . $cekrekam . ' catatan medis';
              }
              ?>
            </p>

            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Catatan Riwayat Penyakit Pasien</h4>
                      <div class="card-header-action">
                        <a href="rawat_jalan.php" class="btn btn-primary">Rawat Jalan</a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Penyakit</th>
                              <th>Tanggal Berobat</th>
                              <th>Rawat Inap</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY tgl ASC");
                            $i = 0;
                            while ($row = mysqli_fetch_array($sql)) {
                              $i++;
                            ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                                <td><?php echo ucwords($row['penyakit']); ?></td>
                                <td><?php
                                $status = substr($row['id_rawatinap'], 0, 3);
                                $idrawatinap = substr($row['id_rawatinap'], 3);
                                    if ($row['id_rawatinap'] == '0') {
                                      echo 'Pasien tidak membutuhkan Rawat Inap';
                                    } else {
                                      if ($status == "tmp") {
                                        $ruang = mysqli_query($conn, "SELECT * FROM ruang_inap WHERE id='$idrawatinap'");
                                        $showruang = mysqli_fetch_array($ruang);
                                        echo "Pasien masih dirawat di ruang ".$showruang['nama_ruang'];
                                      } else {
                                        echo '<div class="badge badge-pill badge-success mb-1">Apoteker';
                                      }
                                    } ?>
                      </div>
                      </td>
                      <td>
                        <span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_pegawai']; ?>" data-user="<?php echo $row['username']; ?>" data-alam="<?php echo $row['alamat']; ?>">
                          <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                        </span>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=pegawai&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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

        </section>
      </div>

      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
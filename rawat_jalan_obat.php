<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  include 'auth/connect.php';
  $page = "Pemberian Obat untuk Pasien";
  $page1 = "raw1";
  $bread = "rawat_jalan1.php";

  $id = $_POST['idlae'];
  $penyakit = $_POST['penyakit'];
  $diagnosa = $_POST['diagnosa'];
  $biaya = $_POST['biaya'];
  $tglnow = date('Y-m-d');
  $berat = $_POST['berat'];
  $tinggi = $_POST['tinggi'];
  $tensi  = $_POST['tensi'];
  $statusnya = $_POST['status'];
  $doc = $_POST['dokter'];
  $kodeobat = str_replace("-", "", $id . $tglnow . $doc);

  //$submit = mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, id_rawatinap, biaya_pengobatan, tinggi, berat, tensi, id_dokter) VALUES ('$id', '$penyakit', '$diagnosa', '$tglnow', '0', '$biaya', '$tinggi', '$berat', '$tensi', '$doc')");
  //$update_antrian = mysqli_query($conn, "UPDATE antrian SET status='$statusnya' WHERE id_pasien='$id'");

  if (isset($_POST['submite'])) {
    $id = $_POST['idlae'];
    $penyakit = $_POST['penyakit'];
    $diagnosa = $_POST['diagnosa'];
    $biaya = $_POST['biaya'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi  = $_POST['tensi'];
    $statusnya = $_POST['status'];
    $doc = $_POST['dokter'];

    $id2 = $_POST['id'];
    $jum = $_POST['jumlah'];
    $cekcek = mysqli_query($conn, "SELECT * FROM riwayat_penyakit");
    $id_penya = mysqli_num_rows($cekcek) + 1;
    $owbat = mysqli_query($conn, "SELECT * FROM obat WHERE id='$id2'");
    $stokobat = mysqli_fetch_array($owbat);
    $stoknya = $stokobat['stok'];
    if ($stoknya < $jum) {
      echo '<script>
				setTimeout(function() {
					swal({
						title: "Gagal!",
						text: "Jumlah pengambilan obat tidak dapat melebihi stok!",
						icon: "error"
						});
					}, 500);
			</script>';
    } else {
      $cekobattmp = mysqli_query($conn, "SELECT * FROM obat2 WHERE kode='$kodeobat' AND id_obat='$id2'");
      $cekobattmp2 = mysqli_num_rows($cekobattmp);
      $obatasli = mysqli_query($conn, "UPDATE obat SET stok=stok-$jum WHERE id='$id2'");
      if ($cekobattmp2 == 0) {
        $obat_tmp = mysqli_query($conn, "INSERT INTO obat2 (kode, id_penyakit, id_obat, jum_obat) VALUES ('$kodeobat', '$id_penya', '$id2', '$jum')");
        echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Obat telah dipilih!",
						icon: "success"
						});
					}, 500);
      </script>';
      } else {
        $obat_tmp = mysqli_query($conn, "UPDATE obat2 SET jum_obat=jum_obat+$jum WHERE kode='$kodeobat' AND id_obat='$id2'");
        echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil menambahkan!",
						text: "Obat telah berhasil ditambahkan!",
						icon: "success"
						});
					}, 500);
      </script>';
      }
    }
  }

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
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><?php echo "<a href='" . $bread . "'> " . $page; ?></a></div>
              <div class="breadcrumb-item">Pemilihan Obat</div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Info Pasien</h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <tr>
                      <th>Nama/ID Pasien</th>
                      <td> : </td>
                      <td><?php
                          $nam = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
                          $nama = mysqli_fetch_array($nam);
                          echo ucwords($nama['nama_pasien']);
                          ?></td>
                    </tr>
                    <tr>
                      <th>Menderita Penyakit</th>
                      <td> : </td>
                      <td><?php echo ucwords($penyakit); ?></td>
                    </tr>
                    <tr>
                      <th>Kode Pengambilan Obat</th>
                      <td> : </td>
                      <th><?php echo $kodeobat; ?></th>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped table-bordered" id="table-211">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Stok</th>
                          <th>Harga per unit</th>
                          <th>Aksi</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM obat");
                        while ($row = mysqli_fetch_array($sql)) {
                          $idobat = $row['id'];
                        ?>
                          <tr>
                            <td><?php echo ucwords($row['nama_obat']) ?></td>
                            <td><b><?php echo $row['stok'] . "</b> Unit"; ?></td>
                            <td>Rp. <?php echo number_format($row['harga'], 0, ".", "."); ?></td>
                            <td><a href="" class="btn btn-primary" data-target="#obat" data-toggle="modal" data-id="<?php echo $idobat; ?>" data-pasien="<?php echo $id; ?>">Pilih Obat</a></td>
                            <th>
                              <?php
                              $sto = mysqli_query($conn, "SELECT * FROM obat2 WHERE kode='$kodeobat' AND id_obat='$idobat'");
                              $stok = mysqli_fetch_array($sto);
                              if (!isset($stok['jum_obat'])) {
                                echo "Tidak dipilih";
                              } else {
                                echo $stok['jum_obat'] . " unit";
                              }
                              ?>
                            </th>
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
      <div class="modal fade" tabindex="-1" role="dialog" id="obat">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Beri Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jumlah</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="idlae" value="<?php echo $id; ?>" required="">
                    <input type="hidden" class="form-control" name="penyakit" value="<?php echo $penyakit; ?>" required="">
                    <input type="hidden" class="form-control" name="diagnosa" value="<?php echo $diagnosa; ?>" required="">
                    <input type="hidden" class="form-control" name="biaya" value="<?php echo $biaya; ?>" required="">
                    <input type="hidden" class="form-control" name="berat" value="<?php echo $berat; ?>" required="">
                    <input type="hidden" class="form-control" name="tinggi" value="<?php echo $tinggi; ?>" required="">
                    <input type="hidden" class="form-control" name="tensi" value="<?php echo $tensi; ?>" required="">
                    <input type="hidden" class="form-control" name="status" value="<?php echo $statusnya; ?>" required="">
                    <input type="hidden" class="form-control" name="dokter" value="<?php echo $doc; ?>" required="">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="hidden" class="form-control" name="idpasien" required="" id="getPas">
                    <input type="number" class="form-control" name="jumlah" required="" min="1">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submite">Selesai</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
  <script>
    $('#obat').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('pasien')
      var id = button.data('id')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getPas').val(nama)
    })
  </script>

</body>

</html>
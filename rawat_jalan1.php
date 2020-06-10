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
    $del = mysqli_query($conn, "DELETE FROM antrian WHERE status='1' OR status='0'");
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

  if (isset($_POST['submit'])) {
    $idpasien = $_POST['id'];
    $penyakit = $_POST['penyakit'];
    $diagnosa = $_POST['diagnosa'];
    $biaya = $_POST['biaya'];
    $tglnow = date('Y-m-d');
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi  = $_POST['tensi'];
    $statusnya = $_POST['status'];

    $submit = mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, id_rawatinap, biaya_pengobatan, tinggi, berat, tensi) VALUES ('$idpasien', '$penyakit', '$diagnosa', '$tglnow', '0', '$biaya', '$tinggi', '$berat', '$tensi')");
    $update_antrian = mysqli_query($conn, "UPDATE antrian SET status='$statusnya' WHERE id_pasien='$idpasien'");
    echo '<script>
    setTimeout(function() {
      swal({
        title: "Pasien Sudah Diperiksa!",
        text: "Pasien diharapkan segera menuju ke ruang tindakan",
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
                                <!-- <span data-target="#editPasien" data-toggle="modal" data-id="<?php echo $idpasien; ?>" data-whatever="<?php echo ucwords($pas['nama_pasien']); ?>" data-lahir="<?php echo $row['tgl_lahir']; ?>" data-tinggi="<?php echo $row['tinggi_badan']; ?>" data-berat="<?php echo $row['berat_badan']; ?>">
                                  <a class="btn btn-primary btn-action mr-1" title="Periksa Pasien" data-toggle="tooltip"><i class="fas fa-stethoscope"></i> Periksa Pasien</a>
                                </span> -->
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editPasien">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="detail_pasien.php" method="POST" novalidate="" target="_blank">
                <div class="form-group row">
                  <div class="col-sm-9">
                    <input type="hidden" name="id" required="" id="getNama">
                    <button type="submit" class="btn btn-primary" name="submit">Periksa Rekam Medis Pasien</button>
                  </div>
                </div>
              </form>
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tekanan Darah</label>
                  <div class="input-group col-sm-9">
                    <input type="hidden" name="id" required="" id="getId">
                    <input type="number" class="form-control" name="tensi" required="" placeholder="Tekanan Darah Pasien">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        mmHg
                      </div>
                    </div>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Berat Badan</label>
                  <div class="input-group col-sm-9">
                    <input type="number" class="form-control" name="berat" required="" value="0" placeholder="Berat Badan Pasien">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Kg
                      </div>
                    </div>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tinggi Badan</label>
                  <div class="col-sm-9 input-group">
                    <input type="number" class="form-control" name="tinggi" required="" value="0" placeholder="Tinggi Badan Pasien">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        cm
                      </div>
                    </div>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Diagnosa Penyakit</label>
                  <div class="col-sm-9">
                    <textarea placeholder="Wajib" class="summernote" name="diagnosa" required></textarea>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Fonis Penyakit</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="penyakit" required="" placeholder="Nama Penyakit yang menyerang Pasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Butuh tidakan lebih lanjut?</label>
                  <div class="col-sm-9">
                    <select class="form-control selectric" name="status" required>
                      <option value="1">Tidak</option>
                      <option value="2">Ya</option>
                    </select>
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Biaya Pemeriksaan</label>
                  <div class="input-group col-md-9">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input type="number" class="form-control" name="biaya" required="" value="0">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Pemeriksaan Selesai</button>
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
    $('#editPasien').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var recipient = button.data('whatever')
      var id = button.data('id')
      var modal = $(this)
      modal.find('.modal-title').text('Pemeriksaan Pasien yang bernama ' + recipient)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(recipient)
    })
  </script>
</body>

</html>
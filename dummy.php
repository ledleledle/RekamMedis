<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
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
    </div>
  </div>
  <div class="col-12 col-sm-6 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Semua Foto Rotgen Pasien</h4>
      </div>
      <div class="card-body">
        <div class="gallery gallery-md">
          <?php
          $sqlimg = mysqli_query($conn, "SELECT * FROM foto_rotgen WHERE id_pasien='$idid'");
          if (mysqli_num_rows($sqlimg) == "0") {
            echo 'Tidak ada data';
          } else {
            while ($img = mysqli_fetch_array($sqlimg)) {
              $penyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid'");
              $echopen = mysqli_fetch_array($penyakit);
              echo '<div class="gallery-item" data-image="' . $img['directory'] . '" data-title="Penyakit : ' . $echopen['penyakit'] . ' (' . tgl_indo($echopen['tgl']) . ')"></div>';
            }
          } ?>
        </div>
      </div>
    </div>
  </div>
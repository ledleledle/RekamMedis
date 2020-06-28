<?php
$idnama = $_POST['id'];
$page1 = "det";
$page = "Detail Pasien : " . $idnama;
session_start();
include 'auth/connect.php';
include "part/head.php";
include 'part_func/umur.php';
include 'part_func/tgl_ind.php';

//All SQL Syntax
$cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
$pasien = mysqli_fetch_array($cek);
$idid = $pasien['id'];
@$idriwayat = $_POST['idriwayat'];

if (isset($_POST['printone']) || isset($_POST['detail'])) {
  $riwayatpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' AND id='$idriwayat'");
  $terakhir = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY id DESC LIMIT 1");
  $riwayat_terakhir = mysqli_fetch_array($terakhir);
} elseif (isset($_POST['print_foto'])) {
  $idfoto = $_POST['idfoto'];
  $sqlimg = mysqli_query($conn, "SELECT * FROM foto_rotgen WHERE id_pasien='$idid' AND id_penyakit='$idfoto'");
  $penyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' AND id='$idfoto'");
  $echopen = mysqli_fetch_array($penyakit);
}
?>

<div class="section-body">
  <?php if (isset($_POST['print_foto'])) { ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="gallery gallery-md">
              <?php
              if (mysqli_num_rows($sqlimg) == "0") {
                echo 'Tidak ada data';
              } else {
                while ($img = mysqli_fetch_array($sqlimg)) {
                  $dirimg = $img['directory'];

                  echo '<img src="' . $dirimg . '" width="100%" style="margin-bottom: 200px;">';
                }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="row">
      <div class="col-12 col-sm-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Info Pasien</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="gallery">
              <table class="table table-striped table-sm">
                <tbody>
                  <tr>
                    <th scope="row">Nama Lengkap</th>
                    <td> : <?php echo ucwords($idnama); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tempat / Tanggal Lahir</th>
                    <td> : <?php echo ucwords($pasien['tmp_lahir']) . " / " . tgl_indo($pasien['tgl_lahir']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jenis Kelamin</th>
                    <td> :
                      <?php if ($pasien['jk'] == "0") {
                        echo "Laki - Laki";
                      } else {
                        echo "Perempuan";
                      } ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Tinggi Bandan Terakhir</th>
                    <td> : <?php echo (@$riwayat_terakhir['tinggi'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['tinggi'] . " cm"; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Berat Badan Terakhir</th>
                    <td> : <?php echo (@$riwayat_terakhir['berat'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['berat'] . " kg"; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tekanan Darah Terakhir</th>
                    <td> : <?php echo (@$riwayat_terakhir['tensi'] == "") ? "Pasien Belum Pernah Diperiksa" : $riwayat_terakhir['tensi'] . " mmHg"; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Alamat</th>
                    <td> : <?php echo ucwords($pasien['alamat']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Catatan Riwayat Penyakit Pasien</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="table-1">
                <thead>
                  <tr>
                    <th>Tanggal Berobat</th>
                    <th>Penyakit</th>
                    <th>Diagnosa</th>
                    <th>Keterangan</th>
                    <th>Obat</th>
                    <th>Total Biaya</th>
                  </tr>
                </thead>
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' AND id='$idriwayat'");
                $i = 0;
                while ($row = mysqli_fetch_array($sql)) {
                  $idpenyakit = $row['id'];
                  $id_dokter = $row['id_dokter'];
                  $biayaperiksa = $row['biaya_pengobatan'];
                ?>
                  <tr>
                    <td><?php echo ucwords(tgl_indo($row['tgl'])); ?></td>
                    <td><?php echo ucwords($row['penyakit']); ?></td>
                    <td><?php echo $row['diagnosa']; ?>
                    </td>
                    <td>
                      <?php
                      $rotgensql = mysqli_query($conn, "SELECT * FROM foto_rotgen WHERE id_pasien='$idid' AND id_penyakit='$idpenyakit'");
                      $jumrotgen = mysqli_num_rows($rotgensql);
                      if ($jumrotgen == 0) {
                        echo '- Tidak ada foto rotgen<br>';
                      } else {
                        $count = 0;
                        while ($showobat = mysqli_fetch_array($rotgensql)) {
                          $foto = mysqli_query($conn, "SELECT * FROM foto_rotgen WHERE id_pasien='$idid' AND id_penyakit='$idpenyakit'");
                          $fotorot = mysqli_fetch_array($foto);
                          @$hargafoto += $fotorot['biaya'];
                        }
                      ?>
                        <form action="detail_rotgen.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                          <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">
                          <button type="submit" title="Detail Foto Rotgen Pasien" data-toggle="tooltip" id="btn-link"><i class="fas fa-info-circle text-info"></i> <?php echo $jumrotgen; ?> Foto Rotgen</button>
                        </form>
                      <?php
                      }
                      echo "- Berat : " . $row['berat'] . " kg, ";
                      echo "Tinggi : " . $row['tinggi'] . " cm, ";
                      echo "Tekanan Darah : " . $row['tensi'] . " mmHg";
                      $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE id='$id_dokter'");
                      $doc = mysqli_fetch_array($dokter);
                      echo "<br>- Diperiksa oleh Dr. " . ucwords($doc['nama_pegawai']);
                      ?>
                    </td>
                    <td>
                      <?php
                      $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_penyakit='$idpenyakit' AND id_pasien='$idid'");
                      $jumobat = mysqli_num_rows($obat2an);
                      if ($jumobat == 0) {
                        echo "Tidak ada obat yang diberikan";
                        @$hargaobat = 0;
                      } else {
                        $count = 0;
                        while ($showobat = mysqli_fetch_array($obat2an)) {
                          $jumjumjum = $showobat['jumlah'];
                          $idobat = $showobat['id_obat'];
                          $obatlagi = mysqli_query($conn, "SELECT * FROM obat WHERE id='$idobat'");
                          $namaobat = mysqli_fetch_array($obatlagi);
                          echo $str = ucwords($namaobat['nama_obat']);
                          $count = $count + 1;

                          if ($count < $jumobat) {
                            echo ", ";
                          }
                          @$hargaobat += $namaobat['harga'] * $jumjumjum;
                        }
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      echo " Rp. ";
                      @$sum += $biayaperiksa + @$hargaobat + @$hargafoto;
                      echo number_format($biayaperiksa + @$hargaobat + @$hargafoto, 0, ".", ".");
                      ?>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <th colspan="5">
                    Total yang harus dibayar :
                  </th>
                  <th><?php echo "Rp. " . number_format($sum, 0, ".", "."); ?></th>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }
  if (!isset($_POST['detail'])) {
    if (!isset($_POST['print_foto'])) {
      echo '<footer class="main-footer">
    <div class="footer-left">
      Struk ini dicetak pada tanggal ' . tgl_indo(date('Y-m-d')) . '
    </div>
  </footer>';
    }
    echo '<script> window.print(); </script>';
  } ?>
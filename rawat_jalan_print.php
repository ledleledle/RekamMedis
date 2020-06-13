<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  include 'auth/connect.php';
  include 'part/navbar.php';
  $page1 = $_POST['page'];
  if ($page1 == "raw0") {
    $page = "Pendaftaran Pasien";
    $bread = "<a href='rawat_jalan.php'>";
  } elseif ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
    $bread = "<a href='rawat_jalan1.php'>";

    $id = $_POST['idlae'];
    $penyakit = $_POST['penyakit'];
    $diagnosa = $_POST['diagnosa'];
    $biaya = $_POST['biaya'];
    $tglnow = date('Y-m-d');
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi  = $_POST['tensi'];
    $statusnya = $_POST['status'];

    $submit = mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, id_rawatinap, biaya_pengobatan, tinggi, berat, tensi, id_dokter) VALUES ('$id', '$penyakit', '$diagnosa', '$tglnow', '0', '$biaya', '$tinggi', '$berat', '$tensi', '$sessionid')");
    $update_antrian = mysqli_query($conn, "UPDATE antrian SET status='$statusnya' WHERE id_pasien='$id'");
    echo '<script>
      setTimeout(function() {
        swal({
          title: "Pasien Sudah Diperiksa!",
          text: "Pasien diharapkan segera menuju ke ruang tindakan",
          icon: "success"
          });
        }, 500);
      </script>';
  } elseif ($page1 == "raw2") {
    $page = "Tindakan untuk Pasien";
    $bread = "<a href='rawat_jalan2.php'>";
  }


  include "part/head.php";
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $mbuh; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><?php echo $bread . " " . $page; ?></a></div>
              <div class="breadcrumb-item">Print</div>
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
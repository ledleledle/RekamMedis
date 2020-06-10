<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $idnama = $_POST['id'];
  $page1 = $_POST['page'];
  if ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
    $bread = "<a href='rawat_jalan1.php'>";
  } elseif ($page1 == "raw2") {
    $page = "Tindakan untuk Pasien";
    $bread = "<a href='rawat_jalan2.php'>";
  }

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
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><?php echo $bread . " " . $page; ?></a></div>
              <div class="breadcrumb-item">Nama Pasien : <?php echo ucwords($idnama); ?></div>
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
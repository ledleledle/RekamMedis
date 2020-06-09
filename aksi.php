<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page1 = "raw1";
  if ($page1 == "raw1") {
    $page = "Pemeriksaan Pasien";
  } elseif ($page1 == "raw2") {
    $page = "Tindakan untuk Pasien";
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
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                  </div>
                  <div class="card-body">
                    <?php if ($page1 == "raw1") { ?>
                      <div class="row">
                        <div class="col-4">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-diagnosa-list" data-toggle="list" href="#list-diagnosa" role="tab">Diagnosa</a>
                            <a class="list-group-item list-group-item-action" id="list-info-list" data-toggle="list" href="#list-info" role="tab">Info Pasien</a>
                            <a class="list-group-item list-group-item-action" id="list-rekam-list" data-toggle="list" href="#list-rekam" role="tab">Rekam Medis Pasien</a>
                            <a class="list-group-item list-group-item-action" id="list-obat-list" data-toggle="list" href="#list-obat" role="tab">Obat yang diberikan</a>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-diagnosa" role="tabpanel" aria-labelledby="list-diagnosa-list">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                            </div>
                            <div class="tab-pane fade" id="list-info" role="tabpanel" aria-labelledby="list-info-list">
                              info
                            </div>
                            <div class="tab-pane fade" id="list-rekam" role="tabpanel" aria-labelledby="list-rekam-list">
                              Deserunt cupidatat anim ullamco ut dolor anim sint nulla amet incididunt tempor ad ut pariatur officia culpa laboris occaecat. Dolor in nisi aliquip in non magna amet nisi sed commodo proident anim deserunt nulla veniam occaecat reprehenderit esse ut eu culpa fugiat nostrud pariatur adipisicing incididunt consequat nisi non amet.
                            </div>
                            <div class="tab-pane fade" id="list-obat" role="tabpanel" aria-labelledby="list-obat-list">
                              In quis non esse eiusmod sunt fugiat magna pariatur officia anim ex officia nostrud amet nisi pariatur eu est id ut exercitation ex ad reprehenderit dolore nostrud sit ut culpa consequat magna ad labore proident ad qui et tempor exercitation in aute veniam et velit dolore irure qui ex magna ex culpa enim anim ea mollit consequat ullamco exercitation in.
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } elseif ($page1 == "raw2") { ?>
                      awaw
                    <?php } ?>
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
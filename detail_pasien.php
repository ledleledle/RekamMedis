<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $idnama = $_POST['id'];
  $page1 = "det";
  $page = "Detail Pasien : ".$idnama;
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
            <h1>Detail Pasien</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Data Pasien</a></div>
              <div class="breadcrumb-item">Detail Pasien</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title"><?php echo ucwords($idnama); ?></h2>
            <p class="section-lead">Grouping multiple images on one component.</p>

            <div class="row">
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Gallery</h4>
                      </div>
                      <div class="card-body">
                        <div class="gallery">
                          <div class="gallery-item" data-image="assets/img/news/img01.jpg" data-title="Image 1"></div>
                          <div class="gallery-item" data-image="assets/img/news/img02.jpg" data-title="Image 2"></div>
                          <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 3"></div>
                          <div class="gallery-item" data-image="assets/img/news/img04.jpg" data-title="Image 4"></div>
                          <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 5"></div>
                          <div class="gallery-item" data-image="assets/img/news/img06.jpg" data-title="Image 6"></div>
                          <div class="gallery-item" data-image="assets/img/news/img07.jpg" data-title="Image 7"></div>
                          <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 8"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Gallery</h4>
                      </div>
                      <div class="card-body">
                        <div class="gallery">
                          <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 1"></div>
                          <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 2"></div>
                          <div class="gallery-item" data-image="assets/img/news/img04.jpg" data-title="Image 3"></div>
                          <div class="gallery-item" data-image="assets/img/news/img11.jpg" data-title="Image 4"></div>
                          <div class="gallery-item" data-image="assets/img/news/img02.jpg" data-title="Image 5"></div>
                          <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 6"></div>
                          <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 7"></div>
                          <div class="gallery-item gallery-more" data-image="assets/img/news/img02.jpg" data-title="Image 8">
                            <div>+2</div>
                          </div>
                          <div class="gallery-item gallery-hide" data-image="assets/img/news/img11.jpg" data-title="Image 9"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Gallery <code>.gallery-md</code></h4>
                  </div>
                  <div class="card-body">
                    <div class="gallery gallery-md">
                      <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 1"></div>
                      <div class="gallery-item" data-image="assets/img/news/img14.jpg" data-title="Image 2"></div>
                      <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 3"></div>
                      <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 4"></div>
                      <div class="gallery-item" data-image="assets/img/news/img11.jpg" data-title="Image 5"></div>
                      <div class="gallery-item" data-image="assets/img/news/img09.jpg" data-title="Image 6"></div>
                      <div class="gallery-item" data-image="assets/img/news/img12.jpg" data-title="Image 8"></div>
                      <div class="gallery-item" data-image="assets/img/news/img13.jpg" data-title="Image 9"></div>
                      <div class="gallery-item" data-image="assets/img/news/img14.jpg" data-title="Image 10"></div>
                      <div class="gallery-item" data-image="assets/img/news/img15.jpg" data-title="Image 11"></div>
                      <div class="gallery-item gallery-more" data-image="assets/img/news/img08.jpg" data-title="Image 12">
                        <div>+2</div>
                      </div>
                      <div class="gallery-item gallery-hide" data-image="assets/img/news/img01.jpg" data-title="Image 9"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Gallery <code>.gallery-fw</code></h4>
                  </div>
                  <div class="card-body">
                    <div class="gallery gallery-fw" data-item-height="100">
                      <div class="gallery-item" data-image="assets/img/news/img09.jpg" data-title="Image 1"></div>
                      <div class="gallery-item" data-image="assets/img/news/img10.jpg" data-title="Image 2"></div>
                      <div class="gallery-item gallery-more" data-image="assets/img/news/img08.jpg" data-title="Image 3">
                        <div>+2</div>
                      </div>
                      <div class="gallery-item gallery-hide" data-image="assets/img/news/img01.jpg" data-title="Image 4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>
</body>

</html>
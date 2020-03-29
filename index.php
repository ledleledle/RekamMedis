<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  $page = "Dashboard";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';
  
  $pegawai = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='2'");
  $jumlahpegawai = mysqli_num_rows($pegawai);
  $pasien = mysqli_query($conn, "SELECT * FROM pasien");
  $jumpasien = mysqli_num_rows($pasien);
  $rawat_inap = mysqli_query($conn, "SELECT * FROM riwayat_rawatinap WHERE id_pasien IS NOT NULL");
  $jumrawatinap = mysqli_num_rows($rawat_inap);
  $dokter = mysqli_query($conn, "SELECT * FROM pegawai WHERE pekerjaan='1'");
  $jumlahdokter = mysqli_num_rows($dokter);
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
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Apoteker</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahpegawai; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-user-injured"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Data Pasien</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumpasien; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-bed"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pasien Rawat Inap</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumrawatinap; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-diagnoses"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dokter</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahdokter; ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Status Ruang Rawat Inap</h4>
                  <div class="card-header-action">
                <a href="#">Detail</a>
              </div>
                </div>
                <div class="card-body">
                  <?php include 'part_func/ruangan.php';
                  while($showruangan = mysqli_fetch_array($sqlruangan)){
                  ?>
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                      <div class="media-body">
                        
                          <?php
                          if($showruangan["status"] == ""){
                            echo '<div class="badge badge-pill badge-success mb-1 float-right">';
                            echo '<i class="ion-checkmark-round"></i> Tersedia';
                            
                          } elseif ($showruangan["status"] == "1") {
                            echo '<div class="badge badge-pill badge-danger mb-1 float-right">';
                            echo '<i class="ion-close"></i> Dipakai';
                          } else{
                            echo '<div class="badge badge-pill badge-warning mb-1 float-right">';
                            echo '<i class="ion-gear-b"></i>  Dalam Perbaikan';
                          } ?>
                          </div>
                        <h6 class="media-title"><a href="#">Ruang <?php echo $showruangan["nama_ruang"]; ?></a></h6>
                        <div class="text-small text-muted">
                        <?php
                          if($showruangan["status"] == ""){
                            echo 'Tersedia';
                            //echo '<div class="bullet"></div> <span class="text-primary">Harga per Hari : Rp. '.$showruangan["biaya"].'</span></div>';
                          } elseif ($showruangan["status"] == "1") {
                            echo 'Sdr. '.$showruangan["id_pasien"];
                            echo '<div class="bullet"></div> <span class="text-primary">Sejak '.tgl_indo($showruangan["tgl_masuk"]).' | '.$showruangan["jam_masuk"].'</span></div>';
                          } else{
                            echo '<div class="text-small text-muted">Tidak Tersedia</div>';
                          } ?>
                      </div>
                    </li>
                  </ul>
                <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Aktifitas Terakhir</h4>
                </div>
                <div class="card-body">             
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
                      <div class="media-body">
                        <div class="float-right text-primary">Now</div>
                        <div class="media-title">Farhan A Mujib</div>
                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                      <div class="media-body">
                        <div class="float-right">12m</div>
                        <div class="media-title">Ujang Maman</div>
                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-3.png" alt="avatar">
                      <div class="media-body">
                        <div class="float-right">17m</div>
                        <div class="media-title">Rizal Fakhri</div>
                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
                      <div class="media-body">
                        <div class="float-right">21m</div>
                        <div class="media-title">Alfa Zulkarnain</div>
                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                      </div>
                    </li>
                  </ul>
                  <div class="text-center pt-1 pb-1">
                    <a href="#" class="btn btn-primary btn-lg btn-round">
                      Lihat Semua
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-body pt-2 pb-2">
                  <div id="myWeather">Please wait</div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Authors</h4>
                </div>
                <div class="card-body">
                  <div class="row pb-2">
                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                      <div class="avatar-item mb-0">
                        <img alt="image" src="assets/img/avatar/avatar-5.png" class="img-fluid" data-toggle="tooltip" title="Alfa Zulkarnain">
                        <div class="avatar-badge" title="Editor" data-toggle="tooltip"><i class="fas fa-wrench"></i></div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                      <div class="avatar-item mb-0">
                        <img alt="image" src="assets/img/avatar/avatar-4.png" class="img-fluid" data-toggle="tooltip" title="Egi Ferdian">
                        <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                      <div class="avatar-item mb-0">
                        <img alt="image" src="assets/img/avatar/avatar-1.png" class="img-fluid" data-toggle="tooltip" title="Jaka Ramadhan">
                        <div class="avatar-badge" title="Author" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                      <div class="avatar-item mb-0">
                        <img alt="image" src="assets/img/avatar/avatar-2.png" class="img-fluid" data-toggle="tooltip" title="Ryan">
                        <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Referral URL</h4>
                </div>
                <div class="card-body">
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                    <div class="font-weight-bold mb-1">Google</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>                          
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                    <div class="font-weight-bold mb-1">Facebook</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                    <div class="font-weight-bold mb-1">Bing</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">884</div>
                    <div class="font-weight-bold mb-1">Yahoo</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">473</div>
                    <div class="font-weight-bold mb-1">Kodinger</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="28%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">418</div>
                    <div class="font-weight-bold mb-1">Multinity</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" data-width="20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Popular Browser</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col text-center">
                      <div class="browser browser-chrome"></div>
                      <div class="mt-2 font-weight-bold">Chrome</div>
                      <div class="text-muted text-small"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 48%</div>
                    </div>
                    <div class="col text-center">
                      <div class="browser browser-firefox"></div>
                      <div class="mt-2 font-weight-bold">Firefox</div>
                      <div class="text-muted text-small"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 26%</div>
                    </div>
                    <div class="col text-center">
                      <div class="browser browser-safari"></div>
                      <div class="mt-2 font-weight-bold">Safari</div>
                      <div class="text-muted text-small"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 14%</div>
                    </div>
                    <div class="col text-center">
                      <div class="browser browser-opera"></div>
                      <div class="mt-2 font-weight-bold">Opera</div>
                      <div class="text-muted text-small">7%</div>
                    </div>
                    <div class="col text-center">
                      <div class="browser browser-internet-explorer"></div>
                      <div class="mt-2 font-weight-bold">IE</div>
                      <div class="text-muted text-small"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 5%</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-sm-5 mt-md-0">
                <div class="card-header">
                  <h4>Visitors</h4>
                </div>
                <div class="card-body">
                  <div id="visitorMap"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>This Week Stats</h4>
                  <div class="card-header-action">
                    <div class="dropdown">
                      <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">Filter</a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> Electronic</a>
                        <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> T-shirt</a>
                        <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> Hat</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View All</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="summary">
                    <div class="summary-info">
                      <h4>$1,053</h4>
                      <div class="text-muted">Sold 3 items on 2 customers</div>
                      <div class="d-block mt-2">                              
                        <a href="#">View All</a>
                      </div>
                    </div>
                    <div class="summary-item">
                      <h6>Item List <span class="text-muted">(3 Items)</span></h6>
                      <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                          <a href="#">
                            <img class="mr-3 rounded" width="50" src="assets/img/products/product-1-50.png" alt="product">
                          </a>
                          <div class="media-body">
                            <div class="media-right">$405</div>
                            <div class="media-title"><a href="#">PlayStation 9</a></div>
                            <div class="text-muted text-small">by <a href="#">Hasan Basri</a> <div class="bullet"></div> Sunday</div>
                          </div>
                        </li>
                        <li class="media">
                          <a href="#">
                            <img class="mr-3 rounded" width="50" src="assets/img/products/product-2-50.png" alt="product">
                          </a>
                          <div class="media-body">
                            <div class="media-right">$499</div>
                            <div class="media-title"><a href="#">RocketZ</a></div>
                            <div class="text-muted text-small">by <a href="#">Hasan Basri</a> <div class="bullet"></div> Sunday
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <a href="#">
                          <img class="mr-3 rounded" width="50" src="assets/img/products/product-3-50.png" alt="product">
                        </a>
                        <div class="media-body">
                          <div class="media-right">$149</div>
                          <div class="media-title"><a href="#">Xiaomay Readme 4.0</a></div>
                          <div class="text-muted text-small">by <a href="#">Kusnaedi</a> <div class="bullet"></div> Tuesday
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="d-inline">Tasks</h4>
              <div class="card-header-action">
                <a href="#" class="btn btn-primary">View All</a>
              </div>
            </div>
            <div class="card-body">             
              <ul class="list-unstyled list-unstyled-border">
                <li class="media">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cbx-1">
                    <label class="custom-control-label" for="cbx-1"></label>
                  </div>
                  <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
                  <div class="media-body">
                    <div class="badge badge-pill badge-danger mb-1 float-right">Not Finished</div>
                    <h6 class="media-title"><a href="#">Redesign header</a></h6>
                    <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div> <span class="text-primary">Now</span></div>
                  </div>
                </li>
                <li class="media">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cbx-2" checked="">
                    <label class="custom-control-label" for="cbx-2"></label>
                  </div>
                  <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png" alt="avatar">
                  <div class="media-body">
                    <div class="badge badge-pill badge-primary mb-1 float-right">Completed</div>
                    <h6 class="media-title"><a href="#">Add a new component</a></h6>
                    <div class="text-small text-muted">Serj Tankian <div class="bullet"></div> 4 Min</div>
                  </div>
                </li>
                <li class="media">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cbx-3" >
                    <label class="custom-control-label" for="cbx-3"></label>
                  </div>
                  <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                  <div class="media-body">
                    <div class="badge badge-pill badge-warning mb-1 float-right">Progress</div>
                    <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                    <div class="text-small text-muted">Ujang Maman <div class="bullet"></div> 8 Min</div>
                  </div>
                </li>
                <li class="media">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cbx-4">
                    <label class="custom-control-label" for="cbx-4"></label>
                  </div>
                  <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
                  <div class="media-body">
                    <div class="badge badge-pill badge-danger mb-1 float-right">Not Finished</div>
                    <h6 class="media-title"><a href="#">Remove unwanted classes</a></h6>
                    <div class="text-small text-muted">Farhan A Mujib <div class="bullet"></div> 21 Min</div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5 col-md-12 col-12 col-sm-12">
          <form method="post" class="needs-validation" novalidate="">
            <div class="card">
              <div class="card-header">
                <h4>Quick Draft</h4>
              </div>
              <div class="card-body pb-0">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" required>
                  <div class="invalid-feedback">
                    Please fill in the title
                  </div>
                </div>
                <div class="form-group">
                  <label>Content</label>
                  <textarea class="summernote-simple"></textarea>
                </div>
              </div>
              <div class="card-footer pt-0">
                <button class="btn btn-primary">Save Draft</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-7 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Latest Posts</h4>
              <div class="card-header-action">
                <a href="#" class="btn btn-primary">View All</a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>                         
                    <tr>
                      <td>
                        Introduction Laravel 5
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Laravel 5 Tutorial - Installation
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Laravel 5 Tutorial - MVC
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Laravel 5 Tutorial - Migration
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Laravel 5 Tutorial - Deploy
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Laravel 5 Tutorial - Closing
                        <div class="table-links">
                          in <a href="#">Web Development</a>
                          <div class="bullet"></div>
                          <a href="#">View</a>
                        </div>
                      </td>
                      <td>
                        <a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
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
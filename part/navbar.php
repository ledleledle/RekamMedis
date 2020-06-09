<?php

$sessionid = $_SESSION['id_pegawai'];

if (!isset($sessionid)) {
  header('location:auth');
}
$nama = mysqli_query($conn, "SELECT * FROM pegawai WHERE id=$sessionid");
$output = mysqli_fetch_array($nama);
$job = $output['pekerjaan'];
?>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifikasi
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-icon bg-primary text-white">
              <i class="fas fa-code"></i>
            </div>
            <div class="dropdown-item-desc">
              Template update is available now!
              <div class="time text-primary">2 Min Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item">
            <div class="dropdown-item-icon bg-info text-white">
              <i class="far fa-user"></i>
            </div>
            <div class="dropdown-item-desc">
              <b>You</b> and <b>Dedik Sugiharto</b> are now friends
              <div class="time">10 Hours Ago</div>
            </div>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          -
        </div>
      </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="<?php echo $output['foto']; ?>" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block"><?php if($sessionid == '1'){ echo "Dokter ";} elseif($sessionid == '3'){ echo "Admin ";} echo "<b>".ucwords($output['nama_pegawai'])."</b>"; ?></div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title"><i class="fas fa-circle text-success"></i>
          <?php
          if ($job == "1") {
            echo "Dokter";
          } else {
            echo "Apoteker";
          }
          ?>
        </div>
        <a href="profile.php" class="dropdown-item has-icon">
          <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" data-target="#ModalLogout" data-toggle="modal" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" id="ModalLogout">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda Yakin Ingin Logout?</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="window.location.href = 'auth/logout.php';" class="btn btn-danger">Ya</button>
      </div>
    </div>
  </div>
</div>
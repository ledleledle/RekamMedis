<?php 
$judul = "aplikasi rekam medis";
$pecahjudul = explode(" ", $judul);
$acronym = "";

foreach ($pecahjudul as $w) {
  $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link" href="index.php"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Menu</li>
      <li><a class="nav-link" href="blank.html"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a></li>
      <li><a class="nav-link" href="blank.html"><i class="fas fa-skull"></i> <span>Foto Rotgen Pasien</span></a></li>
      <li><a href="pegawai.php" class="nav-link"><i class="fas fa-users"></i> <span>Data Pegawai</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bed"></i> <span>Rawat Inap</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Tambah Ruangan</a></li>
          <li><a class="nav-link" href="layout-default.html">Status Ruangan</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Riwayat Rawat Inap</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-briefcase-medical"></i> <span>Obat</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Tambah Ruangan</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Riwayat Rawat Inap</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
      </aside>
    </div>
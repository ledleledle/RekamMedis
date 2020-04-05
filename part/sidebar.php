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
      <li><a class="nav-link" href="blank.html"><i class="fas fa-stethoscope"></i> <span>Rawat Jalan</span></a></li>
      <li <?php echo ($page == "Data Pasien" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a></li>
      <!-- <li><a class="nav-link" href="blank.html"><i class="fas fa-skull"></i> <span>Foto Rotgen Pasien</span></a></li> -->
      <li <?php echo ($page == "Data Pegawai") ? "class=active" : ""; ?>><a href="pegawai.php" class="nav-link"><i class="fas fa-users"></i> <span>Data Pegawai</span></a></li>
      <li class="dropdown <?php echo ($page1 == "ruang") ? "active" : ""; ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bed"></i> <span>Rawat Inap</span></a>
        <ul class="dropdown-menu">
          <li <?php echo (@$page1 == "ruang") ? "class=active" : ""; ?>><a class="nav-link" href="ruangan.php">Detail Ruangan</a></li>
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
  </aside>
</div>
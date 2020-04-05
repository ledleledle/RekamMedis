<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "404 Halaman tidak ditemukan";
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
          <div class="container mt-5">
            <div class="page-error">
              <div class="page-inner">
                <h1>404</h1>
                <div class="page-description">
                  Halaman yang anda minta tidak ditemukan
                </div>
                <div class="mt-3">
                  <a href="index.php">Kembali ke Dashboard</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
</body>
<?php include "part/all-js.php"; ?>

</html>
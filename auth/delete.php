  <script src="../assets/modules/sweetalert/sweet2.js"></script>
  <link rel="stylesheet" href="../assets/modules/sweetalert/sweet2.css">

  <?php
    include 'connect.php';

    $tipe = $_GET['type'];
    $id = $_GET['id'];

    $sql = mysqli_query($conn, "DELETE FROM $tipe WHERE id='$id'");
    ?>
  <script>
      setTimeout(function() {
          swal({
              title: "Sukses",
              text: "Hapus data berhasil!",
              type: "success"
          }, function() {
              <?php
                if ($tipe == "pegawai") {
                    echo 'window.location.href="../pegawai.php";';
                } elseif ($tipe == "ruang_inap") {
                    echo 'window.location.href="../ruangan.php";';
                }
                ?>
          });
      }, 1000);
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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
            window.history.back(-1);
        });
    }, 1000);
    </script>
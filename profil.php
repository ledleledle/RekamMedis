<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $id = "2133";
  $page = "Profil Pegawai";
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
            <h1>Profil Pegawai</h1>
          </div>

          <div class="card-body">

            <div class="section-body">
              <h2 class="section-title">Dokter Ujang</h2>
              <p class="section-lead">
                Spesialisasi : Gigi
              </p>

              <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                      <img alt="image" src="assets/img/profile/default.png" class="rounded-circle profile-widget-picture">
                      <form method="POST" enctype="multipart/form-data">
                        <label for="upload_image" class="btn btn-primary" title="Ubah Foto Profil" data-toggle="tooltip">
                          <span class="fas fa-camera" aria-hidden="true"></span>
                          <input type="file" name="upload_image" id="upload_image" accept="image/*" style="display:none">
                        </label>
                      </form>
                    </div>
                    <div class="profile-widget-description">
                      <div class="profile-widget-name">Ujang Maman <div class="text-muted d-inline font-weight-normal">
                          <div class="slash"></div> Web Developer
                        </div>
                      </div>
                      Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                  <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                      <div class="card-header">
                        <h4>Edit Profil</h4>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" required="">
                            <div class="invalid-feedback">
                              Please fill in the first name
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Username</label>
                            <input type="text" class="form-control" readonly disabled>
                            <div class="invalid-feedback">
                              Please fill in the last name
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-5 col-12">
                            <label>Pekerjaan</label>
                            <input type="email" class="form-control" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                          <div class="form-group col-md-7 col-12">
                            <label>Bidang keahlian (Spesialisasi)</label>
                            <input type="tel" class="form-control" value="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Alamat</label>
                            <textarea class="form-control summernote-simple"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer text-right">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Crop &amp; Upload Gambar</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 text-center">
                  <div id="image_demo"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success crop_image">Selesai</button>
            </div>
          </div>
        </div>
      </div>

      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
    $(document).ready(function() {
      $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width: 370,
          height: 370,
          type: 'square' //circle
        },
        boundary: {
          width: 400,
          height: 400
        }
      });

      $('#upload_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function() {
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
      });

      $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response) {
          $.ajax({
            url: "upload.php",
            type: "POST",
            data: {
              "image": response,
              "user" : "<?php echo $id; ?>"
            },
            success: function(data) {
              $('#uploadimageModal').modal('hide');
              setTimeout(function() {
                swal({
                  title: "Antrian Berhasil Di Reset!",
                  text: "Antrian Pasien Berhasil Di Reset",
                  icon: "success"
                });
              }, 500);
            }
          });
        })
      });
    });
  </script>
</body>

</html>
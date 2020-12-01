<?php
if (!$this->session->userdata('username')) {

  redirect('auth');
} else {
  if ($this->session->userdata("role") === "karyawan") {
    redirect("karyawan/homeKaryawan");
  }
?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">

    <div class="card">
      <div class="card-header" style="background-color: mintcream">
        <h3 class="text-dark">DASHBOARD</h3>
      </div>
      <div class="card-body">

        <div class="container-fluid">

          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Jumblah Karyawan</h5>
                  <p class="card-text"></p>
                  <a href="#" class="btn btn-info"><?= $jumblahKaryawan ?></a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Jumblah Divisi</h5>
                  <p class="card-text"></p>
                  <a href="#" class="btn btn-info"><?= $jumblahDivisi ?></a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Jumblah Admin</h5>
                  <p class="card-text"></p>
                  <a href="#" class="btn btn-info"><?= $jumblahAdmin ?></a>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="jumbotron bg-white">
            <h1 class="display-4">Hello, <?= $this->session->userdata('nama') ?>!</h1>
            <p class="lead">Selamat datang di aplikasi penggajian dan absen.</p>
            <hr class="my-4">
            <p></p>
            <a class="btn btn-primary btn-lg" href="<?php echo base_url('Absen/sudahAbsen') ?>" role="button">Lihat Absen</a>
          </div>

        </div>

      </div>
    </div>

  </div>
  <!---Container Fluid-->
  </div>


  <script>

  </script>

<?php } ?>
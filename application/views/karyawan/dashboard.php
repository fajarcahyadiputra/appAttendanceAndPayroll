<?php 
if (!$this->session->userdata('username')) {
  redirect('auth');
} else {

  ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">

    <div class="card">
      <div class="card-header" style="background-color: mintcream">
        <h3 class="text-dark">DASHBOARD</h3>
      </div>
      <div class="card-body" style="height: 300px">
        
      <div class="container-fluid">
        
        <h4>Selamat Datang, <span><?php echo $this->session->userdata('nama') ?></span></h4>

      </div>

    </div>
  </div>

</div>
<!---Container Fluid-->
</div>

<?php } ?>
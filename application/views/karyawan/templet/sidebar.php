<?php 
	$this->load->helper('url');
  if($this->uri->segment(2,0) === 0){
    $url=$this->uri->segment(1);
  }else{
    $url=$this->uri->segment(2);
  }

?>
<div id="wrapper">
  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: skyblue;" href="<?php echo base_url('Home') ?>">
     <div class="sidebar-brand-text mx-2 ">PT.KARUNIA INDAMED MANDIRI</div>
   </a>
   <li class="nav-item p-2" style="font-size: 15px">
    <center><b>Inventory</b></center>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item <?php echo $url === 'homeKaryawan'?'active':'' ?>">
    <a class="nav-link" href="<?php echo base_url('Karyawan/homeKaryawan') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item <?php echo $url === 'absen'?'active':'' ?>">
      <a class="nav-link" href="<?php echo base_url('Karyawan/absen') ?>">
        <i class="fas fa-users"></i>
        <span>Absen</span></a>
      </li>

      <hr class="sidebar-divider">

     <li class="nav-item <?php echo $url === 'profilKaryawan'?'active':'' ?>">
      <a class="nav-link" href="<?php echo base_url('Karyawan/profilKaryawan') ?>">
        <i class="fas fa-users"></i>
        <span>Profil</span></a>
      </li>

      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav style="background-color: skyblue;" class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/ruangAdmin/') ?>img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $this->session->userdata('username') ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('Karyawan/logout') ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

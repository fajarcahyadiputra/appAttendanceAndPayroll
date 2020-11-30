<?php 
if (!$this->session->userdata('username')) {
	redirect('auth');
} else {
	if ($this->session->userdata("role") === "karyawan") {
		redirect("karyawan/homeKaryawan");
	  } 
	?>

	<div class="container-fluid" id="container-wrapper">
	<style>
   .kotak-atas{
    border: 1px solid black;
    margin-bottom: 10px;
    padding-top: 10px;
    text-align: center
  }
  .kotak-dataDiri{
    text-align: center;
    font-weight: lighter;
    border: 1px solid black;
	margin-bottom: 10px;
  }
  .kotak-bawah{
    text-align: right;
    font-weight: lighter;
    margin-top: 50px;
    margin-right: 20px;
  }
</style>

<div class="kotak-atas">
 <h5>
  LAPORAN SLIP GAJI MAKAN KARYAWAN
</h5>
</div>

<div class="kotak-dataDiri">
  <div class="row">
	  <div class="col-md-6">
	  	<table cellpadding="7" cellspacing="0" style="width: 90%; text-align:left">
		  <tr>
			<th >Nama Perusahaan</th>
			<td>:</td>
			<td style="text-align: left">PT.unknow</td>
		</tr>
		<tr>
			<th >Tanggal</th>
			<td>:</td>
			<td style="text-align: left"><?= date('Y-m-d') ?></td>
		</tr>
		<tr>
			<th >Divisi</th>
			<td>:</td>
			<td style="text-align: left"><?= $dataKaryawan->nama_divisi ?></td>
		</tr>
		</table>
	  </div>
	  <div class="col-md-6">
	  <table cellpadding="7" cellspacing="0" style="width: 90%; text-align:left">
		  <tr>
			<th  >Nama</th>
			<td>:</td>
			<td style="text-align: left"><?= $dataKaryawan->nama ?></td>
		</tr>
		<tr>
			<th >NIK</th>
			<td>:</td>
			<td style="text-align: left"><?= $dataKaryawan->nik ?></td>
		</tr>
		<tr>
			<th >Jenis Kelamin</th>
			<td>:</td>
			<td style="text-align: left"><?= $dataKaryawan->jenis_kelamin ?></td>
		</tr>
		</table>
	  </div>
  </div>
</div>                                                                                                                                                                                                                  

<table border="1" cellpadding="7" cellspacing="0" style="width: 100%">
 <thead>
  <tr>
    <th width="3%">No</th>
    <th  class="text-center">Gaji Makan</th>
    <th class="text-center">Total Masuk</th>
    <th class="text-center">Total Gaji</th>
  </tr>
</thead>
<tbody>
 <tr>
   <td style="text-align: center">1</td>
   <td style="text-align: center"><?= number_format($gajiMakanPerHari,0,',','.') ?></td>
   <td style="text-align: center"><?= $totalMasuk ?></td>
   <td style="text-align: center"><?=number_format( $totalGajiMakan,0,',','.') ?></td>
 </tr>
</tbody>
</table>

<div class="kotak-bawah">
  Kota Bekasi <br><br>
  Dibuat oleh, (<?php echo $this->session->userdata('username') ?>)
</div>
	</div>

<script>
	window.print();
</script>

<?php } ?>
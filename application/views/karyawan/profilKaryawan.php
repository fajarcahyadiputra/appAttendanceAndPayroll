<?php 
if (!$this->session->userdata('username')) {
	redirect('auth');
} else {
	?>

	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5" >
			<div class="card-header" style="background-color: mintcream">
				<div class="row">
					<div class="col-sm-6">
						<h3>PROFIL KARYAWAN</h3>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
						<label>Username</label>
						<input readonly type="text"  class="form-control" value="<?= $karyawan->username ?>">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input readonly type="text"  class="form-control" value="<?= $karyawan->nama ?>">
					</div>
					<div class="form-group">
						<label>NIK</label>
						<input readonly type="text" class="form-control" value="<?= $karyawan->nik ?>">
					</div>
					<div class="form-group">
						<label>Nama Divisi</label>
						<input readonly type="text" class="form-control" value="<?= $karyawan->nama_divisi ?>">
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input readonly type="text" class="form-control" value="<?= $karyawan->no_hp ?>" >
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<input readonly type="text" class="form-control" value="<?= $karyawan->jenis_kelamin ?>" >
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" readonly  rows="3"><?php echo $karyawan->alamat ?></textarea>
					</div>
		   </div>
	</div>
</div>


<script>
	
</script>

<?php } ?>
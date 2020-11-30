<?php 
if (!$this->session->userdata('username')) {
	redirect('auth');
} else {
	if ($this->session->userdata("role") === "karyawan") {
		redirect("karyawan/homeKaryawan");
	  } 
	?>

	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5" >
			<div class="card-header" style="background-color:mintcream">
				<div class="row">
					<div class="col-sm-6">
						<h3>PENGGAJIAN</h3>
					</div>
					<div class="col-sm-6 text-right">
						<!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalTambah">
							Uang Makan
						</button>
						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalTambah">
							Gajian Bulanan
						</button> -->
					</div>
				</div>
			</div>
			<div class="card-body">
			<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tableKaryawan" style="width: 100%">
						<thead>	
							<tr>
								<th width="5%">No</th>
								<th width="8%">Nama</th>
								<th width="10%">NIK</th>
								<th width="7%">Divisi</th>
								<th width="10%">No HP</th>
								<th width="20%">Alamat</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($karyawan as $key => $dt): 
							// $divisi 	 = $this->db->get_where('tb_users', ['id' => $dt->id_user])->row();
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $dt->nama ?></td>
								<td><?php echo $dt->nik ?></td>
								<td><?php echo $dt->nama_divisi ?></td>
								<td><?php echo $dt->no_hp ?></td>
								<td style="word-break: break-all;"><?php echo $dt->alamat ?></td>
								<td>
									<div class="d-flex justify-content-center">
										<a target="_blank" class="btn btn-info btn-sm" href="<?= base_url('Penggajian/gajiMakan/'.$dt->id) ?>">Makan</a>
										<a target="_blank" class="btn btn-danger btn-sm ml-2" href="<?= base_url('Penggajian/gajiBulanan/'.$dt->id) ?>">Bulanan</i></a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			</div>
	</div>
</div>




<!-- modal edit stok -->
<div class="modal fade" id="modalEditStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Edit Stok</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_editstok">
				
			</form>
		</div>
	</div>
</div>
<!-- end -->




<script>
	$(document).ready(function(){
		let table = $('#tableKaryawan').DataTable({
		"paging": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		async: true
	})

	})
</script>

<?php } ?>
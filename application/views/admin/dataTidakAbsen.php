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
					<div class="col-sm-8">
						<h3>Data Karyawan Yang Tidak Absen Hari Ini</h3>
					</div>
					<div class="col-sm-4 text-right">

					</div>
				</div>
			</div>
			<div class="card-body">

				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tableAbsen" style="width: 100%">
						<thead>	
							<tr>
                                <th>NO</th>
                                <th>Nama Karyawan</th>
                                <th>NIK</th>
                                <th>Nama Divisi</th>
                                <th>Jenis Kelamin</th>
                                <th>NO HP</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($absen as $key => $dt): 
							// $divisi 	 = $this->db->get_where('tb_users', ['id' => $dt->id_user])->row();
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $dt->nama ?></td>
								<td><?php echo $dt->nik ?></td>
								<td><?php echo $dt->nama_divisi ?></td>
								<td><?php echo $dt->jenis_kelamin ?></td>
								<td><?php echo $dt->no_hp ?></td>
								<td>
									<div class="d-flex justify-content-center">
										<button data-id="<?php echo $dt->id ?>" id="tombolAlpha" type="button" class="btn btn-success btn-sm ml-2 text-white" >Aplha</button>
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



<script>
	$(document).ready(function(){

		let table = $('#tableAbsen').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			async: true
		})

		//ajax untuk tombol alha
		$(document).on('click', '#tombolAlpha', function(){
			const id = $(this).data('id');
			Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Ingin Mengubah Karyawan ini!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Ubah!'
			}).then((result) => {
				if (result.value) {

			$.ajax({
				url: base_url + 'Absen/aksiKaryawanAlpha',
				data: {id: id},
				type: "POST",
				dataType: "JSON",
				success: function(result){
					setTimeout(function(){
						location.reload();
					},800);
					if(result.tambah == true){
						Swal.fire(
							'Terhapus',
							'Data Berhasil Di hapus',
							'success'
							)
					}else{
						Swal.fire(
							'Oops!',
							'Data gagal Di Hapus.',
							'error'
							)
					}
				}
			})
		}

	})

})


	})
</script>

<?php } ?>


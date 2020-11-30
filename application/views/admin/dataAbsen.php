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
						<h3>Data Karyawan Yang Sudah Absen Hari Ini</h3>
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
                                <th>Nama Divisi</th>
                                <th>Status</th>
                                <th>Minggu Ke</th>
                                <th>Acc?</th>
                                <th>Keterangan</th>
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
                                <td><?php echo $dt->nama_divisi ?></td>
                                <td><span style="background-color: yellow; border-radius: 20px; padding: 6px"><?php echo $dt->status ?></span></td>
                                <td><?php echo $dt->minggu_ke ?></td>
                                <td><span style="background-color: yellow; border-radius: 20px; padding: 6px"><?php echo $dt->acc ?></span></td>
                                <td style=""><?php echo $dt->keterangan ?></td>
								<td>
									<div class="d-flex justify-content-center">
                                <?php if($dt->acc === 'tunggu'){ ?>
                                    <button data-id="<?php echo $dt->id ?>" id="btnAcc" type="button" class="btn btn-success btn-sm ml-2 text-white" >Accept</button>
                                    <button data-id="<?php echo $dt->id ?>" id="btnAcc" type="button" class="btn btn-warning btn-sm ml-2 text-white" >No</button>
                                <?php } ?>
										<button data-id="<?php echo $dt->id ?>" id="btnEdit" type="button" class="btn btn-primary btn-sm ml-2 text-white" >Edit</button>
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


<!-- modal edit data -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_edit">
				
			</form>
		</div>
	</div>
</div>
<!-- end -->


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

        $(document).on('click','#btnAcc', function(){
            const id = $(this).data('id');

            Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Ingin Accept Karyawan ini!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Acc!'
			}).then((result) => {
				if (result.value) {

            $.ajax({
                url: base_url + 'Absen/accAbsen',
                data: {id:id},
                dataType: "JSON",
                type: "GET",
                success: function(result){
                    setTimeout(function(){
						location.reload();
					},800);
					if(result.acc == true){
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


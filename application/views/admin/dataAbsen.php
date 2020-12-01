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
                                <th>Nama Karyawan</th>
                                <th>Nama Divisi</th>
                                <th>Status</th>
	  							<th>Jam Masuk</th>
                                <th>Jam Keluar</th>
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
								<td><?php echo $dt->nama ?></td>
                                <td><?php echo $dt->nama_divisi ?></td>
                                <td><span style="background-color: yellow; border-radius: 20px; padding: 6px"><?php echo $dt->status ?></span></td>
								<td><?= $dt->jam_masuk ?></td>
                                <td><?php echo $dt->jam_keluar ?></td>
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
							'Ter Accept',
							'Data Berhasil Di Accept',
							'success'
							)
					}else{
						Swal.fire(
							'Oops!',
							'Data gagal Di Accept.',
							'error'
							)
					}
                }
            })
            }
         })
        })

		$(document).on('click', '#btnEdit', function(){
			const id = $(this).data('id');

			$.ajax({
				url: base_url + "Absen/editData",
				type: "POST",
				data: {id:id, getData: true},
				dataType: "JSON",
				success: function(result){
					$('#form_edit').html(`<div class="modal-body">
				   <div class="form-group">
						<label>Acc</label>
						<select name="acc" id="acc" class="form-control">
							<option ${result.acc == 'ya'?'selected':''} value="ya">Ya</option>
							<option ${result.acc == 'tidak'?'selected':''} value="tidak">Tidak</option>
							<option ${result.acc == 'tunggu'?'selected':''} value="tunggu">Tunggu</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" id="status" class="form-control">
							<option ${result.status == 'masuk'?'selected':''} value="masuk">Masuk</option>
							<option ${result.status == 'ijin'?'selected':''} value="ijin">Ijin</option>
							<option ${result.status == 'alpha'?'selected':''} value="alpha">Alpha</option>
							<option ${result.status == 'sakit'?'selected':''} value="sakit">Sakit</option>
						</select>
					</div>
					<div class="form-group">
						<label>Minggu Ke</label>
						<input required="" type="number" name="minggu_ke" class="form-control" value="${result.minggu_ke}">
						<input required="" type="hidden" name="id" class="form-control" value="${result.id}">
					</div>
					<div class="form-group">
						<label>Tanggal</label>
						<input required="" type="date" name="tanggal" class="form-control" value="${result.tanggal}">
					</div>
					<div class="form-group">
						<label>Jam Masuk</label>
						<input  type="time" name="jam_masuk" class="form-control" value="${result.jam_masuk}">
					</div>
					<div class="form-group">
						<label>Jam Keluar</label>
						<input  type="time" name="jam_keluar" class="form-control" value="${result.jam_keluar}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>`);
				$('#modalEdit').modal('show')
				}
			})
		})

		$(document).on('submit','#form_edit', function(e){
			e.preventDefault();
			const data = $(this).serialize();

			$.ajax({
				url: base_url + "Absen/editData",
				type: "POST",
				data: data,
				dataType: "JSON",
				success: function(result){

					setTimeout(function(){
						location.reload();
					},800);
					if(result.edit == true){
						Swal.fire(
							'Sukses',
							'Data Berhasil Di Edit',
							'success'
							)
					}else{
						Swal.fire(
							'Oops!',
							'Data gagal Di Edit.',
							'error'
							)
					}
				}
			})
		})


	})
</script>

<?php } ?>


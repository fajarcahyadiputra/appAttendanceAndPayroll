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
						<h3>DATA GAJI</h3>
					</div>
					<div class="col-sm-6 text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
							Tambah
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">

				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tableGaji" style="width: 100%">
						<thead>	
							<tr>
								<th>No</th>
								<th>Nama Divisi</th>
								<th>Gaji Pokok</th>
								<th>Gaji Makan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach($gaji as $dt): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $dt->nama_divisi ?></td>
								<td><?php echo number_format($dt->gaji_pokok,0,',','.') ?></td>
								<td><?php echo number_format($dt->gaji_makan,0,',','.')  ?></td>
								<td>
								<button class="btn btn-info btn-sm" id="tombol_edit" data-id="<?php echo $dt->id ?>"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-sm ml-2" id="tombol_hapus" data-id="<?php echo $dt->id ?>"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Tambah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_tambah">
            <div class="modal-body">
					<div class="form-group">
						<label>Nama Divisi</label>
						<select name="id_divisi" id="id_divisi" class="form-control">
							<option value="" disabled selected hidden>Pilih Divisi</option>
							<?php foreach($divisi as $dv): ?>
								<option value="<?= $dv->id ?>"><?= $dv->nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Gaji Pokok</label>
						<input required="" type="number" name="gaji_pokok" class="form-control">
                    </div>
                    <div class="form-group">
						<label>Gaji Makan (*hari)</label>
						<input required="" type="number" name="gaji_makan" class="form-control">
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end -->

<!-- modal edit data -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Edit Customer</h5>
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

		let table = $('#tableGaji').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			async: true
		})

		//ajax untuk tambah data

		$('#form_tambah').on('submit',function(e){
			e.preventDefault();
			const data = $('#form_tambah').serialize();
			$.ajax({
				url: base_url+'Gaji/tambahData',
				type: 'post',
				dataType: 'json',
				data: data,
				success: function(hasil){
					$('#modalTambah').modal('hide');
					if(hasil.tambah == true){
						Swal.fire({
							icon: 'success',
							title: 'Berhasil...',
							text: 'Selamat Data Berhasil Di Tambahkan!',
						})
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Data Gagal Di Tambahkan!',
						})
					}
					setTimeout(function(){
						location.reload();
					}, 800);
				}
			})
		})

		//end

		//ajax untuk hapus data
		$(document).on('click', '#tombol_hapus', function(){
			const id = $(this).data('id');
			Swal.fire({
				title: 'Apakah kamu yakin?',
				text: "Ingin Menghapus Data ini!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
				if (result.value) {

					$.ajax({
						url: base_url+'Gaji/HapusData',
						data: {"id":id},
						type: 'get',
						dataType: 'json',
						error: function(){
                            Swal.fire(
									'Oops!',
									'Data Tidak Bisa Di hapus.',
									'error'
									)
                        },
						success: function(hasil){
							setTimeout(function(){
								location.reload();
							},800);
							if(hasil.hapus == true){
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
		//end

		// ajax tampil data
		$(document).on('click','#tombol_edit', function(){
			const id = $(this).data('id');
			$.ajax({
				url: base_url+'gaji/editData',
				data:{
                    'getData': true,
                    "id":id
                    },
				dataType: 'json',
				type: 'post',
				success: function(hasil){
					$('#form_edit').html(` <div class="modal-body">
					<div class="form-group">
						<label>Nama Divisi</label>
						<select name="id_divisi" id="id_divisi" class="form-control">
							<?php foreach($divisi as $dv): ?>
								<option ${hasil.id_divisi == <?php echo $dv->id ?>?'selected':''} value="<?= $dv->id ?>"><?= $dv->nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Gaji Pokok</label>
						<input required="" type="number" name="gaji_pokok" class="form-control" value="${hasil.gaji_pokok}">
						<input required="" type="hidden" name="id" class="form-control" value="${hasil.id}">
                    </div>
                    <div class="form-group">
						<label>Gaji Makan (*hari)</label>
						<input required="" type="number" name="gaji_makan" class="form-control" value="${hasil.gaji_makan}">
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>`);
				$('#modalEdit').modal('show');
				}
			})
		})
		//end

		//ajax untuk edit data pengguna
		$('#form_edit').on('submit', function(e){
			e.preventDefault();
			const data = $('#form_edit').serialize()+'&editData=true';
            console.log(data)
			$.ajax({
				url: base_url+'Gaji/editData',
				data: data,
				dataType: 'json',
				type:'post',
				success: function(hasil){
					$('#modalEdit').modal('hide');
					setTimeout(function(){
						location.reload();
					},800);
					if(hasil.edit == true){
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
		//end
	})
</script>

<?php } ?>
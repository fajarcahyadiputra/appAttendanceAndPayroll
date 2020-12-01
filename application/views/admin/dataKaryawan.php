<?php
if (!$this->session->userdata('username')) {
	redirect('auth');
} else {
	if ($this->session->userdata("role") === "karyawan") {
		redirect("karyawan/homeKaryawan");
	}
?>

	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5">
			<div class="card-header" style="background-color:mintcream">
				<div class="row">
					<div class="col-sm-6">
						<h3>DATA KARYAWAN</h3>
					</div>
					<div class="col-sm-6 text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
							Tambah Karyawan
						</button>
						<a href="<?php echo base_url('Karyawan/reportExcel') ?>" class="btn btn-info">
							Report Excel
						</a>
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
								<th width="8%">Jenis Kelamin</th>
								<th width="10%">No HP</th>
								<th width="10%">Status Aktif</th>
								<th width="20%">Alamat</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($karyawan as $key => $dt) :
								// $divisi 	 = $this->db->get_where('tb_users', ['id' => $dt->id_user])->row();
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $dt->nama ?></td>
									<td><?php echo $dt->nik ?></td>
									<td><?php echo $dt->nama_divisi ?></td>
									<td><?php echo $dt->jenis_kelamin ?></td>
									<td><?php echo $dt->no_hp ?></td>
									<td><?php echo $dt->status_aktif ?></td>
									<td style="word-break: break-all;"><?php echo $dt->alamat ?></td>
									<td>
										<div class="d-flex justify-content-center">
											<button class="btn btn-info btn-sm" id="tombol_edit" data-id="<?php echo $dt->id_user ?>"><i class="fa fa-edit"></i></button>
											<button class="btn btn-danger btn-sm ml-2" id="tombol_hapus" data-id="<?php echo $dt->id_user ?>"><i class="fa fa-trash"></i></button>
											<button class="btn btn-warning btn-sm ml-2" id="tombol_info" data-id="<?php echo $dt->id_user ?>"><i class="fa fa-info"></i></button>
											<button class="btn btn-success btn-sm ml-2" id="tombol_password" data-id="<?php echo $dt->id_user ?>"><i class="fas fa-key"></i></button>
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


	<!-- Modal tambah-->
	<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal Tambah Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_tambah">
					<div class="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input required="" type="text" name="username" class="form-control">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input required="" minlength="3" type="text" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input required="" type="text" name="nama" class="form-control">
						</div>
						<div class="form-group">
							<label>NIK</label>
							<input required="" type="text" name="nik" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama Divisi</label>
							<select required name="id_divisi" id="id_divisi" class="form-control">
								<option value="" disabled selected hidden>Pilih Divisi</option>
								<?php foreach ($divisi as $dv) : ?>
									<option value="<?php echo $dv->id ?>"><?= $dv->nama ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label>No HP</label>
							<input required="" type="text" name="no_hp" class="form-control">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select require name="jenis_kelamin" id="jenis_kelamin" class="form-control">
								<option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
								<option value="laki-laki">Laki-Laki</option>
								<option value="perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
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


	<!-- modal info data -->
	<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal Info</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form_info">

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- modal password data -->
	<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal Rubah Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_password">

				</form>
			</div>
		</div>
	</div>
	<!-- end -->




	<script>
		$(document).ready(function() {

			let table = $('#tableKaryawan').DataTable({
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
				async: true
			})

			//ajax untuk tambah data

			$('#form_tambah').on('submit', function(e) {
				e.preventDefault();
				const data = $('#form_tambah').serialize();
				$.ajax({
					url: base_url + 'Karyawan/tambahKaryawan',
					type: 'post',
					dataType: 'json',
					data: data,
					success: function(hasil) {
						$('#modalTambah').modal('hide');
						if (hasil.tambah == true) {
							Swal.fire({
								icon: 'success',
								title: 'Berhasil...',
								text: 'Selamat Data Berhasil Di Tambahkan!',
							})
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Data Gagal Di Tambahkan!',
							})
						}
						setTimeout(function() {
							location.reload();
						}, 800);
					}
				})
			})

			//end

			//ajax untuk hapus data
			$('#tableKaryawan').on('click', '#tombol_hapus', function() {
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
							url: base_url + 'Karyawan/HapusData',
							data: {
								"id": id
							},
							type: 'get',
							dataType: 'json',
							error: function() {
								Swal.fire(
									'Oops!',
									'Barang Ada Di Data Table Keluar Barang.',
									'error'
								)
							},
							success: function(hasil) {
								setTimeout(function() {
									location.reload();
								}, 800);
								if (hasil.hapus == true) {
									Swal.fire(
										'Terhapus',
										'Data Berhasil Di hapus',
										'success'
									)
								} else {
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

			//ajax tampil data pengguna
			$('#tableKaryawan').on('click', '#tombol_edit', function() {
				const id = $(this).data('id');
				$.ajax({
					url: base_url + 'Karyawan/tampilDataKaryawan',
					data: {
						"id": id
					},
					dataType: 'json',
					type: 'post',
					success: function(hasil) {
						$('#form_edit').html(`<div class="modal-body">
				    <div class="form-group">
						<label>Username</label>
						<input  type="hidden" name="id_user" value="${hasil.id_user}">
						<input required="" type="text" name="username" class="form-control" value="${hasil.username}">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input required="" type="text" name="nama" class="form-control" value="${hasil.nama}">
					</div>
					<div class="form-group">
						<label>NIK</label>
						<input required="" type="text" name="nik" class="form-control" value="${hasil.nik}">
					</div>
					<div class="form-group">
						<label>Nama Divisi</label>
						<select required name="id_divisi" id="id_divisi" class="form-control">
							<option value="" disabled selected hidden>Pilih Divisi</option>
							<?php foreach ($divisi as $dv) : ?>
								<option  ${hasil.id_divisi == <?= $dv->id ?>?'selected':''} value="<?php echo $dv->id ?>"><?= $dv->nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input required="" type="text" name="no_hp" class="form-control" value="${hasil.no_hp}">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select require name="jenis_kelamin" id="jenis_kelamin" class="form-control">
							<option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
							<option ${hasil.jenis_kelamin == 'laki-laki'?'selected':''} value="laki-laki">Laki-Laki</option>
							<option  ${hasil.jenis_kelamin == 'perempuan'?'selected':''} value="perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status Aktif</label>
						<select require name="status_aktif" id="status_aktif" class="form-control">
							<option value="" disabled selected hidden>Pilih Status Aktif</option>
							<option ${hasil.status_aktif == 'ya'?'selected':''} value="ya">Ya</option>
							<option  ${hasil.status_aktif == 'no'?'selected':''} value="no">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat" id="alamat"  rows="3">${hasil.alamat}</textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>`)
						$('#modalEdit').modal('show');
					}
				})
			})
			//end

			//ajax untuk edit data pengguna
			$('#form_edit').on('submit', function(e) {
				e.preventDefault();
				const data = $('#form_edit').serialize();
				$.ajax({
					url: base_url + 'Karyawan/editData',
					data: data,
					dataType: 'json',
					type: 'post',
					success: function(hasil) {
						$('#modalEdit').modal('hide');
						setTimeout(function() {
							location.reload();
						}, 800);
						if (hasil.edit == true) {
							Swal.fire(
								'Sukses',
								'Data Berhasil Di Edit',
								'success'
							)
						} else {
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

			//ajax tampil data pengguna
			$('#tableKaryawan').on('click', '#tombol_info', function() {
				const id = $(this).data('id');
				$.ajax({
					url: base_url + 'Karyawan/tampilDataKaryawan',
					data: {
						"id": id
					},
					dataType: 'json',
					type: 'post',
					success: function(hasil) {
						$('#form_info').html(`<div class="form-group">
						<label>Username</label>
						<input readonly type="text" class="form-control" value="${hasil.username}">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input readonly type="text"  class="form-control" value="${hasil.nama}">
					</div>
					<div class="form-group">
						<label>Nama Divi</label>
						<input readonly type="text"  class="form-control" value="${hasil.nama_divisi}">
					</div>
					<div class="form-group">
						<label>NIK</label>
						<input readonly type="text"  class="form-control" value="${hasil.nik}">
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input readonly type="text"  class="form-control" value="${hasil.no_hp}">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<input readonly type="text"  class="form-control" value="${hasil.jenis_kelamin}">
					</div>
					<div class="form-group">
						<label>Status Aktif</label>
						<input readonly type="text"  class="form-control" value="${hasil.status_aktif}">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea readonly class="form-control" name="alamat" id="alamat"  rows="3">${hasil.alamat}</textarea>
					</div>
				</div>`)
						$('#modalInfo').modal('show');
					}
				})
			})
			//end

			//tampil form password
			$('#tableKaryawan').on('click', '#tombol_password', function() {
				const id = $(this).data('id');
				$('#form_password').html(`<div class="modal-body">
				<div class="form-group">
					<label for="password">Password</label>
					<input required type="text" name="password" class="form-control" minlength="3">
					<input type="hidden" name="id" class="form-control" value="${id}">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Ganti</button>
			</div>`);
				$('#modalPassword').modal('show');
			})
			//end

			//ajax untuk ganti password
			$('#form_password').on('submit', function(e) {
				e.preventDefault();
				Swal.fire({
					title: 'Apakah kamu yakin?',
					text: "Ingin Meganti Password!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Hapus!'
				}).then((result) => {
					if (result.value) {
						const data = $('#form_password').serialize();
						$('#modalPassword').modal('hide');
						$.ajax({
							url: base_url + 'Karyawan/gantiPassword',
							data: data,
							type: 'get',
							dataType: 'json',
							success: function(hasil) {
								setTimeout(function() {
									location.reload();
								}, 800);
								if (hasil.ganti == true) {
									Swal.fire(
										'Di Ganti',
										'Password Berhasil Di Ganti',
										'success'
									)
								} else {
									Swal.fire(
										'Oops!',
										'Password gagal Di Ganti.',
										'error'
									)
								}
							}
						})

					}
				})
			})
			//end


		})
	</script>

<?php } ?>
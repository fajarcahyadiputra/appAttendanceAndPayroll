<title>Laporan Barang Keluar</title>
<table>
	<tr>
		<th> Tanggal</th>
		<td>:</td>
		<td><?php echo date('Y-m-d') ?></td>
	</tr>
	<tr>
		<th>Admin</th>
		<td>:</td>
		<td><?php echo $this->db->get_where('tb_users',['id' => $keluar->id_user])->row()->nama; ?></td>
	</tr>
</table>
<hr>
<table border="1" cellspacing="0" cellpadding="6" style="width: 100%">
	<thead>	
		<tr>
			<th>Nama Customer</th>
			<th >Nama Barang</th>
			<th >Jumblah</th>
			<th >tanggal Keluar</th>
			<th >Keterangan</th>
		</tr>
	</thead>
	<?php
	 $customerName = $this->db->get_where('tb_customer',['id' => $keluar->id_customer])->row()->nama;
	 ?>
	<tbody>
		<tr>
			<td width="15%"><?= $customerName ?></td>
			<td width="10%"><?php echo $this->db->get_where('tb_barang',['id' => $keluar->id_barang])->row()->nama_barang;?></td>
			<td width="5%"><?php echo $keluar->jumblah ?></td>
			<td width="15%"><?php echo $keluar->tanggal_keluar ?></td>
			<td width="55%" style="word-break: break-all;"><?php echo $keluar->keterangan ?></td>
		</tr>
	</tbody>
</table>

<div style="text-align: right; margin-top: 20px; margin-right: 50px">
	<div style="margin-bottom: 70px">
		Bekasi, <?php echo date('Y-m-d') ?>
	</div>

	<div style=""><?php echo $this->db->get_where('tb_users',['id' => $keluar->id_user])->row()->nama; ?></div>
</div>

<script>
	window.print()
</script>

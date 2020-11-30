<title><?php echo $title?></title>
<table>
	<tr>
		<th> Priode</th>
		<td>:</td>
		<td><?php echo $priode ?></td>
	</tr>
	<tr>
		<th>Admin</th>
		<td>:</td>
		<td><?php echo $this->db->get_where('tb_users',['id' => $this->session->userdata('id')])->row()->nama; ?></td>
	</tr>
</table>
<hr>

<?php 
if($role === "keluar"){
?>
<table border="1" cellspacing="0" cellpadding="6" style="width: 100%">
<thead>	
    <tr>
        <th width="5%">No</th>
        <th width="10%">Nama Barang</th>
        <th width="9%">Nama Customer</th>
        <th width="10%">Nama Pembuat</th>
        <th width="5%">Jumblah</th>
        <th width="10%">tanggal Keluar</th>
    </tr>
</thead>
    <tbody>
        <?php $no=1; foreach ($barangKeluar as $dt): 
        $user = $this->db->get_where('tb_users', ['id' => $dt->id_user])->row();
        $barangName = $this->db->get_where('tb_barang',['id' => $dt->id_barang])->row();
        $customerName = $this->db->get_where('tb_customer',['id' => $dt->id_customer])->row();
        ?>
        <tr class="text-center">
            <td><?php echo $no++ ?></td>
            <td><?php echo $barangName->nama_barang ?></td>
            <td><?php echo $customerName->nama ?></td>
            <td><?php echo $user->nama ?></td>
            <td><?php echo $dt->jumblah ?></td>
            <td><?php echo $dt->tanggal_keluar ?></td>
        </tr>
    <?php endforeach ?>
</tbody>
</table>

<div style="text-align: right; margin-top: 20px; margin-right: 50px">
	<div style="margin-bottom: 70px">
		Bekasi, <?php echo date('Y-m-d') ?>
	</div>

	<div style=""><?php echo $this->db->get_where('tb_users',['id' => $this->session->userdata('id')])->row()->nama; ?></div>
</div>

<?php }else if ($role === 'masuk'){ ?>


    <table border="1" cellspacing="0" cellpadding="6" style="width: 100%">
    <thead>	
        <tr>
            <th width="5%">No</th>
            <th width="5%">Suplier</th>
            <th width="8%">Kode Barang</th>
            <th width="13%">Nama Pembuat</th>
            <th width="10%">Nama Barang</th>
            <th width="5%">Stok</th>
            <th width="5">Status Aktif</th>
            <th width="12%">tanggal Buat</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach ($barangMasuk as $key => $dt): 
    $user 	 = $this->db->get_where('tb_users', ['id' => $dt->id_user])->row();
    $suplierName = $this->db->get_where('tb_suplier', ['id' => $dt->id_suplier])->row();
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $suplierName->nama ?></td>
        <td><?php echo $dt->kode_barang ?></td>
        <td><?php echo $user->nama ?></td>
        <td><?php echo $dt->nama_barang ?></td>
        <td><?php echo $dt->stok ?></td>
        <td><?php echo $dt->status_aktif ?></td>
        <td><?php echo $dt->tanggal_buat ?></td>
    </tr>
<?php endforeach ?>
</tbody>
</table>

<div style="text-align: right; margin-top: 20px; margin-right: 50px">
	<div style="margin-bottom: 70px">
		Bekasi, <?php echo date('Y-m-d') ?>
	</div>

	<div style=""><?php echo $this->db->get_where('tb_users',['id' => $this->session->userdata('id')])->row()->nama; ?></div>
</div>

<?php }else{
    redirect('Home');
} ?>
<?php

class M_penggajian extends CI_Model
{
	protected $table = 'tb_penggajian';
	public function getBarang($where = null)
	{
		if($where === null){
			return $this->db->get($this->table)->result();
		}else{
			return $this->db->get_where($this->table, $where)->row();
		}
	}
	public function getBarangAktif()
	{
		return $this->db->get_where($this->table,['status_aktif' => 'ya'])->result();
	}
	public function tambahData($data)
	{
		 $insert = $this->db->insert($this->table, $data);
		 $id_barang = $this->db->insert_id();
		 if($insert){
			 $data_stok = ['id_barang' => $id_barang, 'stok_sebelumnya' => $data['stok']];
			 $this->db->insert('tb_stok_penyesuaian', $data_stok);
			 return $insert;
		 }
	}
	public function hapusData($where)
	{
		$this->db->where($where);
		return $this->db->delete($this->table);
	}
	public function editData($data, $where)
	{
		$this->db->where($where);
		return $this->db->update($this->table, $data);
	}
	public function ChartBarangMasuk()
    {
		  $bulan = date('m');
		  $year  = date('Y');
		 return $data  = $this->db->select("count(*) as total, MONTH(tanggal_buat) as bulan, YEAR(tanggal_buat) as tahun")
		  ->like('MONTH(tanggal_buat)', $bulan)
		  ->or_like('YEAR(tanggal_buat)', $year)
		  ->group_by('MONTH(tanggal_buat)')
		  ->order_by('MONTH(tanggal_buat)', 'asc')
		  ->from($this->table)->get()->result();
	}
	public function reportPdf($dari ,$sampai)
	{
		$this->db->where('tanggal_buat >=', $dari);
		$this->db->where('tanggal_buat <=', $sampai);
		return $this->db->get($this->table)->result();
	}
	public function getStok()
	{
		return $this->db->select('tb_barang.nama_barang,tb_barang.id as id_barang, tb_stok_penyesuaian.*')
		->from('tb_barang')
		->join('tb_stok_penyesuaian','tb_barang.id = tb_stok_penyesuaian.id_barang')
		->get()->result();
	}
	public function editCheckStok($where_stok, $data_stok, $where_barang, $data_barang )
	{
		$this->db->where($where_stok);
		$edit =  $this->db->update('tb_stok_penyesuaian', $data_stok);
		if($edit){
			$this->db->where($where_barang);
			$this->db->update($this->table, $data_barang);
		}
		return $edit;
	}
}
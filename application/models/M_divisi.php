<?php

class M_divisi extends CI_Model
{
	protected $table = 'tb_divisi';

	public function getDivisi($where = null)
	{
		if($where === null){
			return $this->db->get($this->table)->result();
		}else{
			return $this->db->get_where($this->table, $where)->row();
		}
	}
	public function tambahData($data)
	{
		 $tambah = $this->db->insert($this->table, $data);
		 return $tambah;
	}
	public function insertToUser($data)
	{
		
	}
	public function hapusData($where)
	{
		$this->db->where($where);
		return $this->db->delete($this->table);
	}
	public function editData($data, $where)
	{
		$this->db->where($where);
		$edit = $this->db->update($this->table, $data);
		 return $edit;
	}
	public function reportPdf($dari, $sampai)
	{
		$this->db->where('tanggal_keluar >=', $dari);
		$this->db->where('tanggal_keluar <=', $sampai);
		return $this->db->get($this->table)->result();
	}
}
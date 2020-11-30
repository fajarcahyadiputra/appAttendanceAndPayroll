<?php

class M_admin extends CI_Model
{
	protected $table = 'tb_admin';
	protected $table_user = 'tb_user';

	public function getAdmin($where = null)
	{
		if($where ===  null){
			return $this->db->select('tb_user.username, tb_user.password, tb_user.level, tb_admin.*')
						  ->from('tb_admin')
						  ->join('tb_user','tb_admin.id_user = tb_user.id')
						  ->get()->result();
		  }else{
			  return $this->db->select('tb_user.username, tb_user.password, tb_user.level, tb_admin.*')
						  ->from('tb_admin')
						  ->join('tb_user','tb_admin.id_user = tb_user.id')
						  ->where('tb_admin.id_user',$where)
						  ->get()->row();
		  }
	}
	public function insertData($data)
	{
		return $this->db->insert($this->table,$data);
	}
	public function insertToUser($data)
    {
        $this->db->insert($this->table_user, $data);
        return $this->db->insert_id();
    }
	public function hapusData($where)
	{
		$this->db->where($where);
		return $this->db->delete($this->table_user);
	}
	public function editData($data, $where)
	{
		$this->db->where($where);
		return $this->db->update($this->table, $data);
	}
	public function editDataUser($data, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table_user, $data);
    }
}
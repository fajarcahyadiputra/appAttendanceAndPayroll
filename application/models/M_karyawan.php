<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends CI_Model
{
    protected $table = 'tb_karyawan';
    protected $table_user = 'tb_user';
    
	public function getKaryawan($where = null)
	{
        
        if($where ===  null){
          return $this->db->select('tb_user.username, tb_user.password, tb_divisi.nama as nama_divisi, tb_karyawan.*')
                        ->from('tb_karyawan')
                        ->join('tb_user','tb_karyawan.id_user = tb_user.id')
                        ->join('tb_divisi','tb_karyawan.id_divisi = tb_divisi.id')
                        ->get()->result();
        }else{
            return $this->db->select('tb_user.username, tb_user.password, tb_divisi.nama as nama_divisi, tb_karyawan.*')
                        ->from('tb_karyawan')
                        ->join('tb_user','tb_karyawan.id_user = tb_user.id')
                        ->join('tb_divisi','tb_karyawan.id_divisi = tb_divisi.id')
                        ->where('tb_karyawan.id_user',$where)
                        ->get()->row();
        }
    }
    public function getKaryawanId($id)
    {
        return $this->db->select('tb_user.username, tb_user.password, tb_divisi.nama as nama_divisi, tb_karyawan.*')
        ->from('tb_karyawan')
        ->join('tb_user','tb_karyawan.id_user = tb_user.id')
        ->join('tb_divisi','tb_karyawan.id_divisi = tb_divisi.id')
        ->where('tb_karyawan.id',$id)
        ->get()->row();
    }
    public function insertData($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function insertToUser($data)
    {
        $this->db->insert($this->table_user, $data);
        return $this->db->insert_id();
    }
    public function hapusData($where)
    {
        return $this->db->delete($this->table_user, $where);
    }
    public function editDataUser($data, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table_user, $data);
    }
    public function editDataKaryawan($data, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }
}
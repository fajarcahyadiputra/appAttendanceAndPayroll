<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gaji extends CI_Model {

    protected $table = 'tb_gaji';

    public function getGaji($where = null)
    {
        if($where === null){
            return $this->db->select('tb_gaji.*,tb_divisi.nama as nama_divisi')
                    ->from($this->table)
                    ->join('tb_divisi','tb_gaji.id_divisi = tb_divisi.id')
                    ->get()->result();
        }else{
            return $this->db->select('tb_gaji.*,tb_divisi.nama as nama_divisi')
            ->from($this->table)
            ->join('tb_divisi','tb_gaji.id_divisi = tb_divisi.id')
            ->where('tb_gaji.id', $where)
            ->get()->row();
        }
    }
    public function insertData($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function deleteData($where)
    {
        $this->db->where($where);
        return $this->db->delete($this->table);
    }
    public function editData($where, $data)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }
    public function getGajiDivisi($where = null)
    {
        return $this->db->select('tb_gaji.*,tb_divisi.nama as nama_divisi')
        ->from($this->table)
        ->join('tb_divisi','tb_gaji.id_divisi = tb_divisi.id')
        ->where('tb_gaji.id_divisi', $where)
        ->get()->row();
    }
}
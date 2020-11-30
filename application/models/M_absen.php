<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_absen extends CI_Model
{
    protected $table_absen = "tb_absensi";
    protected $table_karyawan = 'tb_karyawan';

    public function getAbsen($id = null)
    {
        if($id === null){
            return $this->db->select("{$this->table_absen}.*, {$this->table_karyawan}.nama")
                            ->from($this->table_absen)
                            ->join($this->table_karyawan,"{$this->table_absen}.id_karyawan = {$this->table_karyawan}.id")
                            ->get()->result();
    }else{
            return $this->db->select("{$this->table_absen}.*, {$this->table_karyawan}.nama")
                ->from($this->table_absen)
                ->join($this->table_karyawan,"{$this->table_absen}.id_karyawan = {$this->table_karyawan}.id")
                ->where("{$this->table_absen}.id", $id)
                ->get()->row();
    }
}
    public function checkAbsen($id)
    {
        $date = date('Y-m-d');
        if(count($this->db->get_where($this->table_absen, ['id_karyawan'=> $id, 'tanggal' => $date])->result()) > 0){
            $check = $this->db->select("{$this->table_absen}.*")
                    ->from($this->table_absen)
                    ->where('jam_keluar', null)
                    ->where('id_karyawan', $id)
                    ->where('tanggal', $date)
                    ->get();
            if(count($check->result()) > 0){
                return 'keluar';
            }else{
                return 'sudah';
            }
            // return $check;
        }else{
            return 'kosong';
        }
        
    }
    public function createAbsen($data)
    {
        return $this->db->insert($this->table_absen, $data);
    }
    public function absenKeluar($where, $data)
    {
        $this->db->where($where);
        return $this->db->update($this->table_absen,$data);
    }
    public function gajiMakan($id)
    {
        $mingguKe = ceil(date('d')/7);
        return $this->db->get_where($this->table_absen,['minggu_ke' => $mingguKe,'id_karyawan' => $id,'status' => 'masuk'])->result();
    }
    public function checkStatus($id)
    {
        $date = date('Y-m-d');
        if(count($this->db->get_where($this->table_absen, ['id_karyawan'=> $id, 'tanggal' => $date])->result()) > 0){
            return $check = $this->db->select("{$this->table_absen}.*")
                    ->from($this->table_absen)
                    ->where('jam_keluar', null)
                    ->where('id_karyawan', $id)
                    ->where('tanggal', $date)
                    ->get()->row();
        }else{
            return 'kosong';
        }
    }
    public function checkJam($id)
    {
        $date = date('Y-m-d');
        return $this->db->select("{$this->table_absen}.*")
                    ->from($this->table_absen)
                    ->where('id_karyawan', $id)
                    ->where('tanggal', $date)
                    ->get()->result();
    }
    public function getAbsenToday($role)
    {
        $date = date('Y-m-d');
        //untuk  tampil data karyawan yang tidak absen
        if($role === 'tidak'){
                return $this->db->select('tb_user.username, tb_user.password, tb_divisi.nama as nama_divisi, tb_karyawan.*')
                ->from('tb_karyawan')
                ->join('tb_user','tb_karyawan.id_user = tb_user.id')
                ->join('tb_divisi','tb_karyawan.id_divisi = tb_divisi.id')
                ->where('tb_karyawan.id NOT IN (select id_karyawan from tb_absensi WHERE tanggal="'.$date.'")',null,false)
                ->get()->result();
        }else{
            return $this->db->select("{$this->table_absen}.*, {$this->table_karyawan}.nama, {$this->table_karyawan}.nik, {$this->table_karyawan}.jenis_kelamin, {$this->table_karyawan}.no_hp, {$this->table_karyawan}.alamat, tb_divisi.nama as nama_divisi ")
                ->from($this->table_absen)
                ->join($this->table_karyawan,"{$this->table_absen}.id_karyawan = {$this->table_karyawan}.id")
                ->join('tb_divisi',"{$this->table_karyawan}.id_divisi = tb_divisi.id")
                ->where("{$this->table_absen}.tanggal", $date)
                ->get()->result();
        }
    }
    public function tambahData($data)
    {
        return $this->db->insert($this->table_absen, $data);
    }
    public function accAbsen($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_absen,$data);
    }
}
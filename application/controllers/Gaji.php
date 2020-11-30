<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gaji extends CI_controller {

    public function __construct()
    {
        //construct method yang di jalanain pertama
        parent:: __construct();
        $this->load->model('M_gaji','gaji');
        $this->load->model('M_divisi','divisi');
    }

    //untuk tampilkan view halamn data custtomer
    public function index()
    {
        $data = [
			'gaji'=>  $this->gaji->getGaji(),
			'divisi'=>  $this->divisi->getDivisi(),
			'title' => 'Data Gaji',
		];
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dataGaji',$data);
		$this->load->view('admin/templet/footer');
    }
    //aksi tambah customer
    public function tambahData()
    {
        $data = $this->input->post();
        $pesan = [];
        $insert = $this->gaji->insertData($data);
        if($insert){
            $pesan['tambah'] = true;
        }else{
            $pesan['tambah'] = false;
        }

        echo json_encode($pesan);
    }
    //aksi hapus customer
    public function HapusData()
    {
        $pesan = [];
        $hapus = $this->gaji->deleteData(['id' => $this->input->get('id')]);
        if($hapus){
            $pesan['hapus'] = true;
        }else{
            $pesan['hapus'] = false;
        }

        echo json_encode($pesan);
     }
     public function editData()
     {
         //aksi edit customer
         if($this->input->post('getData')){
             $data = $this->gaji->getGaji($this->input->post('id'));
             echo json_encode($data);
         }
         if($this->input->post('editData')){
             $data = $this->input->post();
             unset($data['id']);
             unset($data['editData']);
             $where = ['id' => $this->input->post('id')];
             $pesan = [];
             $edit  = $this->gaji->editData($where, $data);
             if($edit){
                 $pesan['edit'] = true;
             }else{
                 $pesan['edit'] = false;
             }

             echo json_encode($pesan);
         }
     }
}
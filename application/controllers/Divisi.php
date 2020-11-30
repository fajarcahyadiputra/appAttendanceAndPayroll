<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Divisi extends CI_Controller
{
	
	function __construct()
	{
		//construct method yang di jalanain pertama
		parent::__construct();
		$this->load->model('M_divisi','divisi');
	}
	// halaman index barang kelaur
	public function index()
	{
		$data = [
			'divisi'=> $this->divisi->getDivisi(),
			'title' => 'Data Divisi',
		];
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dataDivisi',$data);
		$this->load->view('admin/templet/footer');
	}
	public function tambahData()
	{
		$tambah = $this->divisi->tambahData($this->input->post());
		if($tambah){
			$pesan['tambah'] = true;
		}else{
			$pesan['tambah'] = false;
		}
		echo json_encode($pesan);

	}
	public function hapusData()
	{
		$where = ['id' => $this->input->post('id')];
		$hapus = $this->divisi->hapusData($where);
		$pesan = [];
		if($hapus){
			$pesan['hapus'] = true;
		}else{
			$pesan['hapus'] = false;
		}

		echo json_encode($pesan);
	}
	//untuk manampilkan data keluar
	public function tampilDataDivisi()
	{
		$where = ['id' => $this->input->post('id')];
		$data  = $this->divisi->getDivisi($where);
		echo json_encode($data);
	}
	//untuk edit data barang keluar
	public function editData()
	{
			$pesan = [];
			$where = ['id' => $this->input->post('id')];
			$edit = $this->divisi->editData($this->input->post(), $where);

			if($edit){
				$pesan['edit'] = true;
			}else{
				$pesan['edit'] = false;
			}

			echo json_encode($pesan);
		}
}
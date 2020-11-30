<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		  //construct method yang di jalanain pertama
		parent::__construct();
		$this->load->model('M_admin','admin');
	}
	//tampil halaman index
	public function index()
	{
		$data = [
			'title' => 'Data Admin',
			'admin' => $this->admin->getAdmin()
		];
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dataAdmin',$data);
		$this->load->view('admin/templet/footer');
	}
	//aksi penguna
	public function tambahData()
	{
		//insert to user
		$id_user = $this->admin->insertToUser([
		'username' => $this->input->post('username'),
		'password' => sha1($this->input->post('password')),
		'level'    => $this->input->post('level')
		]);
        $data = $this->input->post();
        unset($data['username']);
        unset($data['password']);
        unset($data['level']);
        $data['id_user'] = $id_user;
        $data['tanggal_daftar'] = date('Y-m-d');
        $data['status_aktif'] = 'ya';
        //insert to karyawan
        $insert = $this->admin->insertData($data);
        //send message
        $pesan = [];
        if($insert){
            $pesan['tambah'] = true;
        }else{
            $pesan['tambah'] = false;
        }

        echo json_encode($pesan);
	}
	//hapus pengguna
	public function HapusData()
	{
		$where = ['id' => $this->input->get('id')];
		$hapus = $this->admin->hapusData($where);
		$pesan=[];
		if($hapus){
			$pesan['hapus'] = true;
		}else{
			$pesan['hapus'] = false;
		}

		echo json_encode($pesan);
	}
	//hal view edit pengguna
	public function tampilEditAdmin()
	{
		$data = $this->admin->getAdmin($this->input->post('id'));
		echo json_encode($data);
	}
	//edit data
	public function editData()
	{
		  //edit user
		  $edit = $this->admin->editDataUser([
			'username' => $this->input->post('username'),
			'level' => $this->input->post('level'),
		   ],['id' => $this->input->post('id_user')]);
		  
		   //send message
		   $pesan = [];
		   if($edit){
			   $pesan['edit'] = true;
   
			   //aksi edit karyawan
			   $data = $this->input->post();
			   unset($data['username']);
			   unset($data['id_user']);
			   unset($data['level']);
			   $data['status_aktif'] = $this->input->post('status_aktif');
			   //edit karyawan
			   $insert = $this->admin->editData($data,['id_user' => $this->input->post('id_user')]);
		   }else{
			   $pesan['edit'] = false;
		   }
   
		   echo json_encode($pesan);
	}
	//aksi ganti password
	public function gantiPassword()
    {
        $where = ['id' => $this->input->post('id')];
        $data  = ['password' => sha1($this->input->post('password'))]; 
        $hapus = $this->admin->editDataUser($data, $where);
        $pesan = [];
        if($hapus){
            $pesan['ganti'] = true;
        }else{
            $pesan['ganti'] = false;
        }
        echo json_encode($pesan);
	}
	public function logout_admin()
	{
		//untuk logout
		$this->session->unset_userdata(['username','role','Logged_in','id','nama']);
		return redirect('Auth');
	}
}
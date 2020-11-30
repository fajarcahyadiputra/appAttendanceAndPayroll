<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	//construct method yang di jalanain pertama
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("username")) {
			if ($this->session->userdata("role") === "karyawan") {
				redirect("karyawan/homeKaryawan");
			} else {
				redirect("Home");
			}
		}

		$this->load->model('M_auth','auth');
		$this->load->model('M_admin','admin');
		$this->load->model('M_karyawan','karyawan');
	}
	//method halaman index/login
	public function index()
	{
		return $this->load->view('login');
	}
	//method proses login
	public function proses_login()
	{
		//check apakah request methodnya post
		if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
			//jika bukan post
			$this->load->view('login');
		}else{
			//jika post
			$user = strtolower(trim(htmlspecialchars($this->input->post('username'))));
			$pass = sha1($this->input->post('password'));

			$check = $this->auth->check_login($user, $pass);
			$data  = $check->row();

			if($check->num_rows() > 0){
				//untuk check role
				if($data->level === 'admin' || $data->level === 'super_admin'){
					//untuk check aktif apa gak
					$dataAdmin = $this->admin->getAdmin($data->id);
					if($dataAdmin->status_aktif === 'ya'){
						//membuat userdata 
						$userdata = [
		
							'username' => $data->username,
							'nama'     => $dataAdmin->nama,
							'id'	   => $data->id,
							'role'	   => $data->level,
							'Logged_in'=> true
						];
						//set userdata
						$this->session->set_userdata($userdata);
						redirect('Home');
					}else{
						$this->session->set_flashdata('pesan','<div class="alert alert-danger">Maaf Account Anda Sudah Tidak Aktif</div>');
						redirect('Auth');
					}
				}else if($data->level === 'karyawan'){
					$dataKaryawan = $this->karyawan->getKaryawan($data->id);
					//jalankan ini jika role admin
					if($dataKaryawan->status_aktif === 'ya'){
						$userdata = [
							'username' => $data->username,
							'id'	   => $data->id,
							'nama'	   => $dataKaryawan->nama,
							'id_karyawan' => $dataKaryawan->id,
							'role'	   => $data->level,
							'Logged_in'=> true
						];
						$this->session->set_userdata($userdata);
						redirect('Karyawan/homeKaryawan');
					}else{
						//jika bukan akan redirect ke login
						$this->session->set_flashdata('pesan','<div class="alert alert-danger">Maaf Account Anda Sudah Tidak Aktif</div>');
						redirect('Auth');
					}
				}else{
					//jika bukan akan redirect ke login
					redirect('auth');
				}
			}else{
				//jika bukan akan redirect ke login
				$this->session->set_flashdata('pesan','<div class="alert alert-danger">Maaf Password / Username Anda Salah</div>');
				redirect('Auth');
			}

		}
	}
}
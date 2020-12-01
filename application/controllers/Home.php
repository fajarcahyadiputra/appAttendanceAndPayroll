<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_karyawan', 'karyawan');
		$this->load->model('M_admin', 'admin');
		$this->load->model('M_divisi', 'divisi');
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'jumblahDivisi' => count($this->divisi->getDivisi()),
			'jumblahKaryawan' => count($this->karyawan->getKaryawan()),
			'jumblahAdmin' => count($this->admin->getAdmin())
		];
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/templet/footer');
	}
}

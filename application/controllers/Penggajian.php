<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penggajian extends CI_Controller
{
	
	function __construct()
	{
		//construct method yang di jalanain pertama
		parent::__construct();
		$this->load->model('M_penggajian','penggajian');
		$this->load->model('M_karyawan','karyawan');
		$this->load->model('M_absen','absen');
		$this->load->model('M_gaji','gaji');
	}
	public function index()
	{
		$data = [
			'title' => "Penggajain Karyawan",
			'karyawan' => $this->karyawan->getKaryawan(),
		];

		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/penggajian',$data);
		$this->load->view('admin/templet/footer');
	}
	public function gajiMakan($id)
	{
		$totalMasuk = count($this->absen->gajiMakan($id));
		$dataKaryawan = $this->karyawan->getKaryawanId($id);
		$gajiMakanPerHari = $this->gaji->getGajiDivisi($dataKaryawan->id_divisi)->gaji_makan;
		
		$totalUangMakan = $totalMasuk * $gajiMakanPerHari;

		$data = [
			'title' => 'Report Uang Makan',
			'totalMasuk' => $totalMasuk,
			'dataKaryawan' => $dataKaryawan,
			'gajiMakanPerHari' => $gajiMakanPerHari,
			'totalGajiMakan'  => $totalUangMakan,
		];

		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/printUangMakan', $data);
	}
	public function gajiBulanan($id)
	{
		$totalMasuk = count($this->absen->gajiMakan($id));
		$dataKaryawan = $this->karyawan->getKaryawanId($id);
		$gaji = $this->gaji->getGajiDivisi($dataKaryawan->id_divisi);;
		
		$totalUangMakan = $totalMasuk * $gaji->gaji_makan;

		$data = [
			'title' => 'Report Gaji Bulanan',
			'totalMasuk' => $totalMasuk,
			'dataKaryawan' => $dataKaryawan,
			'gajiMakanPerHari' => $gaji->gaji_makan,
			'totalGajiMakan'  => $totalUangMakan,
			'gajiPokok'    => $gaji->gaji_pokok
		];

		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/printGajiBulanan', $data);
	}
}
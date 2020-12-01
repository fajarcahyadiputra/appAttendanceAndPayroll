<?php
class Absen extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_absen','absen');
        $this->load->model('M_karyawan','karyawan');
    }
    public function index()
    {
        //tampil barang keluar
        $data = [
            'absen' => $this->absen->getAbsenToday('tidak'),
			'title' => 'Data Absen Karyawan',
        ];
        // var_dump($data['absen']);
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dataTidakAbsen',$data);
		$this->load->view('admin/templet/footer');
    }
    public function sudahAbsen()
    {
         //tampil barang keluar
         $data = [
            'absen' => $this->absen->getAbsenToday('ya'),
			'title' => 'Data Absen Karyawan',
        ];
        // var_dump($data['absen']);
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/dataAbsen',$data);
		$this->load->view('admin/templet/footer');
    }
    public function barangMasuk()
    {
        //barang masuk
        $data = [
			'title' => 'Report Barang Masuk',
		];
		$this->load->view('admin/templet/header', $data);
		$this->load->view('admin/templet/sidebar');
		$this->load->view('admin/reportBarangMasuk',$data);
		$this->load->view('admin/templet/footer');
    }
    public function CetakPdf()
    {
        // ini adalah script untuk mencetak pdf
        if($this->input->post('role') === 'keluar'){

            $dari   = new DateTime($this->input->post('dari'));
            $sampai = new DateTime($this->input->post('sampai'));

            $data = [
                'priode'       => $dari->format('Y/m/d') .' - '. $sampai->format('Y/m/d'),
                'barangKeluar' => $this->keluar->reportPdf($dari->format('Y-m-d'), $sampai->format('Y-m-d')),
                'role'         => 'keluar',
                'title'        => "Laporan Barang Keluar"
            ];


            $this->pdf->filename = 'LaporanBarangKeluar.pdf';
            $this->pdf->load_view('admin/cetakPdf', $data);
        }elseif($this->input->post('role') === 'masuk'){

            $dari   = new DateTime($this->input->post('dari'));
            $sampai = new DateTime($this->input->post('sampai'));

            $data = [
                'priode'       => $dari->format('Y/m/d') .' - '. $sampai->format('Y/m/d'),
                'barangMasuk' => $this->masuk->reportPdf($dari->format('Y-m-d'), $sampai->format('Y-m-d')),
                'role'         => 'masuk',
                'title'        => "Laporan Barang Masuk"
            ];


            $this->pdf->filename = 'LaporanBarangMasuk.pdf';
            $this->pdf->load_view('admin/cetakPdf', $data);

        }else{
            redirect('Home');
        }
    }
    public function aksiKaryawanAlpha()
    {
        $pesan = [];
        $data      = [
            'id_karyawan' => $this->input->post('id'),
            'tanggal'     => date('Y-m-d'),
            'minggu_ke'   => ceil(date('d')/7),
            'status'      => 'alpha',
            'acc'         => 'ya'
        ];
        $edit  = $this->absen->tambahData($data);
        if($edit){
            $pesan['tambah'] = true;
        }else{
            $pesan['tambah'] = false;
        }

        echo json_encode($pesan);
    }
    public function accAbsen()
    {
        $edit =  $this->absen->accAbsen(['acc' => 'ya'], $this->input->get('id'));
        $pesan = [];
        if($edit){
            $pesan['acc'] = true;
        }else{
            $pesan['acc'] = false;
        }

        echo json_encode($pesan);
    }
    public function editData()
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if($this->input->post('getData')){
                $data = $this->absen->getAbsen($this->input->post('id'));
                echo json_encode($data);
                die();
            }

            $data = $this->input->post();
            unset($data['id']);
            if($data['jam_masuk'] === '' ){
                unset($data['jam_masuk']);
            }

            if($data['jam_keluar'] === '' ){
                unset($data['jam_keluar']);
            }
            $edit = $this->absen->editData($data, $this->input->post('id'));
            $pesan = [];
            if($edit){
                $pesan['edit'] = true;
            }else{
                $pesan['edit'] = false;
            }
    
            echo json_encode($data);
        }
    }
}
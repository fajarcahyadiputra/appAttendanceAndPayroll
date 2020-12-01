<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        //construct method yang di jalanain pertama
        parent::__construct();
        $this->load->model('M_karyawan', 'karyawan');
        $this->load->model('M_divisi', 'divisi');
        $this->load->model('M_absen', 'absen');
    }
    // untuk menampilkan view suplier
    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => $this->karyawan->getKaryawan(),
            'divisi'   => $this->divisi->getDivisi(),
        ];

        $this->load->view('admin/templet/header', $data);
        $this->load->view('admin/templet/sidebar');
        $this->load->view('admin/dataKaryawan', $data);
        $this->load->view('admin/templet/footer');
    }
    public function reportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Nama Divisi');
        $sheet->setCellValue('E1', 'Jenis Kelamin');
        $sheet->setCellValue('F1', 'Nomer HP');

        $karyawan = $this->karyawan->getKaryawan();
        $no = 1;
        $x = 2;
        foreach ($karyawan as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nama);
            $sheet->setCellValue('C' . $x, $row->nik);
            $sheet->setCellValue('D' . $x, $row->nama_divisi);
            $sheet->setCellValue('E' . $x, $row->jenis_kelamin);
            $sheet->setCellValue('F' . $x, $row->no_hp);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-karyawan';
        $writer->save(FCPATH . 'assets/report/' . $filename . '.xlsx');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    //aksi tambah suplier
    public function tambahKaryawan()
    {
        //insert to user
        $id_user = $this->karyawan->insertToUser([
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password')),
            'level'    => 'karyawan'
        ]);
        $data = $this->input->post();
        unset($data['username']);
        unset($data['password']);
        $data['id_user'] = $id_user;
        $data['tanggal_daftar'] = date('Y-m-d');
        $data['status_aktif'] = 'ya';
        //insert to karyawan
        $insert = $this->karyawan->insertData($data);
        //send message
        $pesan = [];
        if ($insert) {
            $pesan['tambah'] = true;
        } else {
            $pesan['tambah'] = false;
        }

        echo json_encode($pesan);
    }
    //aksi hapus suplier
    public function HapusData()
    {
        $id = $this->input->get('id');
        $pesan = [];
        $hapus = $this->karyawan->hapusData(['id' => $id]);
        if ($hapus) {
            $pesan['hapus'] = true;
        } else {
            $pesan['hapus'] = false;
        }
        echo json_encode($pesan);
    }
    public function tampilDataKaryawan()
    {
        $dataKaryawan = $this->karyawan->getKaryawan($this->input->post('id'));
        echo json_encode($dataKaryawan);
    }
    //aksi edit suplier
    public function editData()
    {
        //edit user
        $edit = $this->karyawan->editDataUser([
            'username' => $this->input->post('username'),
        ], ['id' => $this->input->post('id_user')]);

        //send message
        $pesan = [];
        if ($edit) {
            $pesan['edit'] = true;

            //aksi edit karyawan
            $data = $this->input->post();
            unset($data['username']);
            $data['status_aktif'] = $this->input->post('status_aktif');
            //edit karyawan
            $insert = $this->karyawan->editDataKaryawan($data, ['id_user' => $this->input->post('id_user')]);
        } else {
            $pesan['edit'] = false;
        }

        echo json_encode($pesan);
    }
    public function gantiPassword()
    {
        $where = ['id' => $this->input->post('id')];
        $data  = ['password' => sha1($this->input->post('password'))];
        $hapus = $this->karyawan->editDataUser($data, $where);
        $pesan = [];
        if ($hapus) {
            $pesan['ganti'] = true;
        } else {
            $pesan['ganti'] = false;
        }
        echo json_encode($pesan);
    }
    public function homeKaryawan()
    {
        $data = [
            'title' => 'Data Karyawan',
        ];

        $this->load->view('karyawan/templet/header', $data);
        $this->load->view('karyawan/templet/sidebar');
        $this->load->view('karyawan/dashboard', $data);
        $this->load->view('karyawan/templet/footer');
    }
    public function absen()
    {

        $data = [
            'title' => 'Absen',
            'checkAbsen' => $this->absen->checkAbsen($this->session->userdata('id_karyawan')),
            'checkStatus' => $this->absen->checkStatus($this->session->userdata('id_karyawan')),
        ];


        $this->load->view('karyawan/templet/header', $data);
        $this->load->view('karyawan/templet/sidebar');
        if ($data['checkStatus'] === 'kosong') {
            $this->load->view('karyawan/absen', $data);
        } else if ($data['checkStatus']->status === 'alpha') {
            $this->load->view('karyawan/alpha', $data);
        } else if ($data['checkStatus']->status === 'masuk' || $data['checkStatus']->status === 'ijin' || $data['checkStatus']->status === 'sakit') {
            $this->load->view('karyawan/absen', $data);
        }
        $this->load->view('karyawan/templet/footer');
    }
    public function logout()
    {
        //untuk logout
        $this->session->unset_userdata(['username', 'role', 'Logged_in', 'id', 'nama']);
        return redirect('Auth');
    }
    public function aksiAbsen()
    {
        if ($this->input->post('masuk')) {
            if ($this->input->post('status') === 'sakit' || $this->input->post('status') === 'ijin') {
                $minggu_ke = 0;
                $jam       = null;
            } else {
                $minggu_ke = ceil(date('d') / 7);
                $jam        = date('h:i:s');
            }
            $keterangan = $this->input->post('keterangan');
            $tanggal    = date('Y-m-d');

            $data      = [
                'id_karyawan' => $this->session->userdata('id_karyawan'),
                'tanggal'     => $tanggal,
                'minggu_ke'   => $minggu_ke,
                'jam_masuk'   => $jam,
                'status'      => $this->input->post('status'),
                'keterangan'  => $keterangan,
                'acc'         => 'tunggu'
            ];

            $create = $this->absen->createAbsen($data);
            $pesan  = [];
            if ($create) {
                $pesan['create'] = true;
            } else {
                $pesan['create'] = false;
            }

            echo json_encode($pesan);
        }

        if ($this->input->post('keluar')) {
            $edit = $this->absen->absenKeluar(['tanggal' => date('Y-m-d')], ['jam_keluar' => date('h:i:s')]);
            $pesan  = [];
            if ($edit) {
                $pesan['edit'] = true;
            } else {
                $pesan['edit'] = false;
            }

            echo json_encode($pesan);
        }
    }
    public function checkJam()
    {
        $chekJam = $this->absen->checkJam($this->session->userdata('id_karyawan'));
        if (count($chekJam) === 0) {
            $minggu_ke = ceil(date('d') / 7);
            $tanggal    = date('Y-m-d');
            $data      = [
                'id_karyawan' => $this->session->userdata('id_karyawan'),
                'tanggal'     => $tanggal,
                'minggu_ke'   => $minggu_ke,
                'status'      => 'alpha',
            ];

            $this->absen->createAbsen($data);
        }

        echo json_encode(['status' => 'ok']);
    }
    public function profilKaryawan()
    {
        $data = [
            'title' => 'Profil Karyawan',
            'karyawan' => $this->karyawan->getKaryawan($this->session->userdata('id'))
        ];

        $this->load->view('karyawan/templet/header', $data);
        $this->load->view('karyawan/templet/sidebar');
        $this->load->view('karyawan/profilKaryawan', $data);
        $this->load->view('karyawan/templet/footer');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Data_Absensi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model admin dan model siswa
        $this->load->model('admin');
        $this->load->model('model_absensi_admin');
        $this->load->model('model_siswa');
        $this->load->model('model_jam');
        $this->load->helper('tanggal');
        $this->load->helper('absen');
        //Kalau bukan admin gak bisa dibuka lah
        if($this->admin->role()!="admin"){
            redirect("login/");
        }
    }

    public function index(){
        //Menampilkan view Info Siswa
        $data['data'] = $this->model_siswa->show_siswa_user();
        //var_dump($data['data']);
        $this->load->view("admin/absen/data_absen", $data);
    }

    public function json(){
        header('Content-Type: application/json');
        echo $this->model_kelas->json();
    }

    //Untuk melihat data absensi
    public function read()
    {
        $id_user = @$this->uri->segment(4) ? $this->uri->segment(4) : $this->session->id_user;
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data = array (
            'siswa' => $this->model_absensi_admin->get_user($id_user),
            'jam' => $this->model_jam->get_all(),
            'absen' => $this->model_absensi_admin->get_absen($id_user, $bulan, $tahun),
            'all_bulan' => bulan(),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'hari' => hari_bulan($bulan, $tahun),
        );
        //var_dump($data['hari']);
        $this->load->view('admin/absen/list_absen_siswa', $data);
    }

    //Log out
    public function log_out(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
?>
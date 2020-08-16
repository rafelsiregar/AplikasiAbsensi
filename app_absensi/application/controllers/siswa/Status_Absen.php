<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Status_Absen extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model admin dan model absensi
        $this->load->model('admin');
        $this->load->model('model_absensi_admin');
        $this->load->model('model_jam');
        $this->load->helper('tanggal');
        $this->load->helper('absen');
        //Kalau bukan admin gak bisa dibuka lah
        if($this->admin->role()!="siswa"){
            redirect("login/");
        }
    }

    public function json(){
        header('Content-Type: application/json');
        echo $this->model_absensi_admin->json();
    }

    //Menampilkan data yang sudah ada
    public function check($id){
        //Jumlah absensi pada tabel
        $jumlah_absen = $this->model_absensi_admin->absen_harian_siswa($id)->num_rows();
        //Memuat data absensi
        if($jumlah_absen==0){
            $this->load->view("siswa/belum_absen");
        //Kalau halamannya gak bisa dimuat
        } else if($jumlah_absen==1){
            $data_absen = $this->model_absensi_admin->absen_harian_siswa_by_keterangan($id, 'Masuk')->row();
            $data = array('jam_masuk'=> $data_absen->jam);
            $this->load->view("siswa/absen_siswa");
        } else {
            $data_absen = $this->model_absensi_admin->absen_harian_siswa_by_keterangan($id, 'Pulang')->row();
            $data = array('jam_pulang'=> $data_absen->jam);
            $this->load->view("siswa/absen_pulang_siswa", $data);
        }
    }

    public function read(){
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
        $this->load->view('siswa/list_absen_siswa', $data);
    }

    //Log out
    public function log_out(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
?>
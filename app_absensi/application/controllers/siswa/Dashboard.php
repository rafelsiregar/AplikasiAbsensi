<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('admin');
        //cek session dan model user
        if($this->admin->role()!="siswa")
            redirect("login/");
    }

    public function index(){
        $this->load->view("siswa/dashboard");
    }

    //Log out
    public function log_out(){
            $this->session->sess_destroy();
            redirect('login');
    }
}
?>
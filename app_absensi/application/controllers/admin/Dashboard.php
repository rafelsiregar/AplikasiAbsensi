<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('admin');
        //cek session dan model user
        if($this->admin->role()!="admin")
            redirect("login/");
    }

    public function index(){
        $this->load->view("admin/dashboard");
    }

    //Log out
    public function log_out(){
            $this->session->sess_destroy();
            redirect('login');
    }
}
?>
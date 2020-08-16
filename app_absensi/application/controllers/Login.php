<?php

    class Login extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            //Library Form Validasi
            $this->load->library('form_validation');
             //Load model Admin.php
             $this->load->model('admin');
        }

        public function index(){
            //Kalau sudah login
            if($this->admin->logged_in()){
                if($this->admin->role()=="admin")
                    redirect('admin/dashboard');
                else if($this->admin->role()=="siswa")
                    redirect('siswa/dashboard');
            //Kalau belum login
            } else {
                //Membuat aturan penulisan pada form, kalau required berarti gak boleh kosong
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                //Kalau valid
                if($this->form_validation->run()==TRUE){
                    //Ambil data dari form
                    $username = $this->input->post("username", TRUE);
                    $password = md5($this->input->post("password", TRUE));

                //Cek data melalui model
                $check_data = $this->admin->check_login('user', 
                                array('username' => $username), 
                                array('password'=> $password));

                if($check_data!=FALSE){
                    foreach($check_data as $db_checked){
                        $session_data = array(
                            'id_user' => $db_checked->id_user,
                            'username' => $db_checked->username,
                            'password' => $db_checked->password,
                            'role' => $db_checked->role
                        );
                        $this->session->set_userdata($session_data);
                        //Kalau admin
                        if($this->session->userdata("role")=="admin"){
                            redirect('admin/dashboard');
                        //Kalau bukan admin
                        } else {
                            redirect('siswa/dashboard');
                        }
                    }
                } else {
                    //Kalau salah
                    $data['error'] = 
                    '<div class="alert alert-danger" style="margin-top: 3px">
                        <div class="header">
                        <b>
                        <i class="fa fa-exclamation-circle"></i> ERROR</b> Username atau password salah
                        </div>
                        </div>';
                    $this->load->view('login', $data);
                } 
            } else {
                    $this->load->view('login');
            }
        }
    }

        
    }
?>
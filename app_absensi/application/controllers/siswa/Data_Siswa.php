<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Data_Siswa extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model admin dan model siswa
        $this->load->model('admin');
        $this->load->model('model_siswa');
        $this->load->model('model_kelas');
        $this->load->model('model_kelas_siswa');
        $this->load->model('model_user');
        $this->load->model('model_siswa_user');
        //Kalau bukan admin gak bisa dibuka lah
        if($this->admin->role()!="siswa"){
            redirect("login/");
        }
    }

    public function json(){
        header('Content-Type: application/json');
        echo $this->Model_siswa->json();
    }

    //Menampilkan data yang sudah ada
    public function read($id){
        //Jumlah row pada tabel
        $row = $this->model_siswa->get_by_id_user($id);
        //Memuat tabel
        if($row){
            $data = array (
                'id_siswa'=>$row->id_siswa,
                'nis' => $row->nis,
                'nama' => $row->nama,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'kelas' => $this->model_kelas_siswa->get_by_id($row->id_siswa)
            );


            $this->load->view("siswa/data_siswa", $data);
            //Kalau halamannya gak bisa dimuat
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa/dashboard'));
        }
    }

    public function update_user_info($id){
        $row = $this->model_user->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/data_siswa/update_user_info_action'),
		        'id_user' => set_value('id_user', $row->id_user),
		        'username' => set_value('username', $row->username),
                'password' => "",
                'new_password' => "",
                'confirm_password' => "",
		        'role' => set_value('role', $row->role)
        );

        $this->load->view('siswa/form_data_user', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa/dashboard'));
        }
    }

    public function update_user_info_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update_user_info($this->input->post('id_user', TRUE));
        } else {
            $data['data'] = array(
		        'id_user' => $this->input->post('id_user',TRUE),
		        'username' => $this->input->post('username',TRUE),
                'password' => md5($this->input->post('password',TRUE)),
		        'role' => "siswa"
            );

            $data['new_password'] = array(
                'password'=> md5($this->input->post('new_password', TRUE)),
            );

            $this->model_user->update_password($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa/dashboard'));
        }
    }

    public function password_check($password){
        $id = $this->session->userdata('id_user');
        $user = $this->model_user->get_by_id($id);
        if($user->password!==md5($password)){
            $this->form_validation->set_message('password_check', 'Sorry, you filled the wrong password');
            return FALSE;
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'callback_password_check');
        $this->form_validation->set_rules('new_password', 'new_password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'trim|required|min_length[4]|max_length[32]|matches[new_password]');
        
    	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}
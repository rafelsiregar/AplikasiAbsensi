<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('model_siswa');
        $this->load->model('model_user');
        $this->load->model('model_siswa_user');
        $this->load->library('form_validation');        
	    //$this->load->library('datatables');
    }

    public function index()
    {
        $data['data'] = $this->model_user->get_all();
        //Load untuk memuat user
        $this->load->view('admin/user/data_user', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->model_user->json();
    }

    public function read($id) 
    {
        $row = $this->model_user->get_by_id($id);
        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'username' => $row->username,
                'password' => $row->password,
                'role' => $row->role
            );
            $this->load->view('admin/user/data_user', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/data_user/create_action'),
    	    'id_user' => set_value('id_user'),
    	    'username' => set_value('username'),
            'password' => set_value('password'),
            'role' => set_value('role')
        );
        
        $data['siswa'] = $this->model_siswa->get_all();
        //User
        foreach ($data['siswa'] as $var) {
            $data['nis_siswa'][$var->id_siswa]="";
        }         
        $this->load->view('admin/user/form_data_user', $data);
    }
    
    public function create_action() 
    {
        $this->inserting_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data['data'] = array(
                'id_user' => $this->input->post('id_user',TRUE),
                'username' => $this->input->post('username',TRUE),
                'password' => md5($this->input->post('password', TRUE)),
                'role' => $this->input->post('role', TRUE)
            );

            $data["siswa"] = array(
                'id_siswa' => $this->input->post('siswa', TRUE)
            );
        
            $this->model_user->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/data_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->model_user->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/data_user/update_action'),
		        'id_user' => set_value('id_user', $row->id_user),
		        'username' => set_value('username', $row->username),
		        'password' => set_value('name', $row->password),
		        'role' => set_value('role', $row->role)
        );
        //Siswa yang merupakan user
        $data['siswa'] = $this->model_siswa->get_all();
        $siswa_user = $this->model_siswa_user->get_by_id($id);
        //Menghapus data NIS sebelumnya
        foreach ($data['siswa'] as $var) {
            $data['nis_siswa'][$var->id_siswa]="";
        }
        //Menampilkan NIS sebelumnya
        foreach ($siswa_user as $var) {
            $data['nis_siswa'][$var->id_siswa]="selected";
        }
        
        $this->load->view('admin/user/form_data_user', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/data_user'));
        }
    }
    
    public function update_action() 
    {
        $this->updating_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data['data'] = array(
		        'id_user' => $this->input->post('id_user',TRUE),
		        'username' => $this->input->post('username',TRUE),
		        'password' => md5($this->input->post('password',TRUE)),
		        'role' => $this->input->post('role',TRUE)
            );

            $data['siswa'] = array(
                'id_siswa' => $this->input->post('siswa', TRUE)
            );
            $this->model_user->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/data_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->model_user->get_by_id($id);

        if ($row) {
            $this->model_user->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/data_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/data_user'));
        }
    }

    //Rules
    public function inserting_rules() 
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]');
        $this->_rules();
    }

    public function updating_rules() 
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->_rules();
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('role', 'role', 'trim|required');
        

    	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Data_Kelas extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //load model admin dan model siswa
        $this->load->model('admin');
        $this->load->model('model_kelas');
        //Kalau bukan admin gak bisa dibuka lah
        if($this->admin->role()!="admin"){
            redirect("login/");
        }
    }

    public function index(){
        //Menampilkan view Info Siswa
        $data['data'] = $this->model_kelas->get_all();
        $this->load->view("admin/kelas/data_kelas", $data);
    }

    public function json(){
        header('Content-Type: application/json');
        echo $this->model_kelas->json();
    }

    /*//Menampilkan data yang sudah ada
    public function read($id){
        //Jumlah row pada tabel
        $row = $this->Model_kelas->get_by_id($id);
        //Memuat tabel
        if($row){
            $data = array (
                'tingkat' => $row->tingkat,
                'jurusan' => $row->jurusan,
                'nama_kelas' => $row->nama_kelas
            );
            $this->load->view("admin/data_kelas");
        //Kalau halamannya gak bisa dimuat
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dashboard'));
        }
    }*/

    public function create(){
            //Membuat form untuk menambah siswa
            $data = array (
                'button' => 'Tambah',
                'action' => site_url('admin/data_kelas/create_action'),
                'id_kelas' => set_value('id_kelas'),
                'tingkat' => set_value('tingkat'),
                'jurusan' => set_value('jurusan'),
                'nama_kelas' => set_value('nama_kelas')
            );
            //Halaman untuk mengisi form
            $this->load->view("admin/kelas/form_data_kelas", $data);
    }

    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kelas' => $this->input->post('id_kelas', TRUE),
                'tingkat' => $this->input->post('tingkat', TRUE),
                'jurusan' => $this->input->post('jurusan', TRUE),
                'nama_kelas' => $this->input->post('nama_kelas', TRUE)
            );

            $this->model_kelas->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/data_kelas'));
        }
    }

    //Update data kelas
    public function update($id) 
    {
        $row = $this->model_kelas->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/data_kelas/update_action'),
		        'id_kelas' => set_value('id_kelas', $row->id_kelas),
		        'tingkat' => set_value('tingkat', $row->tingkat),
		        'jurusan' => set_value('jurusan', $row->jurusan),
		        'nama_kelas' => set_value('nama_kelas', $row->nama_kelas)
        );
            $this->load->view('admin/kelas/form_data_kelas', $data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/data_kelas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
            'tingkat' => $this->input->post('tingkat',TRUE),
            'jurusan' => $this->input->post('jurusan',TRUE),
            'nama_kelas' => $this->input->post('nama_kelas',TRUE)
	    );

            $this->model_kelas->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/data_kelas'));
        }
    }

    //Untuk menghapus data kelas
    public function delete($id) 
    {
        $row = $this->model_kelas->get_by_id($id);
        if ($row) {
            $this->model_kelas->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/data_kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/data_kelas'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('tingkat', 'tingkat', 'trim|required');
        $this->form_validation->set_rules('jurusan', 'jurusan', 'trim');
        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'trim|required');

        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    //Log out
    public function log_out(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
?>
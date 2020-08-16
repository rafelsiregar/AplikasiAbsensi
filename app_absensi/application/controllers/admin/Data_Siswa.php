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
        if($this->admin->role()!="admin"){
            redirect("login/");
        }
    }

    public function index(){
        //Menampilkan view Info Siswa
        $data['data'] = $this->model_siswa->get_all();
        $this->load->view("admin/siswa/data_siswa", $data);
    }

    public function json(){
        header('Content-Type: application/json');
        echo $this->Model_siswa->json();
    }

    //Menampilkan data yang sudah ada
    public function read($id){
        //Jumlah row pada tabel
        $row = $this->model_siswa->get_by_id($id);
        //Memuat tabel
        if($row){
            $data = array (
                'id_siswa'=>$row->id_siswa,
                'nis' => $row->nis,
                'nama' => $row->nama,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'kelas' => $this->model_kelas_siswa->get_by_id($id),
                'username' => $this->model_siswa_user->get_by_id_siswa($id),
                'password' => $this->model_siswa_user->get_by_id_siswa($id)
            );

            //var_dump($data['username']);

            $this->load->view("admin/siswa/list_data_siswa", $data);
            //Kalau halamannya gak bisa dimuat
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dashboard'));
        }
    }

    public function create(){
            //Membuat form untuk menambah siswa
            $data = array (
                'button' => 'Tambah',
                'action' => site_url('admin/data_siswa/create_action'),
                'id_siswa' => set_value('id_siswa'),
                'nis' => set_value('nis'),
                'nama' => set_value('nama'),
                'jenis_kelamin' => set_value('jenis_kelamin'),
                'tempat_lahir' => set_value('tempat_lahir'),
                'tanggal_lahir' => set_value('tanggal_lahir')
            );
            //Menampilkan nama kelas
            $data['kelas']=$this->model_kelas->get_all();
            //Kelasnya belum ada
            foreach ($data['kelas'] as $var) {
                $data['kelas_siswa'][$var->id_kelas]="";
            }         

            //Halaman untuk mengisi form
            $this->load->view("admin/siswa/form_data_siswa", $data);
            
    }

    public function create_action(){
        $this->inserting_rules();
        //Kalau ada yang kosong
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        //Kalau udah diisi semua
        } else {
            $data['data'] = array(
        		'nis' => $this->input->post('nis',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE)
            );
            $data["kelas"]=array(
                'id_kelas' => $this->input->post('kelas', TRUE)
            );

            $this->model_siswa->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/data_siswa'));
        }
    }

        //Update data siswa
        public function update($id) 
        {
            $row = $this->model_siswa->get_by_id($id);
    
            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('admin/data_siswa/update_action'),
                    'id_siswa' => set_value('id_siswa', $row->id_siswa),
                    'nis' => set_value('nis', $row->nis),
                    'nama' => set_value('nama', $row->nama),
                    'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                );
                //Menampilkan nama kelas
                $data['kelas']=$this->model_kelas->get_all();
                //Menampilkan kelas siswa
                $kelas_siswa=$this->model_kelas_siswa->get_by_id($id);
                //Menghapus data kelas sebelumnya
                foreach ($data['kelas'] as $var) {
                    $data['kelas_siswa'][$var->id_kelas]="";
                }
                //Menampilkan kelas sebelumnya
                foreach ($kelas_siswa as $var) {
                    $data['kelas_siswa'][$var->id_kelas]="selected";
                }

                //Memuat Form untuk mengupdate data siswa
                $this->load->view('admin/siswa/form_data_siswa', $data);
                
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('admin/data_siswa'));
            }
        }
        
        public function update_action() 
        {
            $this->updating_rules();
            //Kalau ada yang gak diisi
            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_siswa', TRUE));
            } else {
            //Kalau udah diisi semua
                //$previous_id = $this->model_siswa->get_id();
                $data['data'] = array(
                'nis' => $this->input->post('nis',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE)
            );
            
            //Menambahkan nama kelas yang sekarang
            $data["kelas"] = array(
                'id_kelas' => $this->input->post('kelas', TRUE)
            );

            $this->model_siswa->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/data_siswa'));
            }
        }
    
        //Untuk menghapus data siswa
        public function delete($id) 
        {
            $row = $this->model_siswa->get_by_id($id);
            
            if ($row) {
                $this->model_siswa->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('admin/data_siswa'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('admin/data_siswa'));
            }
        }


    //Log out
    public function log_out(){
            $this->session->sess_destroy();
            redirect('login');
    }

    //Rules
    public function inserting_rules() 
    {
        $this->form_validation->set_rules('nis', 'nis', 'trim|required|is_unique[siswa.nis]');
        $this->_rules();
    }

    public function updating_rules() 
    {
        $this->form_validation->set_rules('nis', 'nis', 'trim|required');
        $this->_rules();
    }

    public function _rules(){
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
        $this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
        $this->form_validation->set_rules('id_siswa', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
}
?>
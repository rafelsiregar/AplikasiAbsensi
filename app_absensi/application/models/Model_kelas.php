<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Model_kelas extends CI_Model {
    public $table = 'kelas';
    public $id = 'id_kelas';


    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    //Fungsi untuk menampilkan informasi tabel
    function json(){
        //Menampilkan view Info Kelas
        $this->datatables->select('*');
        $this->datatables->from($this->table);
        return $this->datatables->generate();
    }

    //Menampilkan semua data kelas
    function get_all(){
        $this->db->order_by($this->id, 'ASC');
        return $this->db->get($this->table)->result();
    }

    //Menampilkan data
    function get_by_id($id)
    {
        $this->db->where($this->table.".".$this->id, $id);
        $this->db->select('*')->from($this->table);
        return $this->db->get()->row();
    }

    //Menampilkan jumlah data
    function get_total_rows($q=NULL){
        $this->db->like('tingkat', $q);
        $this->db->or_like('jurusan', $q);
        $this->db->or_like('nama_kelas', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //Menampilkan data dengan limit tertentu
    function get_with_limit($limit, $start=0, $q=NULL){
        $this->db->order_by($this->id, 'ASC');
        $this->db->like('tingkat', $q);
        $this->db->or_like('jurusan', $q);
        $this->db->or_like('nama_kelas', $q);
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    //CREATE DATA
    function insert($data){
        $this->db->insert($this->table, $data);
    }
    //UPDATE DATA
    function update($id, $data)
    {
        $this->db->where($this->id, $id)->update($this->table, $data);
    }
    //DELETE DATA
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    //Log out
    public function log_out(){
            $this->session->sess_destroy();
            redirect('login');
    }
}
?>
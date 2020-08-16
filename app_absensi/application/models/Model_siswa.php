<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Model_siswa extends CI_Model {
    public $table = 'siswa';
    public $id='id_siswa';
    public $table_kelas_siswa = 'tb_kelas_siswa';
    public $table_siswa_user = 'siswa_user';
    public $kelas = 'id_kelas';

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }


    //Fungsi untuk menampilkan informasi tabel
    function json(){
        //Menampilkan view Info Siswa
        $this->datatables->select('siswa.nis, siswa.nama, kelas.nama_kelas');
        $this->datatables->from('siswa');
        $this->datatables->join('tb_kelas_siswa', 'siswa.id_siswa=tb_kelas_siswa.id_siswa');
        $this->datatables->join('kelas', 'tb_kelas_siswa.id_kelas=kelas.id_kelas');
        return $this->datatables->generate();
    }

    //Menampilkan semua data siswa
    function get_all(){
        $this->db->order_by($this->id, 'DESC');
        //$this->db->join($this->table_siswa_user, $this->table.".".$this->id."=".$this->table_siswa_user.".".$this->id);
        return $this->db->get($this->table)->result();
    }

    //Menampilkan siswa user
    function show_siswa_user(){
        $this->db->order_by($this->table.".".$this->id, 'DESC');
        $this->db->join($this->table_siswa_user, $this->table.".".$this->id."=".$this->table_siswa_user.".".$this->id);
        $this->db->select('id_user, nama')->from($this->table);
        return $this->db->get()->result();
    }


    //Menampilkan data
    function get_by_id($id)
    {
        $this->db->where($this->table.".".$this->id, $id);
        $this->db->select('*')->from($this->table);
        //$this->db->join($this->table_kelas_siswa,$this->table_kelas_siswa.".id_siswa=".$this->table.".id_siswa");
        return $this->db->get()->row();
    }

    //Menampilkan data siswa dengan id user
    function get_by_id_user($id_user){
        $this->db->where($this->table_siswa_user.".id_user", $id_user);
        $this->db->select('*')->from($this->table_siswa_user);
        $this->db->join($this->table, $this->table_siswa_user.".id_siswa =".$this->table.".id_siswa");
        return $this->db->get()->row();

    }


    //Menampilkan jumlah data
    function get_total_rows($q=NULL){
        $this->db->like('id_siswa', $q);
        $this->db->like('nis', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tempat_lahir', $q);
        $this->db->or_like('tanggal_lahir', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //Menampilkan data dengan limit tertentu
    function get_with_limit($limit, $start=0, $q=NULL){
        $this->db->order_by('id_siswa', 'DESC');
        $this->db->like('id_siswa', $q);
        $this->db->like('nis', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('tempat_lahir', $q);
        $this->db->or_like('tanggal_lahir', $q);
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    //CREATE DATA
    function insert($data){
        //Menambahkan data baru
        $this->db->insert($this->table, $data['data']);
        //Mendapatkan ID Siswa
        $id=$this->db->insert_id();
        //Memasukkan data kelas ke dalam tabel kelas
        $data["kelas"]["id_siswa"] = $id;
        $this->db->insert($this->table_kelas_siswa, $data["kelas"]);
    }

    //UPDATE DATA
    function update($id, $data){
        //Melakukan update terhadap database siswa
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data['data']);
        //Kalau kelasnya ikut di-update
       if ($data["kelas"]) {
            //Mengupdate table relasi
            $data["kelas"]["id_siswa"] = $id;
            $this->db->where($this->id, $id)->update($this->table_kelas_siswa, $data["kelas"]);
        }
    }
    //DELETE DATA
    function delete($id){
        //Menghapus data dari tb_kelas_siswa
        $this->db->where($this->id, $id);
        $this->db->delete($this->table_kelas_siswa);
        //Menghapus data dari tabel
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
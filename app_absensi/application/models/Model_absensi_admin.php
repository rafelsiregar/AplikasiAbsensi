<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Model_absensi_admin extends CI_Model {
    public $table = 'absen';
    public $table_user = 'user';
    public $id = 'id_absen';
    public $table_siswa = 'siswa_user';
    public $id_user = 'id_user';


    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    /*function show()
    {
        $this->db->order_by($this->id, 'DESC');
        $this->db->select('id_absen, nama, absen.id_user');
        $this->db->from('absen');
        $this->db->join('siswa_user', 'absen.id_user=siswa_user.id_user', 'left');
        $this->db->join('siswa', 'siswa_user.id_siswa=siswa.id_siswa', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function show_siswa_user(){
        $this->db->order_by($this->id, 'DESC');
        $this->db->join($this->table_siswa_user, $this->table.".".$this->id."=".$this->table_siswa_user.".".$this->id);
        $this->db->select('id_user, nama')->from($this->table);
        return $this->db->get()->result();
    }*/


    //Menampilkan data siswa user
    function get_user($id)
    {
        //var_dump($id);
        $this->db->where($this->table_user.".".$this->id_user, $id);
        $this->db->select('*')->from($this->table_user);
        $this->db->join($this->table_siswa, $this->table_user.".".$this->id_user."=".$this->table_siswa.".".$this->id_user);
        $this->db->join('siswa', $this->table_siswa.".id_siswa=siswa.id_siswa");
        return $this->db->get()->row();
    }

    //Menampilkan data absensi
    function get_absen($id, $bulan, $tahun){
        $this->db->select("DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggal, a.jam AS jam_masuk, (SELECT jam FROM absen al WHERE al.tanggal = a.tanggal AND id_user = ".$id." AND al.keterangan != a.keterangan) AS jam_pulang, id_user");
        $this->db->where('id_user', $id);
        $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tanggal, '%Y') = ", $tahun);
        $this->db->group_by("tanggal");
        $result = $this->db->get('absen a');
        return $result->result_array();
    }

    function absen_harian_siswa($id_user){
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
		$this->db->where('absen.id_user', $id_user);
		$this->db->join('siswa_user', 'siswa_user.id_user=absen.id_user');
        $data = $this->db->get('absen');
        return $data;
    }

    function absen_harian_siswa_by_keterangan($id_user, $keterangan){
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
		$this->db->where('absen.id_user', $id_user);
		$this->db->where('keterangan', $keterangan);
        $data = $this->db->get('absen');
        return $data;
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
        $this->db->like('id_absen', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('jam', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //Menampilkan data dengan limit tertentu
    function get_with_limit($limit, $start=0, $q=NULL){
        $this->db->order_by($this->id, 'ASC');
        $this->db->like('id_absen', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('jam', $q);
        $this->db->or_like('keterangan', $q);
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
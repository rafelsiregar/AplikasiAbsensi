<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_kelas_siswa extends CI_Model
{

    public $table = 'tb_kelas_siswa';
    public $table_kelas = 'kelas';
    public $id = 'id_siswa';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_siswa,id_kelas');
        $this->datatables->from('tb_kelas_siswa');
        $this->datatables->add_column('action', anchor(site_url('data_kelas_siswa/read/$1'),'Read')." | ".anchor(site_url('data_kelas_siswa/update/$1'),'Update')." | ".anchor(site_url('data_kelas_siswa/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_siswa');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->select("*")->from($this->table);
        $this->db->join($this->table_kelas,$this->table.".id_kelas =".$this->table_kelas.".id_kelas");
        return $this->db->get()->result();
    }
    
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_siswa', $q);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_siswa', $q);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

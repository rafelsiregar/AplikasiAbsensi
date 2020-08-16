<?php
    defined('BASEPATH') OR exit('No direct script allowed');
    
    class Admin extends CI_Model {
        //Fungsi untuk mengecek apakah ada yang login
        function logged_in(){
            return $this->session->userdata('id_user');
        }
        //Fungsi untuk mengecek role
        function role(){
            return $this->session->userdata('role');
        }

        function check_login($table, $field1, $field2){
            //Query SQL : SELECT * FROM {$table} WHERE {$field1} AND {$field2} LIMIT 1
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($field1);
            $this->db->where($field2);
            $this->db->limit(1);
            //Menjalankan query sql
            $query = $this->db->get();
            //Kalau gak ada usernya
            if($query->num_rows()==0){
                return FALSE;
            //Kalau ada usernya
            } else {
                return $query->result();
            }
        }
    }
?>

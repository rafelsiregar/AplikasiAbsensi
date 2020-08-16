<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Model_jam extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('jam')->result();
    }

    public function find($id)
    {
        $this->db->where('id_jam', $id);
        return $this->db->get('jam')->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_jam', $id);
        $this->db->update('jam', $data);
    }
}

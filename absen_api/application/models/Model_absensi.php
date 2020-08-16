<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class model_absensi extends CI_Model 
{


    //Menampilkan riwayat absensi(untuk siswa)
        function get_absen($id, $bulan, $tahun){
            $this->db->select("DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggal, a.jam AS jam_masuk, (SELECT jam FROM absen al WHERE al.tanggal = a.tanggal AND id_user = ".$id." AND al.keterangan != a.keterangan) AS jam_pulang, id_user");
            $this->db->where('id_user', $id);
            $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan);
            $this->db->where("DATE_FORMAT(tanggal, '%Y') = ", $tahun);
            $this->db->group_by("tanggal");
            $result = $this->db->get('absen a');
            return $result->result_array();
        }

    public function absen_harian_siswa($id_user)
    {
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
		$this->db->where('absen.id_user', $id_user);
		$this->db->join('siswa_user', 'siswa_user.id_user=absen.id_user');
        $data = $this->db->get('absen');
        return $data;
    }

    public function insert($data)
    {
        $result = $this->db->insert('absen', $data);
        return $result;
    }

    public function get_jam_by_time($time)
    {
        $this->db->where('start', $time, '<=');
        $this->db->or_where('finish', $time, '>=');
        $data = $this->db->get('jam');
        return $data->row();
    }
}
?>
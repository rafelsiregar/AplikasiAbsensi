<?php  

/**
* 
*/
class model_login extends CI_Model
{
	
	private $table = "user";

	function get_user($username, $password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		
		return $this->db->get($this->table)->row();
	}
}

?>
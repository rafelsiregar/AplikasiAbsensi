<?php  

/**
* 
*/

require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		#Configure limit request methods
		$this->methods['index_get']['limit']=10; #10 requests per hour per user/key
		$this->methods['index_post']['limit']=10; #10 requests per hour per user/key
		$this->methods['index_delete']['limit']=10; #10 requests per hour per user/key
		$this->methods['index_put']['limit']=10; #10 requests per hour per user/key
		
		#Configure load model api table users
		$this->load->model('model_login');
	}

	function index_post(){
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'success get data' );

		#Set response API if Fail
		$response['FAIL'] = array('status' => FALSE, 'message' => 'fail get data' , 'data' => null );
		
		//Untuk login
		$data_user=$this->model_login->get_user($this->post('username'),md5($this->post('password')));
		//$data_user=$this->model_login->get_user('ariq', md5('ariq'));
		//var_dump($data_user);
		if ($data_user) {
			$response['SUCCESS']['data']=$data_user;			
			//$this->session->set_userdata((array)$data_user);
			$this->response($response['SUCCESS'] , REST_Controller::HTTP_OK);
		}else{
			$this->response($response['FAIL'] , REST_Controller::HTTP_NOT_FOUND);
		}

	}

}

?>
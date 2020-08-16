<?php  


/**
* 
*/
require APPPATH . 'libraries/REST_Controller.php';

class Absen extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		#Configure limit request methods
		$this->methods['index_get']['limit']=10; #10 requests per hour per mobil/key
		$this->methods['index_post']['limit']=10; #10 requests per hour per mobil/key
		$this->methods['index_delete']['limit']=10; #10 requests per hour per mobil/key
		$this->methods['index_put']['limit']=10; #10 requests per hour per mobil/key
		
		#Configure load model api table absensi
		$this->load->model('model_absensi');
	}


	function index_get($id_user=null){	
	
		//Method di sini buat riwayat absensi
		$id_user = @$this->uri->segment(3) ? $this->uri->segment(3) : $this->post('id_user');
		//$id_user = 3;
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
		$tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

		$data_absen = $this->model_absensi->get_absen($id_user, $bulan, $tahun);

		#Set response API if Not Found
		$response['NOT_FOUND']=array('status' => FALSE, 'message' => 'No data were found' , 'data' => null );
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data' , 'data' => $data_absen);
		
		if($data_absen){
			$this->response($response['SUCCESS'],REST_Controller::HTTP_CREATED);
		} else {
			#If fail
			$this->response($response['FAIL'],REST_Controller::HTTP_FORBIDDEN);
		}
	}
	
	//Melakukan absensi
	function index_post(){
		//Kalau ada URI Segmentnya
        if (@$this->uri->segment(3)) {
            $keterangan = ucfirst($this->uri->segment(3));
        } else {
			$absen_harian = $this->model_absensi->absen_harian_siswa($this->post('id_user'))->num_rows();
            $keterangan = ($absen_harian < 2 && $absen_harian < 1) ? 'Masuk' : 'Pulang';
        }
		
		$absen_data = array(
							'id_user' => $this->post('id_user'),
							'tanggal' => date('Y-m-d'),
                            'jam' => date('H:i:s'),
                            'keterangan' => $keterangan
						);

		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'success' , 'data' => $absen_data );
		#Set response API if Fail
		$response['FAIL'] = array('status' => FALSE, 'message' => 'fail' , 'data' => null);
		#Set response API if exist data
		$response['EXIST'] = array('status' => FALSE, 'message' => 'exist data' , 'data' => null );
		
		//Kalau datanya ada
		$jumlah_absen = $this->model_absensi->absen_harian_siswa($this->post('id_user'))->num_rows();
		//Kalau sudah pernah melakukan absensi sebelumnya
		if($keterangan==='Masuk' && $jumlah_absen>=1){
			$this->response($response['EXIST'], REST_Controller::HTTP_FORBIDDEN);
		}
		if($keterangan==='Pulang' && ($jumlah_absen!=1|| $jumlah_absen==2)){
			$this->response($response['EXIST'], REST_Controller::HTTP_FORBIDDEN);
		}

		//Memasukkan data absensi
		$result=$this->model_absensi->insert($absen_data);


		if($result){
			#If success
			$this->response($response['SUCCESS'],REST_Controller::HTTP_CREATED);
		} else {
			#If fail
			$this->response($response['FAIL'],REST_Controller::HTTP_FORBIDDEN);
		}
	}

}
?>
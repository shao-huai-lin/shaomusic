<?php
/**
* 
*/
class Music extends Portal_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function index($id=0){
		$data['id'] = $id;
		$this->load->view('music/index',$data);
	}
}
?>
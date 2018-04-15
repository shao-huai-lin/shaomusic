<?php
/**
* 
*/
class Music extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function index($id=0){
		$this->load->view('portal/music/index');
	}
}
?>
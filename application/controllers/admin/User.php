<?php
/**
* 用户管理控制器
*/
class User extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
	}
	public function index(){
		$this->user();
	}

	public function user(){
		$this->layout->view("user/u_user");
	}
}
?>
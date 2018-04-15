<?php
/**
* 后台首页模板
*/
class Index extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		//$this->check_login_exit();//检查是否登录
	}
	public function index(){
		$this->load->view('_layouts/index');
	}
}
?>
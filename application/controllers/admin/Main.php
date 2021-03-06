<?php
/**
* 首页
*/
class Main extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
		$this->load->model("admin/Admin_model","admin_m");
	}
	public function index(){
		$admin_id = $this->session->user["admin_id"];
		$user = $this->admin_m->get_admin_ram($admin_id);
		self::save_user($user);
		$this->layout->view("main/index");
	}
}
?>
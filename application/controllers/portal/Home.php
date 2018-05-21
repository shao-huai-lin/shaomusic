<?php
/**
* 前端首页控制器
*/
class Home extends Portal_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function index(){
		$this->load->view("home/main");
	}
	public function main2(){
		$this->load->view("home/main2");
	}
}
?>
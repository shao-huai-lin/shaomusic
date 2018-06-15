<?php
/**
* 前端首页控制器
*/
class Home extends Portal_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
		$this->load->helper('url');
	}
	public function index(){
		$data['info'] = array(
			array('title'=>'情到深处，便是无声的啜泣','author'=>'山谷居士','num'=>'52.9','cover'=>'public/mine/img/song-1.jpg'),
			array('title'=>'清凉电子，在嘴里融化的透耳薄荷','author'=>'设计狗的电音圈','num'=>'10.3','cover'=>'public/mine/img/song-2.jpg'),
			array('title'=>'【韩语/虐心】过了那么久，还是忍不住想你','author'=>'小龙','num'=>'7.5','cover'=>'public/mine/img/song-3.jpg'),
			array('title'=>'青丝绾起,故梦依稀','author'=>'乌也','num'=>'14.5','cover'=>'public/mine/img/song-4.jpg'),
			array('title'=>'你的笑只是因为，不愿意再次留下泪水吧','author'=>'槿栖','num'=>'2.0','cover'=>'public/mine/img/song-5.jpg'),
		);
		$this->layout->view("home/index",$data);
	}
	public function singer_list(){
		$this->layout->view("home/singer_list");
	}
	public function bill_list(){
		$this->layout->view("home/bill_list");
	}
	public function search(){
		$this->layout->view("home/search");
	}
	public function singer(){
		$this->layout->view("home/singer");
	}
	public function bill(){
		$this->layout->view("home/bill");
	}
}
?>
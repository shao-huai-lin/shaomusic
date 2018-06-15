<?php
/*
 * 
 */
class User extends Portal_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
		$this->load->model("admin/Songlist_model","song_m");
	}
	public function index($id=0){
		$data["songlist"] = $this->song_m->info(1);
		$this->layout->view('user/index',$data);
	}
	public function ajax_c_songlist(){
		if($_POST){
			$data['list_userid'] = 1;
			$data['list_title'] = get_var_post('title');
			$data['list_catetime'] = date("Y-m-d H:i:s",time());
			$this->song_m->save_info("s_songlist",$data);

			self::send_result();
		}
	}
}
?>
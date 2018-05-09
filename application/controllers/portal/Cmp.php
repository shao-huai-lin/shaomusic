<?php
/**
* 
*/
class Cmp extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper("public_functions");//加载公共操作函数
		$this->load->model("admin/Music_model","music_m");
	}
	public function fm(){
		$ids = explode_plus(',', get_var_get('ids'));
		$result = $this->music_m->get_music_ids($ids);
		$m = '';
		if($result){
			foreach($result as $v) {
				$src = base_url() . $v['music_audio'];
				$m .= "<m type=\"\" src=\"{$src}\" lrc=\"lrc/lrc.txt\" label=\"{$v['music_name']}\" />";
			}
		}
		echo "<list>{$m}</list>";
	}
}
?>
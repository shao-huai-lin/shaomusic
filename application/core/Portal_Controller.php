<?php
/**
* 前端控制器
*/
class Portal_Controller extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->change_view(PORTAL_VIEW_DIR);
	}
}

?>
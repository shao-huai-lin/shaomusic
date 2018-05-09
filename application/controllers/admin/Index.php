<?php
/**
* 后台框架模板
*/
class Index extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * [加载后台框架模板]
	 * @return [type] [description]
	 */
	public function index(){
		$this->load->view('_layouts/index');
	}
}
?>
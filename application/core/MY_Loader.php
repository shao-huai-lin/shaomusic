<?php
/**
* 
*/
class MY_Loader extends CI_Loader
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * [切换视图的地址]
	 * @param  [type] $view_path [description]
	 * @return [type]            [description]
	 */
	public function change_view($view_path){
		$this->_ci_view_paths = array( APPPATH . $view_path => TRUE);
	}
	
}
?>
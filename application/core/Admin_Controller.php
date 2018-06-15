<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * 后台控制器
 */
class Admin_Controller extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->change_view(ADMIN_VIEW_DIR);//视图地址切换为views/admin/

		$this->load->library('session');
		self::check_login();//检查是否登录
	}
	/**
	 * [判断是否登录]
	 * @return boolean [description]
	 */
	public function is_login(){
		return isset($this->session->user);
	}
	/**
	 * [检查是否登录，未登录跳到登录界面]
	 * @return [type] [description]
	 */
	public function check_login(){
		$filter = array("Auth/login");      //放过白名单("控制器/方法名")
    	if(self::filter($filter)){                        //过滤掉登录请求
      		if( ! self::is_login()){
        		//redirect("admin/Auth/login");
        		echo '<script>window.parent.location.href="'.HTTP_SITE_PATH.'"</script>';
        		exit();
      		}
    	}
	}
	/**
	 * [保存用户数据到session]
	 * @param  array  $user [description]
	 * @return [type]       [description]
	 */
	public function save_user($user = array()){
		if(empty($user)) return;
		$user["new_role"] = (! empty($user["role_list"])) ? $user["role_list"][0] : array() ;//默认角色
		if(! empty($user["role_list"])){//找数组中is_default 的覆盖默认角色
			foreach ($user["role_list"] as $role) {
				if($role["is_default"]){
					$user["new_role"] = $role;
					break;
				}
			}
		}
		$this->session->user = $user;
	}
	/**
	 * [清空用户数据session]
	 * @return [type] [description]
	 */
	public function dele_user(){
		$this->session->user = array();
		$this->session->unset_userdata("user");
	}
	/**
	 * [保存菜单数据]
	 * @param  array  $menu [description]
	 * @return [type]       [description]
	 */
	public function save_menu($menu = array()){
		if(empty($menu)) return;
		$this->session->menu = $menu;
	}
	/**
	 * [清空菜单数据]
	 * @return [type] [description]
	 */
	public function dele_menu(){
		$this->session->menu = array();
		$this->session->unset_userdata("menu");
	}
	/**
	 * [改变当前角色，保存到session]
	 * @param  integer $role_id [description]
	 * @return [type]           [description]
	 */
	public function change_role($role_id=0){
		if( empty($role_id) ) return;
		$user = $this->session->user;
		$new_role = array();
		foreach ($user["role_list"] as $role) {
			if($role["role_id"] == $role_id){
				$new_role = $role;
				break;
			}
		}
		$user["new_role"] = $new_role;
		$this->session->user = $user;
	}
	/**
	 * [过滤请求]
	 * @param  array  $filter_arr [description]
	 * @return [type]             [description]
	 */
	private function filter($filter_arr = array()){
	    $con = $this->router->fetch_class();  
	    $func = $this->router->fetch_method();
	    $url = $con . "/" . $func;
	    foreach ($filter_arr as $v) {
	    	if($v == $url){
	        	return false;
	        	break;
	      	}
	    }
	    return true;
	}
}
?>
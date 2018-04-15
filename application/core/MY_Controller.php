<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Shanghai");
/* load the MX_Router class */
// require APPPATH."libraries/MX/Controller.php";

class MY_Controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		header('Content-type:text/html;charset=utf-8;');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper("public_functions");//加载公共操作函数

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
	/**
	 * [输出成功json]
	 * @param  string  $data [成功的数据]
	 * @param  boolean $bool [是否结束语句执行]
	 * @return [type]        [json]
	 */
	public static function send_result( $data="",$bool = true){//返回JSON
		$obj = array();
		$obj[ 'err_code' ] = '0';
		$obj[ 'err_msg' ] = 'success';
		$obj[ 'data' ] = $data;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
		// die( json_encode( $obj ) );
		if($bool)
		die( json_encode( $obj ) );
		else
		echo json_encode( $obj );
	}
	/**
	 * [输出错误json]
	 * @param  [type]  $number [错误编码]
	 * @param  [type]  $msg    [消息]
	 * @param  boolean $bool   [是否结束语句执行]
	 * @return [type]          [json]
	 */
	public static function send_error( $number = 404 , $msg = "not found" ,$bool = true){
		$obj = array();
		$obj[ 'err_code' ] = intval( $number );
		$obj[ 'err_msg' ] = $msg;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
		if($bool)
		die( json_encode( $obj ) );
		else
		echo json_encode( $obj );
	}
	/**
	 * [输出满足jquery.dataTable格式json]
	 * @param  integer $nums [总数量]
	 * @param  array   $data [数据]
	 * @return [type]        [json]
	 */
	public static function send_dataTable($nums = 0,$data = array()){
		$data_arr = array(
			"iTotalRecords"   		=> $nums,
	 		"iTotalDisplayRecords"  => $nums,
			"aaData"=>$data
		);
		die(json_encode($data_arr));
	}
	/**
	 * [返回错误对象]
	 * @param  [type] $err_code [description]
	 * @param  [type] $err_msg  [description]
	 * @return [type]           [description]
	 */
	public static function back_error($err_code,$err_msg)
    {
        $obj = array();
        $obj[ 'err_code' ] = intval($err_code);
        $obj[ 'err_msg' ] = $err_msg;
        return $obj;
    }
    /**
     * [返回成功对象]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function back_result($data)
    {
        $obj = array();
        $obj[ 'err_code' ] = '0';
        $obj[ 'err_msg' ] = 'success';
        $obj[ 'data' ] = $data;
        return $obj;
    }
}
?>
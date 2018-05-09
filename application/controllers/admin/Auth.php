<?php
/**
* 登录控制器
*/
class Auth extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('layout',array('file'=>'index'));
		$this->load->library("form_validation");
		$this->load->helper('form');

		$this->load->model("admin/Menu_model","menu_m");
		$this->load->model("admin/Admin_model","admin_m");
	}
	/**
	 * [登录]
	 * @return [type] [description]
	 */
	public function login(){
		$data["error"] = "";
		if($_POST){
			if($this->form_validation->run("login")){//表单验证
				$row = $this->admin_m->select_info_row("s_admin",array("admin_name"=>$_POST["username"]));
				if($row){
					if($row["admin_pwd"] == $_POST["password"]){
						if( ! $row["admin_islock"]) {//判断账号是否可用
							//记录登录时间和次数
							$this->admin_m->upd_admin_tan($row['admin_id']);
				 			
				 			$user = $this->admin_m->get_admin_ram($row["admin_id"]);
							$menu = $this->menu_m->get_menu_info();
							self::save_user($user);
							self::save_menu($menu);
							redirect("admin/Index");
						}else{
							$data["error"] = "账号被禁用";
						}
					}
				}
			}
		}

		$this->load->view('login',$data);
	}
	/**
	 * [登出]
	 * @return [type] [description]
	 */
	public function logout(){
		self::dele_user();
		self::dele_menu();
		header('Location: '.HTTP_SITE_PATH);
		exit;
	}
}
?>
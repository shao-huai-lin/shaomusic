<?php
/**
 * 系统管理
 */
class SysControl extends Admin_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
		$this->load->library('pagination');
		$this->load->helper('form');

		$this->load->model("admin/Admin_model","admin_m");
		$this->load->model("admin/Menu_model" ,"menu_m");
		$this->load->model("admin/Role_model" ,"role_m");
	}
	public function index(){
		$this->sys_admin();
	}
	/**
	 * [系统用户页面]
	 * @return [type] [description]
	 */
	public function sys_admin(){
		$this->layout->view("sys/sys_admin");
	}
	/**
	 * [添加或更新系统用户界面]
	 * @return [type] [description]
	 */
	public function sys_admin_add(){
		$data["admin_id"] = get_var_value("admin_id");

		$data["info"] = $this->admin_m->get_admin_info_one($data["admin_id"]);

		$data["role"] = $this->role_m->select_info_result("s_role");
		$this->layout->view("sys/sys_admin_add",$data);
	}
	/**
	 * [ajax获取系统用户信息]
	 * @return [type] [description]
	 */
	public function sys_admin_info(){
		
		$start_record	= get_var_value( 'iDisplayStart' ); 	//从多少条开始查询
		$page_size		= get_var_value( 'iDisplayLength' ); 	//每页显示多少条记录

		$admin_name     = get_var_value('admin_name');//查询条件

		$data_arr = array();
		
		$where = array();
		$like = array("admin_name"=>$admin_name);
		$data = $this->admin_m->get_admin_info($start_record,$page_size,$where,$like);
		
		self::send_dataTable($data[0],$data[1]);
	}
	/**
	 * [添加或更新系统用户]
	 * @return [type] [description]
	 */
	public function sys_admin_save($admin_id = 0,$is_lock = -1){
		if($_POST){
			$admin_id = get_var_post("admin_id");
			if(empty($admin_id)){//添加
				$admin["admin_name"] 		= $_POST["admin_name"];
				$admin["admin_pwd"] 		= $_POST["admin_pwd"];
				$admin["admin_islock"] 		= $_POST["admin_islock"];
				$admin["admin_catetime"] 	= date("Y-m-d H:i:s",time());

				$admin_id = $this->admin_m->save_info("s_admin",$admin);
			}else{//修改
				$admin_name["admin_name"] 	= $_POST["admin_name"];	
				$admin["admin_islock"] 		= $_POST["admin_islock"];
				if( ! empty($_POST["admin_pwd"]))
				$admin["admin_pwd"] 		= $_POST["admin_pwd"];

				$where = array("admin_id"=>$admin_id);
				$this->admin_m->update_info("s_admin",$admin,$where);
			}

			if(isset($_POST["role_id"])){
				$this->admin_m->save_admin_role($admin_id,$_POST["role_id"]);
			}else{
				//做这步的目的是编辑时候，所有角色都取消了，这时候没有role_id 提交,数据库没有执行
				$this->admin_m->save_admin_role($admin_id,array(0)); 
			}
			self::send_result();
		}

		//处理GET提交的启用和禁用
		$data 	= array("admin_islock"=> !$is_lock*1);
		$where 	= array("admin_id"=>$admin_id);
		if($this->role_m->update_info("s_admin",$data,$where)){
			redirect("admin/SysControl/sys_admin");
		}
	}
	/**
	 * [删除系统用户]
	 * @return [type] [description]
	 */
	public function sys_admin_del(){
		$admin_id = get_var_value("admin_id");

		$where = array("admin_id"=>$admin_id);
		if($this->admin_m->del_info("s_admin",$where)){
			self::send_result();
		}else{
			self::send_error(404,"未找到相应资源");
		}
	}
	/**
	 * [用户角色页面]
	 * @return [type] [description]
	 */
	public function sys_role(){
		$this->layout->view("sys/sys_role");
	}
	/**
	 * [角色添加或修改页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function sys_role_mod($id = 0){
		$data["menu"] = $this->menu_m->get_menu_info();

		$data["role_id"] = $id;
		$data["info"] = $this->role_m->get_role_info_one($id);
		$this->layout->view("sys/sys_role_mod",$data);
	}
	/**
	 * [ajax获取角色信息]
	 * @return [type] [description]
	 */
	public function sys_role_info(){
		$role = $this->role_m->get_role_info();
		self::send_dataTable($role[0],$role[1]);
	}
	/**
	 * [添加或修改角色信息]
	 * @return [type] [description]
	 */
	public function sys_role_save($role_id=0,$is_lock=-1){
		if($_POST){
			if($_POST["role_id"]){
				$role["role_name"] 		= $_POST["role_name"];
				$role["role_islock"] 	= $_POST["role_islock"];
				$this->role_m->update_info("s_role",$role,array("role_id"=>$_POST["role_id"]));			//更新角色
				$role_id = $_POST["role_id"];

			}else{
				$role["role_name"] 		= $_POST["role_name"];
				$role["role_islock"] 	= $_POST["role_islock"];
				$role_id = $this->role_m->save_info("s_role",$role);									//添加角色
			}

			if(isset($_POST["menu_id"])){																//这里需要判断一下
				$this->role_m->save_role_menu($role_id,$_POST["menu_id"]);								//保存角色菜单表信息
			}
			self::send_result();
		}

		//处理GET提交的启用和禁用
		$data 	= array("role_islock"=> !$is_lock*1);
		$where 	= array("role_id"=>$role_id);
		if($this->admin_m->update_info("s_role",$data,$where)){
			redirect("admin/SysControl/sys_role");
		}

	}
	/**
	 * [改变默认角色]
	 * @param  integer $role_id [description]
	 * @return [type]           [description]
	 */
	public function sys_role_change($role_id=0){
		$admin_id = $this->session->user["admin_id"];
		$this->admin_m->update_info("s_admin_role",array("is_default"=>0),array("admin_id"=>$admin_id,"is_default"=>1));//将之前的默认关闭
		$this->admin_m->update_info("s_admin_role",array("is_default"=>1),array("admin_id"=>$admin_id,"role_id"=>$role_id));//更新默认角色

		redirect("admin/Main");
	}

	/**
	 * [系统菜单页面]
	 * @return [type] [description]
	 */
	public function sys_menu(){
		$data["info"] = $this->menu_m->get_menu_info();
		$this->layout->view("sys/sys_menu",$data);
	}
	/**
	 * [添加菜单页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function sys_menu_add($id = 0){
		$data["menu_pid"] = $id;
		$this->layout->view("sys/sys_menu_mod",$data);
	}
	/**
	 * [修改菜单页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function sys_menu_edit($id = 0){
		$data["menu_id"] = $id;
		$data["info"] = $this->menu_m->select_info_row("s_menu",array("menu_id"=>$id));
		$this->layout->view('sys/sys_menu_mod',$data);
	}
	/**
	 * [添加,修改菜单]
	 * @return [type] [description]
	 */
	public function sys_menu_save(){
		if($_POST){
			if(empty($_POST["menu_id"])){ //menu_id为空，添加
				if($this->menu_m->save_info('s_menu',$_POST)) self::send_result();
			}else{						  //修改
				$where = array("menu_id"=>$_POST["menu_id"]);
				if($this->menu_m->update_info('s_menu',$_POST,$where)) self::send_result();
			}
		}
		self::send_error();
	}
	/**
	 * [删除菜单]
	 * @return [type] [description]
	 */
	public function sys_menu_del($id = 0){
		$this->menu_m->del_menu($id);
		redirect("admin/SysControl/sys_menu");
	}
}

?>
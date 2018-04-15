<?php
/**
* 
*/
class Role_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * [查询所有角色信息，包括角色的菜单操作权限]
	 * @param  int  $role_id [角色id]
	 * @return [type]        [description]
	 */
	public function get_role_info($role_id = 0){
		$this->db->select("a.*,c.menu_id,c.menu_name");
		if($role_id) $this->db->where("a.role_id",$role_id);
		$this->db->join("s_role_menu b","a.role_id=b.role_id","left");
		$this->db->join("s_menu c","c.menu_id=b.menu_id","left");
		$result = $this->db->get("s_role a")->result_array();

		$nums = $this->db->get("s_role")->num_rows();	//角色总数

		$data = array();					//保存最后的结果
		$group = array();					//数据分组，根据role_id分组
		foreach ($result as $k => $v) {
			$group[$v["role_id"]][] = $v;
		}

		foreach ($group as $chunk) {			//循环组	
			$menu_list = array();
			
			foreach ($chunk as $v) {
				if( ! $v["menu_id"]) continue;
				$menu["menu_id"] 	= $v["menu_id"];
				$menu["menu_name"] 	= $v["menu_name"];
				array_push($menu_list, $menu);
			}

			$role["role_id"]	= $chunk[0]["role_id"];
			$role["role_name"]	= $chunk[0]["role_name"];
			$role["role_islock"]= $chunk[0]["role_islock"];
			$role["menu_list"] 	= $menu_list;
			array_push($data, $role);
		}

		return $data ? array( $nums, $data ) : array( 0 , array() );
	}

	/**
	 * [查询一条角色信息，包括角色的菜单id]
	 * @param  string $role_id [description]
	 * @return [type]          [description]
	 */
	public function get_role_info_one($role_id = 0){
		if(empty($role_id)) return array(); 
		$result = self::get_role_info($role_id); 
		$data = $result[1][0];						//取角色信息
		foreach ($data["menu_list"] as $k => $v) {
			$data["menu_list"][$k] = $v["menu_id"]; //保留menu_list中 menu_id 为数组
		}

		return $data;
	}
	/**
	 * [保存角色菜单信息]
	 * @param  [type] $role_id    [角色id]
	 * @param  array  $result_new [新的数据]
	 * @return [type]             [description]
	 */
	public function save_role_menu($role_id,$result_new = array()){

		//获取旧数据
		$result_old = array();
		$result = $this->db->select("menu_id")->where("role_id",$role_id)->get("s_role_menu")->result_array();
		foreach ($result as $k => $v) {
			$result_old[$k] = $v["menu_id"];
		}

		$intersect = array_intersect($result_old, $result_new); //交集（不需要处理的）
		$result_del = array_diff($result_old, $intersect);		//需要删除的
		$result_add = array_diff($result_new, $intersect);		//需要添加的


		if($result_del){										//删除数据
			foreach ($result_del as $v) {
				$bool_del = $this->db->delete("s_role_menu",array("role_id"=>$role_id,"menu_id"=>$v));
			}
		}

		if($result_add){										//增加数据
			foreach ($result_add as $v) {
				$bool_add = $this->db->insert("s_role_menu",array("role_id"=>$role_id,"menu_id"=>$v));
			}
		}
	}
}
?>
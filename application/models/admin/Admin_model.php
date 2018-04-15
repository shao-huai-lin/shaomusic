<?php
/**
* 
*/
class Admin_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * [分页获取系统用户信息]
	 * @param  integer $start_record [从第几条开始查询]
	 * @param  integer $page_size    [每页显示多少条记录]
	 * @param  string  $where        [条件]
	 * @param  string  $orderby      [排序]
	 * @return array                 [返回数组 array[0] => 总数 array[1] => 用户信息]
	 */
	public function get_admin_info($start_record=0, $page_size=10, $where=array(), $like=array(), $orderby=''){
		$result = $this->db->limit($page_size,$start_record)->order_by($orderby)->like($like)->where($where)->get("s_admin")->result_array();

		if($result){//有用户，找用户的角色信息
			foreach ($result as $v) {
				$ids[] = $v["admin_id"];
			}
			$roles = $this->db->select("a.admin_id, b.is_default ,c.*")->join("s_admin_role b","a.admin_id = b.admin_id","left")->join("s_role c","c.role_id = b.role_id","left")->where_in("a.admin_id",$ids)->get("s_admin a")->result_array();
			foreach ($result as &$v) {
				foreach ($roles as $k => $r) {
					if($v["admin_id"] == $r["admin_id"]){
						unset($r["admin_id"]);
						if(empty($r["role_id"])) $v["role_list"] = array();
						else $v["role_list"][] = $r;
					}
				}
			}
		}
		

		$nums = $this->db->like($like)->where($where)->get("s_admin")->num_rows();

		return $result ? array( $nums, $result ) : array( 0 , array() );
	}
	/**
	 * [根据id获取一条用户信息，包括角色信息id]
	 * @param  integer $admin_id [description]
	 * @return [type]            [description]
	 */
	public function get_admin_info_one($admin_id = 0){
		$result = self::get_admin_info(null,null,array("admin_id"=>$admin_id));

		$data = array();
		if(isset($result[1][0])){
			$data = $result[1][0];
			foreach ($data["role_list"] as $k => $v) {
				$data["role_list"][$k] = $v["role_id"]; //保留menu_list中 menu_id 为数组
			}
		}
		return $data;
	}
	/**
	 * [获取用户信息，包括角色信息，角色的菜单id]
	 * 用于登录的时候
	 * @param  string $admin_name [description]
	 * @return [type]             [description]
	 */
	public function get_admin_ram($admin_id = 0){
		// $user = $this->db->where("admin_name",$admin_name)->get("s_admin")->row_array();

		// $role = $this->db->where("b.admin_id",$user["admin_id"])->join("s_admin_role b","b.role_id = a.role_id","left")->get("s_role a")->result_array();
		$this->db->select("a.admin_id,a.admin_name,b.is_default,c.role_id,c.role_name,e.menu_id,e.menu_name");
		$this->db->where("a.admin_id",$admin_id);
		$this->db->join("s_admin_role b","a.admin_id = b.admin_id","left");
		$this->db->join("s_role c","b.role_id = c.role_id","left");
		$this->db->join("s_role_menu d","c.role_id = d.role_id","left");
		$this->db->join("s_menu e","d.menu_id = e.menu_id","left");
		$data = $this->db->get("s_admin a")->result_array();

		$group = array();
		foreach ($data as $v) {
			if( ! $v["role_id"]) continue;
			$group[$v["role_id"]][] = $v;
		}

		$role_list = array();
		foreach ($group as $chunk) {
			$menu_list = array();
			foreach ($chunk as $v) {
				if( ! $v["menu_id"]) continue;
				// $menu["menu_id"] 	= $v["menu_id"];
				// $menu["menu_name"] 	= $v["menu_name"];
				// array_push($menu_list, $menu);
				$menu_list[] = $v["menu_id"];
			}
			$role["role_id"] = $chunk[0]["role_id"];
			$role["role_name"] = $chunk[0]["role_name"];
			$role["is_default"] = $chunk[0]["is_default"];
			$role["menu_list"] = $menu_list;
			array_push($role_list, $role);
		}

		$admin["admin_id"] = $data[0]["admin_id"];
		$admin["admin_name"] = $data[0]["admin_name"];
		$admin["role_list"] = $role_list;

		return $admin;
	}
	/**
	 * [保存用户角色信息]
	 * @param  [type] $admin_id   [用户id]
	 * @param  array  $result_new [新的数据]
	 * @return [type]             [description]
	 */
	public function save_admin_role($admin_id,$result_new = array()){
		//获取旧数据
		$result_old = array();
		$result = $this->db->select("role_id")->where("admin_id",$admin_id)->get("s_admin_role")->result_array();
		foreach ($result as $k => $v) {
			$result_old[$k] = $v["role_id"];
		}
		
		$intersect = array_intersect($result_old, $result_new); //交集（不需要处理的）
		$result_del = array_diff($result_old, $intersect);		//需要删除的
		$result_add = array_diff($result_new, $intersect);		//需要添加的

		if($result_del){										//删除数据
			foreach ($result_del as $v) {
				$bool_del = $this->db->delete("s_admin_role",array("admin_id"=>$admin_id,"role_id"=>$v));
			}
		}

		if($result_add){										//增加数据
			foreach ($result_add as $v) {
				if($v){	//取消role_id 为 0 的添加
					$bool_add = $this->db->insert("s_admin_role",array("admin_id"=>$admin_id,"role_id"=>$v));
				}
			}
		}
	}
	/**
	 * [更新登录的时间和次数]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function upd_admin_tan($id){
		$this->db->set('admin_logintime',date('Y-m-d H:i:s',time()))
		->set('admin_loginnum','admin_loginnum+1',false)
		->where('admin_id',$id)
		->update('s_admin');
	}
}
?>
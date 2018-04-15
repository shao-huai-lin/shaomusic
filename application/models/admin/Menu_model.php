<?php
/**
* 
*/
class Menu_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * [获取菜单数据数组层级形式]
	 * @return [type] [description]
	 */
	public function get_menu_info(){
		$result = $this->db->get("s_menu")->result_array();
		return $this->arrange_data($result,"menu_id","menu_pid");
	}
	/**
	 * [级联删除菜单]
	 * @return [type] [description]
	 */
	public function del_menu($id = 0){
		$result = $this->db->get("s_menu")->result_array();
		$ids = array($id);
		$func = function($data,$pid) use(&$func,&$ids){ //递归查找所有子菜单的id
			foreach ($data as $v) {
				if($v["menu_pid"] == $pid){
					array_push($ids, intval($v["menu_id"]));
					$func($data,$v["menu_id"]);
				}
			}
		};
		$func($result,$id);

		return $this->db->where_in("menu_id",$ids)->delete("s_menu"); //返回true or false
	}
}
?>
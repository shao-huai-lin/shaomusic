<?php
/**
* 
*/
class MY_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//打开数据库连接
		$this->load->helper("public_functions");
	}

	/**
	 * [条件查询一条数据]
	 * @param  [type] $mytable [description]
	 * @param  array  $where   [description]
	 * @param  string $select  [description]
	 * @return [type]          [description]
	 */
	public function select_info_row($mytable,$where = array(),$select = "*"){
		if(empty($mytable)) return null;
		return $this->db->select($select)->where($where)->get($mytable)->row_array();
	}
	/**
	 * [条件查询多条数据]
	 * @param  string $mytable [表名]
	 * @param  array  $where   [条件]
	 * @param  string $select  [查询结果]
	 * @return [type]          [description]
	 */
	public function select_info_result($mytable,$where = array(),$select = "*"){
		if (empty($mytable)) return null;
		return $this->db->select($select)->where($where)->get($mytable)->result_array();
	}
	/**
	 * [保存信息]
	 * @param  [type] $mytable [表名]
	 * @param  [type] $data    [保存的数据]
	 * @return [type]          [id]
	 */
	public function save_info( $mytable, $data ){
		//如果要保存的内容为空，则返回FALSE
		if(empty( $data ) || empty( $mytable ) ) return FALSE;
		
		$this->db->insert( $mytable, $data );
		return $this->db->insert_id();
	}
	/**
	 * [更新信息]
	 * @param  [type] $mytable [表名]
	 * @param  [type] $data    [更新的数据]
	 * @param  [type] $where   [条件]
	 * @return [type]          [boolean]
	 */
	public function update_info( $mytable, $data, $where ){
		//如果要保存的内容为空，则返回FALSE
		if( empty( $data ) || empty( $mytable ) || empty($where) ) return FALSE;
		
		if( $this->db->update( $mytable, $data, $where ) )
			return TRUE;
		else
			return FALSE;
	}
	/**
	 * [批量更新信息]
	 * @param  [type] $mytable [表名]
	 * @param  [type] $data    [二维数组]
	 * @param  [type] $key     [条件的键]
	 * @return [type]          [description]
	 */
	public function update_batch_info($mytable,$data,$key){
		if(empty($data) || empty($mytable) || empty($key)) return FALSE;

		return $this->db->update_batch($mytable,$data,$key);
	}
	/**
	 * [删除信息]
	 * @param  [type] $mytable [表名]
	 * @param  [type] $where   [条件]
	 * @return [type]          [boolean]
	 */
	public function del_info( $mytable,$where ){
		if( empty( $mytable ) || empty( $where ) ) return FALSE;
		
		if( $this->db->delete( $mytable, $where) )
			return TRUE;
		else
			return FALSE;
	}

	
	/**
	 * [整理菜单 返回数组]
	 * @param  [type] $data [待整理的数据]
	 * @return [type]       [数组]
	 */
	public function arrange_data($data,$id_name="id",$pid_name = "pid"){
		$list = array();
		if( ! isset($data[0][$id_name]) || ! isset($data[0][$pid_name])) return $list;
	    foreach ($data as $v) {
	        if($v[$pid_name] == 0){
	            
	            $v['node'] = $v[$id_name];
	            $v['child'] = array();
	            $boss = $v;
	            $this->g($data,$boss,$id_name,$pid_name);
	            array_push($list, $boss);
	        }
	    }
	    return $list;
	}
	private function g($data,&$father = array(),$id_name="id",$pid_name = "pid"){
	    foreach ($data as $v) {
	        if($v[$pid_name] == $father[$id_name]){
	            $v['node'] = $father['node'].'-'.$v[$id_name];
	            $v['child'] = array();
	            $child = $v;
	            $this->g($data,$child,$id_name,$pid_name);
	            array_push($father['child'], $child);
	        }
	    }
	}
}
?>
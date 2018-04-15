<?php
/**
* 
*/
class Special_model extends MY_Model
{
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * [分页获取专辑信息]
	 * @param  integer $start_record [从第几条开始查询]
	 * @param  integer $page_size    [每页显示多少条记录]
	 * @param  array   $where        [条件]
	 * @param  array   $like         [条件]
	 * @param  string  $orderby      [排序]
	 * @return [type]                [description]
	 */
	public function get_special_info($start_record=0, $page_size=10, $where=array(), $like=array(), $orderby=''){
		$result = $this->db->select("s_special.* ,s_singer.singer_id ,s_singer.singer_name")->limit($page_size,$start_record)->order_by($orderby)->like($like)->where($where)->join("s_singer","singer_id = special_singerid","left")->get('s_special')->result_array();

		$nums = $this->db->like($like)->where($where)->get("s_special")->num_rows();

		return $result ? array( $nums, $result ) : array( 0 , array() );
	}
	/**
	 * [获取专辑一条信息，包含歌手信息]
	 * @param  integer $id [专辑id]
	 * @return [type]      [description]
	 */
	public function get_special_one($id=0){
		return $this->db->select("s_special.* ,s_singer.singer_id,singer_name,singer_cover")->where("special_id",$id)->join("s_singer","singer_id = special_singerid","left")->get("s_special")->row_array();
	}
}
?>
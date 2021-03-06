<?php
/**
* 
*/
class Singer_model extends MY_Model
{
	
	function __construct(){
		parent::__construct();

	}
	/**
	 * [分页获取歌手信息]
	 * @param  integer $start_record [从第几条开始查询]
	 * @param  integer $page_size    [每页显示多少条记录]
	 * @param  array   $where        [条件]
	 * @param  array   $like         [条件]
	 * @param  string  $orderby      [排序]
	 * @return [type]                [description]
	 */
	public function get_singer_info($start_record=0, $page_size=10, $where=array(), $like=array(), $orderby=''){
		$result = $this->db->limit($page_size,$start_record)->order_by($orderby)->like($like)->where($where)->get('s_singer')->result_array();

		$nums = $this->db->like($like)->where($where)->get("s_singer")->num_rows();

		return $result ? array( $nums, $result ) : array( 0 , array() );
	}
}
?>
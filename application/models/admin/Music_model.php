<?php
/**
* 
*/
class Music_model extends MY_Model
{
	
	function __construct(){
		parent::__construct();
	}

	/**
	 * [分页获取音乐信息]
	 * @param  integer $start_record [从第几条开始查询]
	 * @param  integer $page_size    [每页显示多少条记录]
	 * @param  array   $where        [条件]
	 * @param  array   $like         [条件]
	 * @param  string  $orderby      [排序]
	 * @return [type]                [description]
	 */
	public function get_music_info($start_record=0, $page_size=10, $where=array(), $like=array(), $orderby=''){
		$result = $this->db->select("s_music.* ,s_singer.singer_id ,s_singer.singer_name ,s_special.special_id ,s_special.special_name")
				->limit($page_size,$start_record)->order_by($orderby)->like($like)->where($where)
				->join("s_singer","singer_id = music_singerid","left")
				->join("s_special","special_id = music_specialid","left")
				->get('s_music')->result_array();

		$nums = $this->db->like($like)->where($where)->get("s_music")->num_rows();

		return $result ? array( $nums, $result ) : array( 0 , array() );
	}
	/**
	 * [获取音乐一条信息，包含歌手，专辑]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function get_music_one($id=0){
		return $this->db->select("s_music.* , singer_id ,singer_name ,singer_cover ,special_id ,special_name ,special_cover")
				->where("music_id",$id)
				->join("s_singer","singer_id = music_singerid","left")
				->join("s_special","special_id = music_specialid","left")
				->get("s_music")->row_array();
	}
}
?>
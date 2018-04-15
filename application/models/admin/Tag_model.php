<?php
/**
* 
*/
class Tag_model extends MY_Model
{
	
	function __construct(){
		parent::__construct();
	}

	public function get_tag_info(){
		$data = $this->db->get('s_tag')->result_array();
		
		$result = array();//最终返回结果

		foreach ($data as $v) {
			$result[$v['tag_type']][] = $v;
		}
		return $result;
	}
}
?>
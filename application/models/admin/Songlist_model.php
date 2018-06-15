<?php
/**
* 
*/
class Songlist_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function info($userid = 0){
		return $this->db->select("a.*,b.user_nick")->join("s_user b","a.list_userid = b.user_id")->where("a.list_userid",$userid)->get("s_songlist a")->result_array();
	}
}
?>
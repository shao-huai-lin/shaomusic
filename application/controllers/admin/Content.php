<?php
/**
* 
*/
class Content extends MY_Controller
{
	private static $namespace = 'admin/content/';
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('layout',array('file'=>'main'));
		$this->load->model("admin/Admin_model","admin_m");
		$this->load->model("admin/Singer_model","singer_m");
		$this->load->model("admin/Special_model","special_m");
		$this->load->model("admin/Music_model","music_m");
		$this->load->model("admin/Tag_model","tag_m");
	}
	/**
	 * [栏目页面]
	 * @param  integer $type [栏目类型 1音乐 2专辑 3歌手 ]
	 * @return [type]        [description]
	 */
	public function classed($type = 1){
		$data["type"] = $type;
		$data["info"] = $this->admin_m->select_info_result("s_class",array("class_type"=>$type));
		$this->layout->view(self::$namespace . "con_classed",$data);
	}
	/**
	 * [栏目的添加和修改]
	 * @param  integer $class_id [栏目id]
	 * @param  integer $is_hide  [是否隐藏 0 显示 1 隐藏]
	 * @return [type]            [description]
	 */
	public function classed_save($class_id=0,$is_hide=-1){
		if($_POST){
			if(empty($class_id)){ //添加操作
				$id = $this->admin_m->save_info("s_class",$_POST);
				self::send_result();
			}else{ //修改操作
				if(empty($_POST["index"])) self::send_error(404,"请勾选需要修改的选项！");

				foreach ($_POST["index"] as $i) {
					$data[$i]["class_id"] 		= $_POST["class_id"][$i];
					$data[$i]["class_name"] 	= $_POST["class_name"][$i];
					$data[$i]["class_order"] 	= $_POST["class_order"][$i];
				}
				if( $this->admin_m->update_batch_info("s_class",$data,"class_id")) self::send_result();
				self::send_error(404,"修改失败");
			}
		}

		//处理get提交显示和隐藏
		$type = isset($_GET["type"]) ? $_GET["type"] : 1;
		$data = array("class_hide"=> !$is_hide*1);//乘以1是为了boolean变成数字
		$where = array("class_id"=>$class_id);
		if($this->admin_m->update_info("s_class",$data,$where)){
			redirect("admin/Content/classed/$type");
		}
	}

	/**
	 * [音乐页面]
	 * @return [type] [description]
	 */
	public function music(){
		$data['classed'] = $this->admin_m->select_info_result('s_class',array('class_type'=>1));
		$this->layout->view(self::$namespace . "con_music",$data);
	}
	/**
	 * [音乐添加和修改页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function music_mod($id=0){
		$data['id'] = $id;
		$data['classed'] = $this->admin_m->select_info_result("s_class",array("class_type"=>1));
		$data['info'] = $this->music_m->get_music_one($id);
		$this->layout->view(self::$namespace . "con_music_mod",$data);
	}
	/**
	 * [ajax 获取音乐信息]
	 * @return [type] [description]
	 */
	public function music_info(){
		$start_record	= get_var_value( 'iDisplayStart' ); 	//从多少条开始查询
		$page_size		= get_var_value( 'iDisplayLength' ); 	//每页显示多少条记录

		$name     = get_var_value('music_name');//查询条件
		$abc	  = get_var_value('abc');//条件
		$class_id  = get_var_value('class_id');//条件

		$where = empty($class_id) ? array() : array("music_classid"=>$class_id);
		empty($abc) ? ("") : ($where["GET_FIRST_PY(music_name)"] = $abc) ;//GET_FIRST_PY是sql中自定义的一个函数，获取第一个拼音
		
		$like = array("music_name"=>$name);
		$data = $this->music_m->get_music_info($start_record,$page_size,$where,$like);
		self::send_dataTable($data[0],$data[1]);
	}
	/**
	 * [音乐添加或修改]
	 * @param  integer $id [音乐id]
	 * @return [type]      [description]
	 */
	public function music_save($id=0,$best=0){
		if($_POST){
			if(empty($_POST['music_id'])){//添加
				$tags = explode_plus(',',$_POST['music_tags']);
				if(count($tags) >5) self::send_error(404,"标签不超过5个");
				
				$_POST['music_addtime'] = date('Y-m-d H:i:s',time());
				if( $this->admin_m->save_info('s_music',$_POST)) self::send_result();
				self::send_error(404,'添加失败');
			}else{//更新
				$id = $_POST['music_id'];
				unset($_POST['music_id']);
				if($this->admin_m->update_info('s_music',$_POST,array('music_id'=>$id))) self::send_result();
				self::send_error(404,"修改失败");
			}
		}

		//GET提交修改推荐等级
		$data = array("music_best"=>$best);
		$where = array("music_id"=>$id);
		if($this->admin_m->update_info('s_music',$data,$where)){
			redirect('admin/Content/music');
		}
	}
	/**
	 * [专辑页面]
	 * @return [type] [description]
	 */
	public function special(){
		$data['classed'] = $this->admin_m->select_info_result('s_class',array("class_type"=>3));
		$this->layout->view(self::$namespace . "con_special",$data);
	}
	/**
	 * [专辑添加和修改页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function special_mod($id=0){
		$data["id"] = $id;
		$data["classed"] = $this->admin_m->select_info_result("s_class",array("class_type"=>3));
		$data["info"] = $this->special_m ->get_special_one($id);
		$this->layout->view(self::$namespace . "con_special_mod",$data);
	}
	public function special_tab(){
		$this->layout->view(self::$namespace . 'con_special_tab');
	}
	/**
	 * [ajax获取专辑信息]
	 * @return [type] [description]
	 */
	public function special_info(){
		$start_record	= get_var_value( 'iDisplayStart' ); 	//从多少条开始查询
		$page_size		= get_var_value( 'iDisplayLength' ); 	//每页显示多少条记录

		$name     = get_var_value('special_name');//查询条件
		$abc	  = get_var_value('abc');//条件
		$class_id  = get_var_value('class_id');//条件

		$where = empty($class_id) ? array() : array("special_classid"=>$class_id);
		empty($abc) ? ("") : ($where["GET_FIRST_PY(special_name)"] = $abc) ;//GET_FIRST_PY是sql中自定义的一个函数，获取第一个拼音
		
		$like = array("special_name"=>$name);
		$data = $this->special_m->get_special_info($start_record,$page_size,$where,$like);
		self::send_dataTable($data[0],$data[1]);
	}
	/**
	 * [专辑添加或修改]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function special_save($id=0){
		if($_POST){
			if(empty($_POST['special_id'])){//增加
				$_POST['special_addtime'] = date('Y-m-d H:i:s',time());
				if($this->admin_m->save_info('s_special',$_POST)) self::send_result();
				self::send_error(404,"添加失败");
			}else{//修改
				$id = $_POST['special_id'];
				unset($_POST['special_id']);
				if($this->admin_m->update_info("s_special",$_POST,array("special_id"=>$id))) self::send_result();
				self::send_error(404,"修改失败");
			}
		}
	}
	/**
	 * [歌手页面]
	 * @return [type] [description]
	 */
	public function singer(){
		$data['classed'] = $this->admin_m->select_info_result('s_class',array("class_type"=>2));
		$this->layout->view(self::$namespace . "con_singer",$data);
	}
	/**
	 * [歌手添加和修改页面]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function singer_mod($id=0){
		$data["id"] = $id;
		$data["classed"] = $this->admin_m->select_info_result("s_class",array("class_type"=>2));
		$data["info"] = $this->admin_m->select_info_row("s_singer",array("singer_id"=>$id));
		$this->layout->view(self::$namespace . "con_singer_mod",$data);
	}
	public function singer_tab(){
		$this->layout->view(self::$namespace . "con_singer_tab");
	}
	/**
	 * [ajax获取歌手信息列表]
	 * @return [type] [description]
	 */
	public function singer_info(){
		$start_record	= get_var_value( 'iDisplayStart' ); 	//从多少条开始查询
		$page_size		= get_var_value( 'iDisplayLength' ); 	//每页显示多少条记录

		$name     = get_var_value('singer_name');//查询条件
		$abc	  = get_var_value('abc');//条件
		$class_id  = get_var_value('class_id');//条件

		$where = empty($class_id) ? array() : array("singer_classid"=>$class_id);
		empty($abc) ? ("") : ($where["GET_FIRST_PY(singer_name)"] = $abc) ;//GET_FIRST_PY是sql中自定义的一个函数，获取第一个拼音
		
		$like = array("singer_name"=>$name);
		$data = $this->singer_m->get_singer_info($start_record,$page_size,$where,$like);
		self::send_dataTable($data[0],$data[1]);
	}
	//歌手添加或修改
	public function singer_save($id=0){
		if($_POST){
			if(empty($_POST["singer_id"])){//增加
				$_POST['singer_addtime'] = date("Y-m-d H:i:s",time());
				if($this->admin_m->save_info('s_singer',$_POST)) self::send_result();
				self::send_error(404,"添加失败");
			}else{								//更新
				$id = $_POST['singer_id'];
				unset($_POST['singer_id']);
				if($this->admin_m->update_info('s_singer',$_POST,array("singer_id"=>$id))) self::send_result();
				self::send_error(404,"修改失败");
			}
		}
	}

	/**
	 * [标签页面]
	 * @param  integer $type [类型 1地域 2曲风 3心情 4歌手 5语言]
	 * @return [type]        [description]
	 */
	public function tag($type=1){
		$data["type"] = $type;
		$data["info"] = $this->admin_m->select_info_result("s_tag",array("tag_type"=>$type));
		$this->layout->view(self::$namespace . "con_tag" ,$data);
	}
	/**
	 * [标签选择列表页面]
	 * @return [type] [description]
	 */
	public function tag_tab(){
		$data['info'] =  $this->tag_m->get_tag_info();
		$this->layout->view(self::$namespace . "con_tag_tab",$data);
	}
	public function tag_save($tag_id=0){
		if($_POST){
			if(empty($tag_id)){//添加操作
				$id = $this->admin_m->save_info("s_tag",$_POST);
				self::send_result();
			}else{//修改操作
				if(empty($_POST["index"])) self::send_error(404,"请勾选需要修改的选项！");

				foreach ($_POST["index"] as $i) {
					$data[$i]["tag_id"] = $_POST["tag_id"][$i];
					$data[$i]["tag_name"] = $_POST["tag_name"][$i];
				}
				if($this->admin_m->update_batch_info("s_tag",$data,"tag_id")) self::send_result();
				self::send_error(404,"修改失败");
			}
		}
	}
}
?>
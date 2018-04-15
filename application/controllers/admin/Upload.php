<?php
/**
* 上传文件
*/
class Upload extends MY_Controller
{
	private static $MUSIC_AUDIO = "./uploads/music/audio/";
	private static $MUSIC_COVER = "./uploads/music/cover/";
	private static $MUSIC_LYRIC = "./uploads/music/lyric/";
	private static $SINGER_COVER = "./uploads/singer/cover/";
	private static $SPECIAL_COVER = "./uploads/special/cover/";
	private static $OHTER = "./uploads/other/";
	
	function __construct(){
		parent::__construct();
	}
	public function do_upload(){
		//注意：普通的表单上传文件不会进入$_POST
		if($_POST){
			$type = isset($_POST["type"]) ? $_POST["type"] : "";
			switch ($type) {
				case 'MUSIC_AUDIO':
					$config['upload_path']      = self::$MUSIC_AUDIO;
			        $config['allowed_types']    = 'mp3|ogg|wav';
					break;
				case 'MUSIC_COVER':
					$config['upload_path']      = self::$MUSIC_COVER;
			        $config['allowed_types']    = 'jpg|jpeg|png';
					break;
				case 'MUSIC_LYRIC':
					$config['upload_path']      = self::$MUSIC_LYRIC;
			        $config['allowed_types']    = 'txt|lrc';
					break;
				case 'SINGER_COVER':
					$config['upload_path']      = self::$SINGER_COVER;
			        $config['allowed_types']    = 'jpg|jpeg|png';
					break;
				case 'SPECIAL_COVER':
					$config['upload_path']      = self::$SPECIAL_COVER;
			        $config['allowed_types']    = 'jpg|jpeg|png';
					break;
				default:
					$config['upload_path']      = self::$OHTER;
			        $config['allowed_types']    = '*';
					break;
			}

			$config['encrypt_name'] = true;
	        $config['max_size']     = 1024*20;
	        $this->load->library('upload',$config);
	        if($this->upload->do_upload('file')){
	        	$data = $this->upload->data();
	        	$data["path"] = $config['upload_path'];
	        	self::send_result($data);
	        }else{
	        	$err = $this->upload->display_errors();
	        	self::send_error(404,$err);
	        }
		}
	}
}
?>
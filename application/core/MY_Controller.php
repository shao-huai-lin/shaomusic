<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Shanghai");


class MY_Controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper("public_functions");//加载公共操作函数
		header('Content-type:text/html;charset=utf-8;');
	}
	/**
	 * [输出成功json]
	 * @param  string  $data [成功的数据]
	 * @param  boolean $bool [是否结束语句执行]
	 * @return [type]        [json]
	 */
	public static function send_result( $data="",$bool = true){//返回JSON
		$obj = array();
		$obj[ 'err_code' ] = '0';
		$obj[ 'err_msg' ] = 'success';
		$obj[ 'data' ] = $data;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
		// die( json_encode( $obj ) );
		if($bool)
		die( json_encode( $obj ) );
		else
		echo json_encode( $obj );
	}
	/**
	 * [输出错误json]
	 * @param  [type]  $number [错误编码]
	 * @param  [type]  $msg    [消息]
	 * @param  boolean $bool   [是否结束语句执行]
	 * @return [type]          [json]
	 */
	public static function send_error( $number = 404 , $msg = "not found" ,$bool = true){
		$obj = array();
		$obj[ 'err_code' ] = intval( $number );
		$obj[ 'err_msg' ] = $msg;
		header('Content-type: application/json');
		header("Access-Control-Allow-Origin: *");
		if($bool)
		die( json_encode( $obj ) );
		else
		echo json_encode( $obj );
	}
	/**
	 * [输出满足jquery.dataTable格式json]
	 * @param  integer $nums [总数量]
	 * @param  array   $data [数据]
	 * @return [type]        [json]
	 */
	public static function send_dataTable($nums = 0,$data = array()){
		$data_arr = array(
			"iTotalRecords"   		=> $nums,
	 		"iTotalDisplayRecords"  => $nums,
			"aaData"=>$data
		);
		die(json_encode($data_arr));
	}
	/**
	 * [返回错误对象]
	 * @param  [type] $err_code [description]
	 * @param  [type] $err_msg  [description]
	 * @return [type]           [description]
	 */
	public static function back_error($err_code,$err_msg)
    {
        $obj = array();
        $obj[ 'err_code' ] = intval($err_code);
        $obj[ 'err_msg' ] = $err_msg;
        return $obj;
    }
    /**
     * [返回成功对象]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function back_result($data)
    {
        $obj = array();
        $obj[ 'err_code' ] = '0';
        $obj[ 'err_msg' ] = 'success';
        $obj[ 'data' ] = $data;
        return $obj;
    }
}

require 'Admin_Controller.php';
require 'Portal_Controller.php';


?>
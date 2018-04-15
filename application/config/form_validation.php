<?php
/**
 * [表单验证规则集合]
 * @var array
 */
$config = array(
	//登录表单验证
	"login" => array(
		array(
	      "field"  =>"username",
	      "rules"  =>"required",
	      "errors" => array(
	      	"required" => "用户名不能为空"
	      )
	    ),
	    array(
	      "field"=>"password",
	      "rules"=>"required",
	      "errors" => array(
	      	"required" => "密码不能为空"
	      )
	    )
	)
);
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo base_url()?>">
		<meta charset="utf-8" />
		<title><?php echo DEFAULT_TITLE;?></title>
		<link rel="stylesheet" href="./public/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./public/mine/css/font-awesome.min.css">
		
		<script src="./public/bootstrap/js/jQuery-2.1.4.min.js"></script>
		<script src="./public/bootstrap/js/bootstrap.min.js"></script>
		<script src="./public/mine/js/sha1.js"></script>
	</head>
	<style type="text/css">
		body{
			background-color: #e5e5e5;
		    overflow-x: hidden;
		    overflow-y: auto;
		    font-family:'微软雅黑';
		}
		.login-box{
			margin:7% auto;
			width: 360px;
			position: relative;
			z-index: 1000;
		}
		.login-logo{
			font-size: 35px;
		    text-align: center;
		    margin-bottom: 25px;
		    font-weight: 300;
		}
		.login-logo .m-title{
			font-family: '微软雅黑';
		    line-height: 1.0;
		    font-size: 32px;
		    letter-spacing: 4px;
		}
		.login-logo .s-title{
			font-family: '微软雅黑';
		    line-height: 1.0;
		    font-size: 20px;
		}
		.login-box-body{
			padding: 20px;
			background-color: #fff;
		}
		.footer{
			position:fixed;
			bottom:0px;
			text-align:center;
			width:100%;
			height: 200px;
			padding-bottom: 20px;
			/*background-image: url("application/themes/bootstrapui/img/img.png");*/
		}
		.footer-content{
			display: flex;
			height: 100%;
			justify-content:flex-end;
			flex-direction: column;
			padding-bottom: 20px;
		}
		.register{
			text-align: center;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.err{
			color:#f00;
		}
	</style>
	<script type="text/javascript">
		function login(){
			var password = $('#pwd').val();
			// $('#pwd').val(hex_sha1(password));
			$('#login_form').submit();	
		}
	</script>	
	<body>
		<div class="login-box">
			<div class="login-logo">
				<h1 class="m-title">后台管理</h1>
			</div>
			<div class="login-box-body">
				<form action="./index.php/admin/Auth/login" method="post" id="login_form">
					<div class="form-group has-feedback">
						<input type="text" name="username" value="<?php echo set_value("username");?>" class="form-control" placeholder="账号">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="err"><?php echo form_error("username");?></span>
					</div>
					<div class="form-group has-feedback">
						<input id="pwd" type="password" name="password" value="" class="form-control" placeholder="密码">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						<span class="err"><?php echo form_error("password");?></span>
					</div>
					<div class="checkbox icheck">	
						<label class="checkbox inline">
							<input type="checkbox" id="inlineCheckbox1" value="option1">记住密码
						</label>
					</div>
					<div>
						<button type="button" onclick="login()" class="btn btn-success btn-block">登录</button>
					</div>
					<div>
						<span class="err"><?php echo $error ?></span>
					</div>
					<div class="register">
						<!-- <span><a href="">没有账号？马上注册</a></span> -->
					</div>
				</form>
			</div>
		</div>
		<div class="footer">
			<div class="footer-content">
				<span style="line-height:1.0;font-size:16px;">www.s.com</span><br>
				<span style="line-height:0.1;letter-spacing:2px;">Copyright ©2018 <?php echo DEFAULT_TITLE ?></span>
			</div>
		</div>
	</body>
</html>
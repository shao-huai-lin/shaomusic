<!DOCTYPE html>
<html>
	<head>
		<title>歌手</title>
		<base href="<?php echo base_url();?>" />
		<meta charset="UTF-8">
		<link rel="stylesheet" href="public/mine/css/portal.style.css" />
		<link rel="stylesheet" href="public/mine/css/font-awesome.min.css" />
	</head>
	<body>
		<div class="g-hd">
			<div class="g-in">
				<div class="m-header">
					<div class="logo">					
						<img src="public/mine/img/luoing.png" />
					</div>
					<ul class="m-nav f-cb">
						<li><a href="index.php/portal/Home">首页</a></li>
						<li><a href="index.php/portal/Home/singer_list">歌手</a></li>
						<li><a href="index.php/portal/Home/bill_list">歌单</a></li>
						<li><a href="javascript:0;">MV</a></li>
					</ul>
					<div class="search">
						<form id="search" action="index.php/portal/Home/search" method="get">
							<div class="u-input u-input-g">
								<input name="name" type="text" />
								<button type="submit"></button>
							</div>
						</form>
					</div>
					<div class="ulink">
						<!--<div class="login">
							<button class="u-btn z-primary">登录</button>
							<button class="u-btn">注册</button>
						</div>-->
						<div class="m-user">
							<div class="cover">							
								<img src="public/mine/img/head.jpg" />
							</div>
							<div class="menu">
								<a href="index.php/portal/User">								
									<div class="cover cover-b">
										<img src="public/mine/img/head.jpg" />
										<strong>米花糖的爱</strong>
									</div>
								</a>
								<a class="logout" href="javascript:0;">退出登录</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="g-bd">
			<?php echo $content_for_layout?>
		</div>
		<div class="g-ft">
			<div class="m-footer">
				<p>
					<a>服务条款</a>
					<span> | </span>
					<a>用户服务协议</a>
					<span> | </span>
					<a>隐私政策</a>
				</p>
				<p>c</p>
				<p>(c) Copyright 2018 Administrator. All Rights Reserved. </p>
			</div>
		</div>
	</body>
</html>
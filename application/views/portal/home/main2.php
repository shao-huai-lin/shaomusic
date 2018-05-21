<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<base href="<?php echo base_url();?>" />
	<meta charset="utf-8" />
	<link rel="stylesheet" href="public/mine/css/portal.style.css" />
	<link rel="stylesheet" href="public/mine/css/font-awesome.min.css" />
	<link rel="stylesheet" href="public/plugins/swiper/swiper-4.2.6.min.css" />
	<script type="application/javascript" src="public/plugins/swiper/swiper-4.2.6.min.js"></script>
</head>
<body>
	<div class="g-hd">
		<div class="g-in">
			<div class="m-header">
				<div class="logo">					
					<img src="public/mine/img/luoing.png" />
				</div>
				<ul class="m-nav f-cb">
					<li><a href="javascript:0;">首页</a></li>
					<li><a href="javascript:0;">歌手</a></li>
					<li><a href="javascript:0;">专辑</a></li>
					<li><a href="javascript:0;">歌单</a></li>
				</ul>
				<div class="search">
					<div class="u-input u-input-g">
						<input type="text" />
						<button></button>
					</div>
				</div>
				<div class="ulink">
					<!--<div class="login">
						<button class="u-btn u-btn-a">登录</button>
						<button class="u-btn">注册</button>
					</div>-->
					<div class="m-user">
						<div class="cover">							
							<img src="public/mine/img/head.jpg" />
						</div>
						<div class="menu">
							<a href="javascript:0;">								
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
		<div class="g-box">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="m-slide">							
							<a href="javascript:0;" style="background-image: url(public/mine/img/bg-0.jpg);"></a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="m-slide">							
							<a href="javascript:0;" style="background-image: url(public/mine/img/bg-1.jpg);"></a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="m-slide">							
							<a href="javascript:0;" style="background-image: url(public/mine/img/bg-2.jpg);"></a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="m-slide">
							<a href="javascript:0;" style="background-image: url(public/mine/img/bg-3.jpg);"></a>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
		<div class="g-in f-cb">
			<div class="g-box g-boxa">
				<div class="m-tle">
					<h1>精选歌单</h1>
					<a class="more">更多</a>
				</div>
				<div class="m-card">
					<div class="bg">
						<img src="public/mine/img/sp-0.jpg" />
					</div>
					<div class="top">
						<i class="fa fa-headphones"></i>
						<span>12万</span>
					</div>
					<div class="but">
						<p>不爱我拉倒</p>
						<p class="singer">周杰伦</p>
					</div>
					<div class="m-shade">
						<button class="play"></button>
					</div>
				</div>
				<div class="m-card m-card-a">
					<div class="bg">
						<img src="public/mine/img/sp-0.jpg" />
						<div class="m-shade">
							<button class="play"></button>
						</div>
					</div>
					<div class="top">
						<i class="fa fa-headphones"></i>
						<span>12万</span>
					</div>
					<div class="but">
						<p>不爱我拉倒</p>
						<p class="singer">周杰伦</p>
					</div>
				</div>
			</div>
			<div class="g-box g-boxb">
				<div class="m-tle">
					<h1>热门榜单</h1>
					<a class="more">更多</a>
				</div>
			</div>
		</div>
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
<script type="application/javascript">
	
	var vm = new Swiper('.swiper-container',{
		slidesPerView:'auto',
		centeredSlides:true,
		mousewheel:true,
		autoplay:true,
		pagination:{
			el:'.swiper-pagination',
			clickable :true,
		}
	});
</script>
</html>
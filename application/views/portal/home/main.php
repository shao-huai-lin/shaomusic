<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<base href="<?php echo base_url();?>" />
	<meta charset="utf-8" />
	<link rel="stylesheet" href="public/mine/css/portal.css" />
	<link rel="stylesheet" href="public/mine/css/font-awesome.min.css" />
	<link rel="stylesheet" href="public/plugins/swiper/swiper-4.2.6.min.css" />
	<script type="application/javascript" src="public/plugins/swiper/swiper-4.2.6.min.js"></script>
</head>
<body>
	<div class="header">
		<div class="h-con">			
			<div class="logo">
				<img src="public/mine/img/luoing.png" />
			</div>
			<ul class="nav">
				<li><a href="#">首页</a></li>
				<li><a href="#">歌手</a></li>
				<li><a href="#">专辑</a></li>
				<li><a href="#">歌单</a></li>
			</ul>
			<div class="search">
				<div class="search-input">
					<input type="text" />
					<button></button>
				</div>
				<div class="search-list"></div>
			</div>
			<div class="user-wrap">
				<div class="login-in">
					<a class="login-btn" href="#">登录</a>
					<a class="regin-btn" href="#">注册</a>
				</div>
				<div class="user"></div>
				<div class="user-menu"></div>
			</div>
		</div>
	</div>
	<div class="sliderWrap">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<a class="slider-box" href="javascript:0;" style="background-image: url(public/mine/img/bg-0.jpg);"></a>
				</div>
				<div class="swiper-slide">
					<a class="slider-box" href="javascript:0;" style="background-image: url(public/mine/img/bg-1.jpg);"></a>
				</div>
				<div class="swiper-slide">
					<a class="slider-box" href="javascript:0;" style="background-image: url(public/mine/img/bg-2.jpg);"></a>
				</div>
				<div class="swiper-slide">
					<a class="slider-box" href="javascript:0;" style="background-image: url(public/mine/img/bg-3.jpg);"></a>
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<div class="i-wrap">
		<div class="i-box song-wrap">
			<div class="box-title">
				<h1 class="t-msg">精选歌单</h1>
				<a class="t-more">更多</a>
			</div>
			<div class="box-con">
				<div class="songs hot">
					<img class="songs-bg" src="public/mine/img/sp-0.jpg" />
					<div class="songs-top">
						<i class="fa fa-headphones"></i>
						<span>123万</span>
					</div>
					<div class="songs-but">
						<p class="mood">你若安好，便是晴天</p>
						<p class="author">掏蛋蛋的小哥</p>
					</div>
					<a class="songs-shade">
						<button class="play-btn"></button>
					</a>
				</div>
				<ul class="songs-ul">
					<li>
						<div class="songs">
							<img class="songs-bg" src="public/mine/img/sp-0.jpg" />
							<div class="songs-top">
								<i class="fa fa-headphones"></i>
								<span>123万</span>
							</div>
							<div class="songs-but">
								<p class="mood">你若安好，便是晴天你若安好，便是晴天你若安好，便是晴天</p>
								<p class="author">掏蛋蛋的小哥</p>
							</div>
							<a class="songs-shade" title="你若安好，便是晴天你若安好，便是晴天你若安好，便是晴天">
								<button class="play-btn"></button>
							</a>
						</div>
					</li>
					<li>
						<div class="songs">
							<img class="songs-bg" src="public/mine/img/sp-0.jpg" />
							<div class="songs-top">
								<i class="fa fa-headphones"></i>
								<span>123万</span>
							</div>
							<div class="songs-but">
								<p class="mood">你若安好，便是晴天</p>
								<p class="author">掏蛋蛋的小哥</p>
							</div>
							<a class="songs-shade" title="你若安好，便是晴天">
								<button class="play-btn"></button>
							</a>
						</div>
					</li>
					<li>
						<div class="songs">
							<img class="songs-bg" src="public/mine/img/sp-0.jpg" />
							<div class="songs-top">
								<i class="fa fa-headphones"></i>
								<span>123万</span>
							</div>
							<div class="songs-but">
								<p class="mood">你若安好，便是晴天</p>
								<p class="author">掏蛋蛋的小哥</p>
							</div>
							<a class="songs-shade" title="你若安好，便是晴天">
								<button class="play-btn"></button>
							</a>
						</div>
					</li>
					<li>
						<div class="songs">
							<img class="songs-bg" src="public/mine/img/sp-0.jpg" />
							<div class="songs-top">
								<i class="fa fa-headphones"></i>
								<span>123万</span>
							</div>
							<div class="songs-but">
								<p class="mood">你若安好，便是晴天</p>
								<p class="author">掏蛋蛋的小哥</p>
							</div>
							<a class="songs-shade" title="你若安好，便是晴天">
								<button class="play-btn"></button>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="i-box list-wrap">
			<div class="box-title">
				<h1 class="t-msg">热门榜单</h1>
				<a class="t-more">更多</a>
			</div>
			<div class="box-con">
				<a href="javascript:0;">					
					<div class="rank">
						<div class="rank-cover rage-cover">
							<p>巅峰榜</p>
							<p>流行指数</p>
							<div class="shade">
								<button class="play-btn"></button>
							</div>
						</div>
						<div class="rank-arrow"></div>
						<div class="rank-info">						
							<p>1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒</p>
							<p>2.电流女侠-9277</p>
							<p class="">3.周杰伦-青花瓷</p>
						</div>
					</div>
				</a>
				<a href="javascript:0;">					
					<div class="rank rank-mg">
						<div class="rank-cover hot-cover">
							<p>巅峰榜</p>
							<p>热歌</p>
							<div class="shade">
								<button class="play-btn"></button>
							</div>
						</div>
						<div class="rank-arrow"></div>
						<div class="rank-info">						
							<p>1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒</p>
							<p>2.电流女侠-9277</p>
							<p class="">3.周杰伦-青花瓷</p>
						</div>
					</div>
				</a>
				<a href="javascript:0;">					
					<div class="rank">
						<div class="rank-cover new-cover">
							<p>巅峰榜</p>
							<p>新歌</p>
							<div class="shade">
								<button class="play-btn"></button>
							</div>
						</div>
						<div class="rank-arrow"></div>
						<div class="rank-info">						
							<p>1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒1.周杰伦-不爱我拉倒</p>
							<p>2.电流女侠-9277</p>
							<p class="">3.周杰伦-青花瓷</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<div class="i-wrap">
		<div class="i-box song-wrap">
			<div class="box-title t-bor">
				<h1 class="t-msg">新歌首发</h1>
				<a class="t-play">播放全部</a>
			</div>
			<div class="box-con">
				<div class="tab-wrap">
					<ul>
						<li>
							<a href="javascript:0;">
								<span>金志文&nbsp;-&nbsp;热血篮球</span>
								<span class="fitst"></span>
								<span class="down"></span>
								<span class="time">04:12</span>
							</a>
						</li>
						<li>
							<a href="javascript:0;">
								<span>袁娅维、Kehlani - Just My Luck</span>
								<span class="fitst"></span>
								<span class="down"></span>
								<span class="time">04:12</span>
							</a>
						</li>
						<li>
							<a href="javascript:0;">
								<span>薛之谦 - 肆无忌惮</span>
								<span class="fitst"></span>
								<span class="down"></span>
								<span class="time">04:12</span>
							</a>
						</li>
						<li>
							<a href="javascript:0;">
								<span>周杰伦 - 不爱我就拉倒</span>
								<span class="down"></span>
								<span class="time">04:12</span>
							</a>
						</li>
						<li>
							<a href="javascript:0;">
								<span>熊梓淇 - KO</span>
								<span class="down"></span>
								<span class="time">04:12</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="pages">
					<a class="prev disable">上一页</a>
					<span class="page">1/3</span>
					<a class="next">下一页</a>
				</div>
			</div>
		</div>
		
		<div class="i-box list-wrap">
			<div class="box-title">
				<h1 class="t-msg">MV</h1>
				<a class="t-more">更多</a>
			</div>
			<div class="box-con">
				<div class="video v-big">
					<div class="video-bg">						
						<img src="public/mine/img/sp-0.jpg" />
						<a class="shade">
							<button class="play-btn"></button>
						</a>
					</div>
					<div class="video-but">
						<p>不爱我就拉倒</p>
						<p class="singer">周杰伦</p>
					</div>
				</div>
				<div class="video">
					<div class="video-bg">						
						<img src="public/mine/img/sp-0.jpg" />
						<a class="shade">
							<button class="play-btn"></button>
						</a>
					</div>
					<div class="video-but">
						<p>不爱我就拉倒</p>
						<p class="singer">周杰伦</p>
					</div>
				</div>
				<div class="video">
					<div class="video-bg">						
						<img src="public/mine/img/sp-0.jpg" />
						<a class="shade">
							<button class="play-btn"></button>
						</a>
					</div>
					<div class="video-but">
						<p>不爱我就拉倒</p>
						<p class="singer">周杰伦</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer">
		<div class="footer-item">		
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
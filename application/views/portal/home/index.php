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
	<div class="g-box g-box-fl f-w660">
		<div class="m-songs">
			<div class="u-tle">
				<h1>精选歌单</h1>
				<a class="more">更多</a>
			</div>
			<div class="info">
				<div class="big">
					<div class="u-card">
						<div class="bg">
							<img src="<?php echo $info[0]['cover']?>" />
						</div>
						<div class="top">
							<i class="fa fa-headphones"></i>
							<span><?php echo $info[0]['num']?>万</span>
						</div>
						<div class="but">
							<p><?php echo $info[0]['title']?></p>
							<p class="singer"><?php echo $info[0]['author']?></p>
						</div>
						<div class="u-shade z-hide">
							<button class="play z-rb"></button>
						</div>
					</div>
				</div>
				<ul class="sm">
					<?php foreach(range(1, 4) as $i):?>
					<li>
						<div class="u-card">
							<div class="bg">
								<img src="<?php echo $info[$i]['cover']?>" />
							</div>
							<div class="top">
								<i class="fa fa-headphones"></i>
								<span><?php echo $info[$i]['num']?></span>
							</div>
							<div class="but">
								<p><?php echo $info[$i]['title']?></p>
								<p class="singer"><?php echo $info[$i]['author']?></p>
							</div>
							<div class="u-shade z-hide">
								<button class="play z-rb"></button>
							</div>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<!--<div class="u-card u-card-a">
			<div class="bg">
				<img src="public/mine/img/sp-0.jpg" />
				<div class="u-shade">
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
		</div>-->
	</div>
	<div class="g-box g-box-fr f-w330">
		<div class="m-bang">
			<div class="u-tle">
				<h1>热门榜单</h1>
				<a class="more">更多</a>
			</div>
			<ul class="f-cb">
				<li>
					<a href="javascript:0;">
						<div class="u-card2">
							<div class="bg">
								<p>巅峰榜</p>
								<p>流行指数</p>
								<div class="u-shade z-hide">
									<button class="play"></button>
								</div>
							</div>
							<div class="info">
								<p>1.歌曲歌曲歌曲歌曲歌曲歌曲歌曲歌曲歌曲</p>
								<p>1.歌曲</p>
								<p>1.歌曲</p>
							</div>
							<div class="arrow"></div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript:0;">						
						<div class="u-card2">
							<div class="bg bg-2">
								<p>巅峰榜</p>
								<p>流行指数</p>
								<div class="u-shade z-hide">
									<button class="play"></button>
								</div>
							</div>
							<div class="info">
								<p>1.歌曲</p>
								<p>1.歌曲</p>
								<p>1.歌曲</p>
							</div>
							<div class="arrow"></div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript:0;">						
						<div class="u-card2">
							<div class="bg bg-3">
								<p>巅峰榜</p>
								<p>流行指数</p>
								<div class="u-shade z-hide">
									<button class="play"></button>
								</div>
							</div>
							<div class="info">
								<p>1.歌曲</p>
								<p>1.歌曲</p>
								<p>1.歌曲</p>
							</div>
							<div class="arrow"></div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="g-box g-box-fl f-w660">
		<div class="m-firstsong">
			<div class="u-tle">
				<h1>新歌首发</h1>
				<a class="more">更多</a>
			</div>
			<div class="info">						
				<div class="u-list">
					<table>
						<!--<thead>
							<tr>
								<th class="check"></th>
								<th class="name"><p>歌名</p></th>
								<th class="operate"></th>
								<th class="special"><p>专辑</p></th>
								<th class="time"><p>时长</p></th>
							</tr>
						</thead>-->
						<thead class="z-hide">
							<tr>
								<th class="check"></th>
								<th class="name"></th>
								<th class="operate"></th>
								<th class="special"></th>
								<th class="time"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach(range(0,10) as $v):?>
							<tr>
								<td><input type="checkbox"/></td>
								<td><p>爱我别走_<?php echo $v?><span class="u-tips"></span></p></td>
								<td>
									<a class="play" href="javascript:0;"></a>
									<a class="down" href="javascript:0;"></a>
								</td>
								<td><p>经典老歌经典老歌经典老歌经典老歌</p></td>
								<td>04：33</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="f-mt10"></div>
		<div class="u-page2">
			<a class="prev disable">上一页</a>
			<a class="p">1/3</a>
			<a class="next">下一页</a>
		</div>
	</div>
	<div class="g-box g-box-fr f-w330">
		<div class="m-firstmv">
			<div class="u-tle">
				<h1>推荐mv</h1>
				<a class="more">更多</a>
			</div>
			<div class="big">
				<div class="u-card">
					<div class="bg">
						<img src="public/mine/img/sp-0.jpg" />
						<div class="u-shade z-hide">
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
			<ul>
				<li>
					<div class="u-card u-card-a">
						<div class="bg">
							<img src="public/mine/img/sp-0.jpg" />
							<div class="u-shade z-hide">
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
				</li>
				<li>
					<div class="u-card u-card-a">
						<div class="bg">
							<img src="public/mine/img/sp-0.jpg" />
							<div class="u-shade z-hide">
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
				</li>
			</ul>
		</div>
	</div>
</div>
<link rel="stylesheet" href="public/plugins/swiper/swiper-4.2.6.min.css" />
<script type="application/javascript" src="public/plugins/swiper/swiper-4.2.6.min.js"></script>
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
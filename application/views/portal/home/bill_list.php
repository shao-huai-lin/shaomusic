<p class="f-mt20"></p>
<div class="g-in f-cb">
	<div class="g-sd1">
		<div class="m-sidebar m-sidebar-a">
			<ul class="gr1">
				<li><a class="active" href="javascript:0;">全部歌手</a></li>
				<li><a href="javascript:0;">华语男歌手</a></li>
				<li><a href="javascript:0;">华语女歌手</a></li>
				<li><a href="javascript:0;">华语组合</a></li>
			</ul>
		</div>
		<div class="u-hbor"></div>
	</div>
	<div class="g-mn1">
		<div class="g-mn1c">
			<div class="m-singer f-bl">
				<ul class="info f-cb">
					<?php foreach(range(0,14) as $v):?>
					<li class="z-lg">
						<div class="u-card3 u-card3-a">
							<div class="bg">
								<img src="public/mine/img/head.jpg" />
								<p class="num">12万</p>
								<div class="u-shade z-hide">
									<button class="play"></button>
								</div>
							</div>
							<a href="index.php/portal/Home/bill" class="mood"><?php if(($v+1) % 4 == 0) echo '全是回忆'; else echo '全是回忆|那些年火到不行的校园情歌,还记得年少时的梦想'?></a>
							<a class="name">安多</a>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="u-page">
				<a class="active" href="javascript:0;">首页</a>
				<a href="javascript:0;">上一页</a>
				<a href="javascript:0;">1</a>
				<a href="javascript:0;">2</a>
				<a href="javascript:0;">3</a>
				<a href="javascript:0;">4</a>
				<a href="javascript:0;">5</a>
				<a href="javascript:0;">下一页</a>
				<a href="javascript:0;">尾页</a>
			</div>
			<div class="f-mt20"></div>
		</div>
	</div>
	
</div>
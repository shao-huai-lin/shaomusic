<!--<p class="f-mt20"></p>-->
<div class="m-search">
	<div class="info">		
		<form id="search" action="index.php/portal/Home/search" method="get">
			<div class="u-input u-input-g">
				<input name="name" type="text" />
				<button type="submit"></button>
			</div>
		</form>
	</div>
</div>
<div class="g-in f-cb">
	<div class="m-tab">
		<div class="tab">
			<a href="javascript:0;">歌曲</a>
			<a class="active" href="javascript:0;">专辑</a>
			<a href="javascript:0;">MV</a>
		</div>
		<p class="msg">为你找到<span>3429</span>首歌曲</p>
		<div class="info"></div>
	</div>
	<!--<div class="f-bd0 m-singer m-singer-a ">
		<ul class="info f-cb">
			<?php foreach(range(0,14) as $v):?>
			<li>
				<div class="u-card3 u-card3-a">
					<div class="bg">
						<img src="public/mine/img/head.jpg" />
						<p class="num">12万</p>
						<div class="u-shade">
							<button class="play"></button>
						</div>
					</div>
					<a class="mood"><?php if(($v+1) % 4 == 0) echo '全是回忆'; else echo '全是回忆|那些年火到不行的校园情歌,还记得年少时的梦想'?></a>
					<a class="name">安多</a>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>-->
	<div class="u-list z-lg">
		<table>
			<thead>
				<tr>
					<th class="check"></th>
					<th class="name"><p>歌名</p></th>
					<th class="special"><p>专辑</p></th>
					<th class="operate"></th>
					<th class="time"><p>时长</p></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach(range(0,10) as $v):?>
				<tr>
					<td><input type="checkbox"/></td>
					<td><p>爱我别走_<?php echo $v?><span class="u-tips"></span></p></td>
					<td><p>经典老歌经典老歌经典老歌经典老歌</p></td>
					<td>
						<a class="play" href="javascript:0;"></a>
						<a class="down" href="javascript:0;"></a>
					</td>
					<td>04：33</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
	<div class="f-mt20"></div>
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
<script>
//	$(function(){
//		$("#search input").val("www");
//	});
</script>
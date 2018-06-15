<div class="f-mt20"></div>
<div class="g-in">
	<div class="u-card4">
		<div class="bg">
			<img src="public/mine/img/head.jpg" />
		</div>
		<div class="info">
			<h1>张惠妹</h1>
			<p>基本信息：</p>
			<p>基本信息：</p>
			<p>基本信息：</p>
			<p>基本信息：</p>
			<p class="but">台湾</p>
		</div>
	</div>
	<!--<div class="f-mt20"></div>-->
	<div class="m-tab">
		<div class="tab">
			<a class="active" href="#tab1">我喜欢</a>
			<a href="#tab2">我创建的歌单</a>
			<a href="#tab1">关注</a>
			<a href="#tab2">粉丝</a>
			<a href="javascript:0;">我上传的视频</a>
		</div>
		<div class="info">
			<div id="tab1" class="item active">
				<div class="stab">
					<a class="u-btn z-link z-lg active" href="#tab1_1">歌曲（23）</a>
					<a class="u-btn z-link z-lg" href="#tab1_2">歌单（2）</a>
				</div>
				<div class="f-mt10"></div>
				<div id="sinfo">
					<div id="tab1_1" class="sitem active">
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
					<div id="tab1_2" class="sitem">
						<div class="m-singer">
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
			<div id="tab2" class="item">
				<a id="create" class="u-btn z-lg">创建歌单</a>
				<div class="f-mt10"></div>
				<div class="m-singer">
					<ul class="info f-cb">
						<?php foreach($songlist as $v):?>
						<li class="z-lg">
							<div class="u-card3 u-card3-a">
								<div class="bg">
									<img src="public/mine/img/head.jpg" />
									<p class="num">12万</p>
									<div class="u-shade z-hide">
										<button class="play"></button>
									</div>
								</div>
								<a href="index.php/portal/Home/bill" class="mood"><?php echo $v['list_title']?></a>
								<a class="name"><?php echo $v['user_nick']?></a>
							</div>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
				<div id="alert" class="m-alert" style="display: none;">
					<div class="shade"></div>
					<div class="win">
						<a class="close">关闭</a>
						<h1>标题</h1>
						<form id="songform">
							<div class="info">
								<input type="text" name="title">
							</div>
							<div class="btns">
								<button id="no" type="button">取消</button>
								<button id="yes" type="submit">确定</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="application/javascript" src="public/bootstrap/js/jQuery-2.1.4.min.js"></script>
<script src="public/plugins/form/jquery.form.js"></script>
<script>
	window.onload = function(){
		var show = function(that,e){
			e.preventDefault();
			$(that).parent().children().removeClass("active");
			$(that).addClass("active");
			var href = $(that).attr('href');
			$(href).parent().children().removeClass("active");
			$(href).addClass("active");
		}
		$(".m-tab .tab a").click(function(e){
			show(this,e);
		});
		$(".m-tab .stab a").click(function(e){show(this,e);});

		//创建歌单按钮
		$('#create').click(function(){
			$('#alert').show();
		});
		//取消按钮
		$('#no').click(function(){
			$('#alert').hide();
		});
		//创建歌单表单提交
		$('#songform').submit(function(){
			$('#songform').ajaxSubmit({
				type:"POST",
				url:"index.php/portal/User/ajax_c_songlist",
				dataType:"json",
				success:function(result){
					console.log(result);
					document.location = 'index.php/portal/User';
				},
				error:function(){

				}
			});
			return false;
		});
	}
</script>
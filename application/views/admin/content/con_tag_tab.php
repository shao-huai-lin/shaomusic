<div class="row">
	<div class="col-sm-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title" style="position: relative;">
				选择添加的标签
				<button id="make_btn" class="btn" style="position: absolute;top:5px;right: 0px;margin-right: 10px;">确定</button>
			</div>
			<div class="ibox-content con-pad-sm">
				<div id="chosen">
					
				</div>
			</div>
			<?php // $info[1] 地域 $info[2] 曲风 $info[3] 心情 $info[4] 歌手 $info[5] 语言?>
			<div class="ibox-content con-pad-sm">
				<div class="panel panel-info">
				  	<div class="panel-heading">地域</div>
				  	<div class="panel-body">
				    	<div class="col-sm-2"></div>
				    	<div class="col-sm-8" style="line-height: 2rem;">
							<?php if(isset($info[1])):?>
								<?php foreach($info[1] as $v):?>
									<a href="javascript:0;">
							    		<span class="label label-default" data-val="<?php echo $v['tag_id'];?>"> <?php echo $v['tag_name'];?></span>
							    	</a>
								<?php endforeach;?>	
							<?php endif;?>
				    	</div>
				    	<div class="col-sm-2"></div>
				  	</div>
				</div>
				<div class="panel panel-primary">
				  	<div class="panel-heading">曲风</div>
				  	<div class="panel-body">
				    	<div class="col-sm-2"></div>
				    	<div class="col-sm-8" style="line-height: 2rem;">
							<?php if(isset($info[2])):?>
								<?php foreach($info[2] as $v):?>
									<a href="javascript:0;">
							    		<span class="label label-default" data-val="<?php echo $v['tag_id'];?>"> <?php echo $v['tag_name'];?></span>
							    	</a>
								<?php endforeach;?>	
							<?php endif;?>
				    	</div>
				    	<div class="col-sm-2"></div>
				  	</div>
				</div>
				<div class="panel panel-info">
				  	<div class="panel-heading">心情</div>
				  	<div class="panel-body">
				    	<div class="col-sm-2"></div>
				    	<div class="col-sm-8" style="line-height: 2rem;">
							<?php if(isset($info[3])):?>
								<?php foreach($info[3] as $v):?>
									<a href="javascript:0;">
							    		<span class="label label-default" data-val="<?php echo $v['tag_id'];?>"> <?php echo $v['tag_name'];?></span>
							    	</a>
								<?php endforeach;?>	
							<?php endif;?>
				    	</div>
				    	<div class="col-sm-2"></div>
				  	</div>
				</div>
				<div class="panel panel-primary">
				  	<div class="panel-heading">歌手</div>
				  	<div class="panel-body">
				    	<div class="col-sm-2"></div>
				    	<div class="col-sm-8" style="line-height: 2rem;">
							<?php if(isset($info[4])):?>
								<?php foreach($info[4] as $v):?>
									<a href="javascript:0;">
							    		<span class="label label-default" data-val="<?php echo $v['tag_id'];?>"> <?php echo $v['tag_name'];?></span>
							    	</a>
								<?php endforeach;?>	
							<?php endif;?>
				    	</div>
				    	<div class="col-sm-2"></div>
				  	</div>
				</div>
				<div class="panel panel-info">
				  	<div class="panel-heading">语言</div>
				  	<div class="panel-body">
				    	<div class="col-sm-2"></div>
				    	<div class="col-sm-8" style="line-height: 2rem;">
							<?php if(isset($info[5])):?>
								<?php foreach($info[5] as $v):?>
									<a href="javascript:0;">
							    		<span class="label label-default" data-val="<?php echo $v['tag_id'];?>"> <?php echo $v['tag_name'];?></span>
							    	</a>
								<?php endforeach;?>	
							<?php endif;?>
				    	</div>
				    	<div class="col-sm-2"></div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	//
	$("#make_btn").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		if($("#chosen .tag").length >0){
			var val = "";
			$("#chosen .tag").each(function(){
				val += $(this).find(".tag-con").text() + ",";
			});
			parent.$("input[name='music_tags']").val(val);
			parent.layer.close(index);
		} 
	});

	var tag = '<div class="tag" data-val="{0}">'
			    +'<a class="tag-con" href="javascript:0;">{1}</a>'
                +    '<span class="tag-shut"></span>'
                +'</div>';

    //
    function is_tag(id){
    	var boo = false;
    	$("#chosen .tag").each(function(){
    		if($(this).attr("data-val") == id){
    			boo = true;
    		}
    	});
    	return boo;
    }
    function is_full(){
    	return $("#chosen .tag").length >= 5;
    }
    function add_tag(id,name){
    	var html = tag.format(id,name);
    	$("#chosen").append(html);
    }
    function del_tag(id){
    	$("#chosen .tag").each(function(){
    		if($(this).attr("data-val") == id){
    			$(this).remove();
    		}
    	});
    }
	$(".label").click(function(){
		var id = $(this).attr("data-val");
		var name = $(this).text();
		if( ! is_tag(id)){
			if(is_full()) return;
			add_tag(id,name);
		}else{
			del_tag(id);
		}
		$(this).toggleClass("label-primary");
	});
	$("#chosen").on("click",".tag-shut",function(){
		var id = $(this).parent().attr("data-val");
		$(this).parent().remove();
		$(".label").each(function(){
			var mid = $(this).attr("data-val");
			if(mid == id){
				$(this).toggleClass("label-primary");
				return false;
			}
		});
	});
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($id)):?>编辑<?php else:?>添加<?php endif;?>歌手</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/Content/singer'">所有歌手</button>
            	<button class="btn <?php if(empty($id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/singer_mod'">新增歌手</button>
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
             		<input type="hidden" id="singer_id" name="singer_id" value="<?php if(!empty($id)) echo $id;?>"  /> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">所属栏目</label>
                        <div class="col-sm-8">
                        	<select name="singer_classid" class="form-control" required>
								<option value="">选择栏目</option>
							  	<?php foreach($classed as $v):?>
								<option <?php if(isset($info['singer_classid']) && $info['singer_classid'] == $v['class_id']):?>selected="selected "<?php endif;?> value="<?php echo $v['class_id'];?>"> <?php echo $v['class_name'];?></option>
							  	<?php endforeach;?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">歌手名</label>
                        <div class="col-sm-8">
                        	<input name="singer_name" type="text" value="<?php if(isset($info['singer_name'])) echo $info['singer_name'];?>" class="form-control" placeholder="歌手名" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">艺名</label>
                        <div class="col-sm-8">
                        	<input name="singer_nick" type="text" value="<?php if(isset($info['singer_nick'])) echo $info['singer_nick'];?>" class="form-control" placeholder="艺名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">国籍</label>
                        <div class="col-sm-8">
                        	<input name="singer_nation" type="text" value="<?php if(isset($info['singer_nation'])) echo $info['singer_nation'];?>" class="form-control" placeholder="国籍">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">职业</label>
                        <div class="col-sm-8">
                        	 <input name="singer_occup" type="text" value="<?php if(isset($info['singer_occup'])) echo $info['singer_occup'];?>" class="form-control" placeholder="职业">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">封面</label>
                        <div class="col-sm-8">
                        	<input id="singer_cover" type="hidden" name="singer_cover" value="<?php if(isset($info['singer_cover'])) echo $info['singer_cover'];?>">
                        	<button id="upload_btn" class="btn btn-primary btn-sm" type="button">上传封面</button>
                        	<span id="size_box"></span>
                        	<span id="msg_box"></span>
                        	<div id="bar_box" class="progress progress-sm" style="display: none;">
								<div id="bar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							    	0%
							  	</div>
							</div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-3 control-label"></label>
                    	<div class="col-sm-8">
                        	<img id="img_item" src="<?php if(isset($info['singer_cover'])) echo $info['singer_cover'];?>" width="100px">
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">介绍</label>
                        <div class="col-sm-8">
                        	<textarea name="singer_intro" class="form-control" rows="5"><?php if(isset($info['singer_intro'])) echo $info['singer_intro'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                            <button class="btn btn-default" onclick="history.go(-1);" type="button">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./public/plugins/validate/jquery.validate.min.js"></script>
<script src="./public/plugins/validate/messages_zh.min.js"></script>
<script src="./public/plugins/validate/common_config.js"></script>
<script src="./public/plugins/form/jquery.form.js"></script>
<script src="./public/plugins/upload/SimpleAjaxUploader.js"></script>
<script type="text/javascript">
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"./index.php/admin/Content/singer_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        var msg = "<?php if(!empty($id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.msg(msg,{time:1000});
                        document.location = "index.php/admin/Content/singer";
                    }else{
                        // swal(result["err_msg"]);
                        layer.msg(result["err_msg"],{icon:5});
                    }
                },
                error:function(){

                }
            });
            return false;
        }
    });

    //上传文件
    $(function(){
    	var sizeBox 	= document.getElementById('size_box'),
    		msgBox		= document.getElementById('msg_box'),
    		imgItem 	= document.getElementById('img_item'),
			barBox 		= document.getElementById('bar_box'),
			bar 		= document.getElementById('bar');

		var uploader = new ss.SimpleUpload({
		    button: 'upload_btn',
		    url: 'index.php/admin/Upload/do_upload',
		    name: 'file',
		    data:{type:"SINGER_COVER"},
		    responseType: 'json',
		    allowedExtensions: ['jpg','jpeg','png'],
		    maxSize: 1024*20,
		    hoverClass: 'ui-state-hover',
		    focusClass: 'ui-state-focus',
		    disabledClass: 'ui-state-disabled',
		    onSubmit: function(filename,ex) {
		    	barBox.style.display = "block";
		        this.setFileSizeBox(sizeBox); // designate this element as file size container
		        this.setProgressBar(bar); // designate as progress bar
		    },         
		    onComplete: function(filename,result) {
		        setTimeout(function(){
			        barBox.style.display = "none";
			        bar.style.width = "0%";
		        },1000);

		        if( ! parseInt(result["err_code"])){
		        	var data = result["data"];
		        	$("#singer_cover").val(data.path + data.file_name);
		        	imgItem.src = data.path + data.file_name;
		        }else{
		        	msgBox.innerHTML = result["err_msg"];
		        }
		    }
		});   
    });
</script>
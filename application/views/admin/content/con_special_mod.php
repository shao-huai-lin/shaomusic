<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($id)):?>编辑<?php else:?>添加<?php endif;?>专辑</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/Content/special'">所有专辑</button>
            	<button class="btn <?php if(empty($id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/special_mod'">新增专辑</button>
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
             		<input type="hidden" id="special_id" name="special_id" value="<?php if(!empty($id)) echo $id;?>"  /> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">所属栏目</label>
                        <div class="col-sm-8">
                        	<select name="special_classid" class="form-control" required>
								<option value="">选择栏目</option>
							  	<?php foreach($classed as $v):?>
								<option <?php if(isset($info['special_classid']) && $info['special_classid'] == $v['class_id']):?>selected="selected "<?php endif;?> value="<?php echo $v['class_id'];?>"> <?php echo $v['class_name'];?></option>
							  	<?php endforeach;?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">所属歌手</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="singer_id" name="special_singerid" value="<?php echo empty($info['special_singerid']) ? 0 : $info['special_singerid']; ?>">
                            <a class="btn btn-plus" id="add_singer_btn" href="javascript:0;">
                                <?php if( ! empty($info['special_singerid'])):?>
                                    <img src="<?php echo $info['singer_cover'];?>" width="30px">
                                    <span><?php echo $info['singer_name']?></span>
                                <?php else:?>
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>选择</span>
                                <?php endif;?>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">专辑名</label>
                        <div class="col-sm-8">
                        	<input name="special_name" type="text" value="<?php if(isset($info['special_name'])) echo $info['special_name'];?>" class="form-control" placeholder="专辑名" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">封面</label>
                        <div class="col-sm-8">
                        	<input id="special_cover" type="hidden" name="special_cover" value="<?php if(isset($info['special_cover'])) echo $info['special_cover'];?>">
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
                        	<img id="img_item" src="<?php if(isset($info['special_cover'])) echo $info['special_cover'];?>" width="100px">
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">发行商</label>
                        <div class="col-sm-8">
                            <input name="special_firm" type="text" value="<?php if(isset($info['special_firm'])) echo $info['special_firm'];?>" class="form-control" placeholder="发行商">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">语言</label>
                        <div class="col-sm-8">
                            <input name="special_lang" type="text" value="<?php if(isset($info['special_lang'])) echo $info['special_lang'];?>" class="form-control" placeholder="语言">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">介绍</label>
                        <div class="col-sm-8">
                        	<textarea name="special_intro" class="form-control" rows="5"><?php if(isset($info['special_intro'])) echo $info['special_intro'];?></textarea>
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
    //添加歌手
    $("#add_singer_btn").click(function(){
        layer.open({
            type:2,
            title:'选择歌手',
            maxmin:true,
            area:['60%','80%'],
            content:'index.php/admin/Content/singer_tab'
        });
    });
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"./index.php/admin/Content/special_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        var msg = "<?php if(!empty($id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.msg(msg,{time:1000});
                        document.location = "index.php/admin/Content/special";
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
		    data:{type:"SPECIAL_COVER"},
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
		        	$("#special_cover").val(data.path + data.file_name);
		        	imgItem.src = data.path + data.file_name;
		        }else{
		        	msgBox.innerHTML = result["err_msg"];
		        }
		    }
		});   
    });
</script>
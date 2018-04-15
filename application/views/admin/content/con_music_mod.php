<?php
    $regex = function($val){
        return preg_match("/\/[a-zA-Z0-9]*\.[a-zA-Z0-9]*$/i",$val,$m) ? $m[0] : "";
    }
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($id)):?>编辑<?php else:?>添加<?php endif;?>音乐</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/Content/music'">所有音乐</button>
            	<button class="btn <?php if(empty($id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/music_mod'">新增音乐</button>                
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
             		<input type="hidden" id="music_id" name="music_id" value="<?php if(!empty($id)) echo $id;?>"  /> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">所属栏目</label>
                        <div class="col-sm-8">
                        	<select name="music_classid" class="form-control" required>
								<option value="">选择栏目</option>
							  	<?php foreach($classed as $v):?>
								<option <?php if(isset($info['music_classid']) && $info['music_classid'] == $v['class_id']):?>selected="selected "<?php endif;?> value="<?php echo $v['class_id'];?>"> <?php echo $v['class_name'];?></option>
							  	<?php endforeach;?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">所属歌手</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="singer_id" name="music_singerid" value="<?php echo empty($info['music_singerid']) ? 0 : $info['music_singerid']; ?>">
                            <a class="btn btn-plus" id="add_singer_btn" href="javascript:0;">
                                <?php if( ! empty($info['music_singerid'])):?>
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
                        <label class="col-sm-3 control-label">所属专辑</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="special_id" name="music_specialid" value="<?php echo empty($info['music_specialid']) ? 0 : $info['music_specialid']; ?>">
                            <a class="btn btn-plus" id="add_special_btn" href="javascript:0;">
                                <?php if( ! empty($info['music_specialid'])):?>
                                    <img src="<?php echo $info['special_cover'];?>" width="30px">
                                    <span><?php echo $info['special_name']?></span>
                                <?php else:?>
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>选择</span>
                                <?php endif;?>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">推荐等级</label>
                        <div class="col-sm-8">
                            <div id="star"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">标签（最多五个）</label>
                        <div class="col-sm-6">
                            <input type="text" name="music_tags" value="<?php if(isset($info['music_tags'])) echo $info['music_tags'];?>" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-plus" id="add_tag_btn" href="javascript:0;">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span>选择</span>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-8">
                            <div id="chosen">
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">音乐名</label>
                        <div class="col-sm-8">
                        	<input name="music_name" type="text" value="<?php if(isset($info['music_name'])) echo $info['music_name'];?>" class="form-control" placeholder="音乐名" required="required">
                        </div>
                    </div>
                    <div id="upload-form-1">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">封面</label>
                            <div class="col-sm-8">
                            	<input class="url-input" type="hidden" name="music_cover" value="<?php if(isset($info['music_cover'])) echo $info['music_cover'];?>">
                            	<button class="btn btn-primary btn-sm upload_btn" type="button">上传封面</button>
                            	<span class="size_box"></span>
                            	<span class="msg_box"></span>
                            	<div class="progress progress-sm bar_box" style="display: none;">
    								<div class="progress-bar bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
    							    	0%
    							  	</div>
    							</div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-3 control-label"></label>
                        	<div class="col-sm-8">
                            	<img class="img_item" src="<?php if(isset($info['music_cover'])) echo $info['music_cover'];?>" width="100px">
                        	</div>
                        </div>
                    </div>
                    <div id="upload-form-2">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">音频文件</label>
                            <div class="col-sm-8">
                                <input class="url-input" type="hidden" name="music_audio" value="<?php if(isset($info['music_audio'])) echo $info['music_audio'];?>">
                                <button class="btn btn-primary btn-sm upload_btn" type="button">上传音频</button>
                                <span class="size_box"></span>
                                <span class="msg_box"><?php if(isset($info['music_audio'])) echo $regex($info['music_audio']);?></span>
                                <div class="progress progress-sm bar_box" style="display: none;">
                                    <div class="progress-bar bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        0%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-8">
                                <img class="img_item" src="" width="100px">
                            </div>
                        </div>
                    </div>
                    <div id="upload-form-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">歌词文件</label>
                            <div class="col-sm-8">
                                <input class="url-input" type="hidden" name="music_lyric" value="<?php if(isset($info['music_lyric'])) echo $info['music_lyric'];?>">
                                <button class="btn btn-primary btn-sm upload_btn" type="button">上传歌词</button>
                                <span class="size_box"></span>
                                <span class="msg_box"><?php if(isset($info['music_lyric'])) echo $regex($info['music_lyric']);?></span>
                                <div class="progress progress-sm bar_box" style="display: none;">
                                    <div class="progress-bar bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        0%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group img_box" style="display: none;">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-8">
                                <img class="img_item" src="" width="100px">
                            </div>
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
<!--raty-->
<script src="./public/plugins/raty/jquery.raty.js"></script>
<script src="./public/plugins/raty/jquery.raty.config.js"></script>
<script type="text/javascript">
    
    //星星
    $(function(){
        $("#star").raty({
            score:<?php echo isset($info['music_best']) ? $info['music_best'] : 0;?>,
            scoreName:"music_best"
        });
    });
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
    //添加专辑
    $("#add_special_btn").click(function(){
        layer.open({
            type:2,
            title:'选择专辑',
            maxmin:true,
            area:['60%','80%'],
            content:'index.php/admin/Content/special_tab'
        });
    });
    //添加标签
    $("#add_tag_btn").click(function(){
        layer.open({
            type:2,
            title:'选择标签',
            maxmin:true,
            area:['60%','80%'],
            content:'index.php/admin/Content/tag_tab'
        });
    });
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"./index.php/admin/Content/music_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        var msg = "<?php if(!empty($id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.msg(msg,{time:1000});//调用父窗口的对象的layer,解决加载页面消息框被覆盖的问题
                        document.location = "index.php/admin/Content/music";
                    }else{
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
    function upload(uploadForm,data,Extensions,isShow = true){
        var urlInput    = $(uploadForm).find(".url-input")[0],
            sizeBox     = $(uploadForm).find(".size_box")[0],
            msgBox      = $(uploadForm).find(".msg_box")[0],
            imgItem     = $(uploadForm).find(".img_item")[0],
            barBox      = $(uploadForm).find(".bar_box")[0],
            bar         = $(uploadForm).find(".bar")[0],
            uploadBtn   = $(uploadForm).find(".upload_btn")[0];

        var uploader = new ss.SimpleUpload({
            button: uploadBtn,
            url: 'index.php/admin/Upload/do_upload',
            name: 'file',
            data:data,
            responseType: 'json',
            allowedExtensions: Extensions,//扩展名 参数 ['jpg','jpeg','png']
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
                    msgBox.innerHTML = "成功上传文件:" + filename;
                    isShow ? (imgItem.src = data.path + data.file_name) : ("");//是否显示图片
                    $(urlInput).val(data.path + data.file_name);
                }else{
                    msgBox.innerHTML = result["err_msg"];
                }
            }
        });  
    }
    $(function(){
        upload(document.getElementById('upload-form-1'),{type:"MUSIC_COVER"},['jpg','jpeg','png']);
        upload(document.getElementById('upload-form-2'),{type:"MUSIC_AUDIO"},['mp3','ogg','wav']);
        upload(document.getElementById('upload-form-3'),{type:"MUSIC_LYRIC"},['txt','lrc']);
    });
</script>
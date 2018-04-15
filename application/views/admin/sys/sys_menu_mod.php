<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($menu_id)):?>编辑<?php else:?>添加<?php endif;?>菜单</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/SysControl/sys_menu'">系统菜单</button>
            	<button class="btn <?php if(empty($menu_id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_menu_add/0'">添加根菜单</button>
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
                    <?php if( ! empty($menu_id)):?>
             		<input type="hidden" id="menu_id" name="menu_id" value="<?php echo $menu_id;?>"  /> 
                    <?php else:?>
                    <input type="hidden" id="menu_pid" name="menu_pid" value="<?php if(isset($menu_pid)) echo $menu_pid;?>"  /> 
                    <?php endif;?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单名称</label>
                        <div class="col-sm-5">
                        	<input name="menu_name" id="menu_name" value="<?php echo isset($info['menu_name'])?$info['menu_name']:''?>" minlength="2" required="required" type="text" class="form-control"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单地址</label>
                        <div class="col-sm-5">
                            <input name="menu_url" id="menu_url" value="<?php echo isset($info['menu_url'])?$info['menu_url']:''?>" conurl="true" type="text" class="form-control" placeholder="文件名/控制器名/方法名"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单图标</label>
                        <div class="col-sm-5">
                            <?php $icon = isset($info['menu_icon'])?$info['menu_icon']:''?>
                            <input name="menu_icon" id="menu_icon" value="<?php echo htmlentities($icon,ENT_QUOTES,"UTF-8");?>" type="text" class="form-control" placeholder="&lt;i class=&quot;fa fa-desktop&quot;&gt;&lt;/i&gt"/>
                        </div>
                        <label id="icon_view" class="control-label"><?php echo isset($info['menu_icon'])?$info['menu_icon']:''?></label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单序号</label>
                        <div class="col-sm-5">
                            <input name="menu_order" id="menu_order" value="<?php echo isset($info['menu_order'])?$info['menu_order']:''?>" type="number" class="form-control"   />
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

<script type="text/javascript">
    $("#menu_icon").change(function(){
        $("#icon_view").html($(this).val());
    });
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"./index.php/admin/SysControl/sys_menu_save",
                dataType:"json",
                success:function(result){
                    if( ! (result["err_code"]*1) ){ // *1 转int
                        var msg = "<?php if(!empty($menu_id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.msg(msg,{time:1000});
                        document.location = "index.php/admin/SysControl/sys_menu";
                    }
                },
                error:function(){

                }
            });
            return false;
        }
    });
    //自定义验证规则
    jQuery.validator.addMethod("conurl", function(value, element) {
        var url = /^([a-zA-Z_]+\/[a-zA-Z_]+)+$/;
        return this.optional(element) || ( url.test(value)); 
    }, "地址格式不正确");    
</script>
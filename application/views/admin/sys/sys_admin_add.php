<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($admin_id)):?>编辑<?php else:?>添加<?php endif;?>用户</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/SysControl/sys_admin'">系统用户</button>
            	<button class="btn <?php if(empty($admin_id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_admin_add'">新增用户</button>
                
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
             		<input type="hidden" id="admin_id" name="admin_id" value="<?php if(!empty($admin_id)) echo $admin_id;?>"  /> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">账号名：</label>
                        <div class="col-sm-8">
                        	<input name="admin_name" id="admin_name" value="<?php echo isset($info['admin_name'])?$info['admin_name']:''?>" minlength="4" required="required" aria-required="false" type="text" class="form-control"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">密码：</label>
                        <div class="col-sm-8">
                            <input name="admin_pwd" id="admin_pwd" type="password" minlength="8" <?php if(empty($admin_id)):?> required="required" aria-required="true"<?php endif;?> class="form-control"   />
                            <?php if(!empty($admin_id)):?>
                            <span class="help-block m-b-none">不改密码的话，请将此框设置为空</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认密码：</label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色：</label>
                        <div class="col-sm-8">
                            <ul class="list-group">
                                <?php foreach($role as $v):?>
                                    <li class="list-group-item list-group-item-success">
                                        <label class="checkbox-inline"><input <?php if( isset($info["role_list"]) && in_array($v["role_id"], $info["role_list"])) echo "checked"; ?> type="checkbox" name="role_id[]" class="menu_check" value="<?php echo $v["role_id"];?>"> <?php echo $v["role_name"];?> </label>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">账号状态：</label>
                        <div class="col-sm-8">
                        	 <div class="radio i-checks">
                                <label><input type="radio" id="islock0" checked="checked" <?php if(isset($info['admin_islock']) && $info['admin_islock']==0 ):?>checked="checked"<?php endif;?> value="0" name="admin_islock"> <i></i>启用</label>
                            </div>
                            <div class="radio i-checks">
                                <label><input type="radio" id="islock1" <?php if(isset($info['admin_islock']) && $info['admin_islock']==1 ):?>checked="checked"<?php endif;?> value="1" name="admin_islock"> <i></i>禁用</label>
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

<script type="text/javascript">
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"./index.php/admin/SysControl/sys_admin_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        var msg = "<?php if(!empty($admin_id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.mse(msg,{time:1000});//调用父窗口的对象的layer,解决加载页面消息框被覆盖的问题
                        document.location = "index.php/admin/SysControl/sys_admin";
                    }
                },
                error:function(){

                }
            });
            return false;
        }
    });
</script>
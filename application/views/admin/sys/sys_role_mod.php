<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php if(!empty($role_id)):?>编辑<?php else:?>添加<?php endif;?>角色</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-default" onclick="location.href='index.php/admin/SysControl/sys_role'">用户角色</button>
            	<button class="btn <?php if(empty($role_id)):?>btn-primary <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_role_mod'">新增角色</button>
                
            </div>
            <div class="ibox-content">
             	<form class="form-horizontal m-t">
             		<input type="hidden" id="role_id" name="role_id" value="<?php if(!empty($role_id)) echo $role_id;?>"  /> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色名：</label>
                        <div class="col-sm-8">
                        	<input name="role_name" id="role_name" value="<?php echo isset($info['role_name'])?$info['role_name']:''?>" minlength="4" required="required" type="text" class="form-control"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">操控菜单：</label>
                        <div class="col-sm-8">
                            <ul class="list-group">
                                <?php foreach($menu as $m):?>
                                    <li class="list-group-item list-group-item-success">
                                        <label class="checkbox-inline"><input <?php if( isset($info["menu_list"]) && in_array($m["menu_id"], $info["menu_list"])) echo "checked"; ?> type="checkbox" name="menu_id[]" id="menu_<?php echo $m['menu_id'];?>" pid = "menu_<?php echo $m['menu_pid'];?>" class="menu_check" value="<?php echo $m['menu_id'];?>"> <?php echo $m['menu_name'];?> </label>
                                    </li>
                                    <?php foreach($m["child"] as $c):?>
                                        <li class="list-group-item list-group-item-info">
                                            <i style="display: inline-block;width: 50px;height: 1px;"></i>
                                            <label class="checkbox-inline"><input <?php if( isset($info["menu_list"]) && in_array($c["menu_id"], $info["menu_list"])) echo "checked"; ?> type="checkbox" name="menu_id[]" id="menu_<?php echo $c['menu_id'];?>" pid = "menu_<?php echo $c['menu_pid'];?>" class="menu_check" value="<?php echo $c['menu_id'];?>"> <?php echo $c['menu_name'];?> </label>
                                        </li>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色状态：</label>
                        <div class="col-sm-8">
                        	<div class="radio i-checks">
                                <label><input type="radio" id="islock0" checked="checked" <?php if(isset($info['role_islock']) && $info['role_islock']==0 ) echo "checked";?> value="0" name="role_islock"> <i></i>启用</label>
                            </div>
                            <div class="radio i-checks">
                                <label><input type="radio" id="islock1" <?php if(isset($info['role_islock']) && $info['role_islock']==1 ) echo "checked";?> value="1" name="role_islock"> <i></i>禁用</label>
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
    $(document).on("click",".menu_check",function(){
        var that = this;//防止于下面的this混淆
        $(".menu_check").each(function(){//遍历多选框
            if($(this).attr("pid") == $(that).attr("id")){//后代
                this.checked = that.checked;
            }
            if($(this).attr("id") == $(that).attr("pid")){//父亲
                this.checked = true;
            }
        });
    });
    
    // 表单验证
    $("form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"index.php/admin/SysControl/sys_role_save",
                dataType:"json",
                success:function(result){
                    if( ! (result["err_code"] *1) ){
                        var msg = "<?php if(!empty($role_id)):?>修改成功<?php else:?>添加成功<?php endif;?>";
                        parent.layer.msg(msg,{time:1000});
                        document.location = "index.php/admin/SysControl/sys_role";
                    }  
                },
                error:function(){

                }
            });
            return false;
        }
    });
</script>
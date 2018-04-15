<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>系统菜单</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-primary" onclick="location.href='javascript:0;'">系统菜单</button>
                <button class="btn btn-default" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_menu_add/0'">添加根菜单</button>
            </div>
            <!-- <div class="ibox-content">
                <form id="test_form" class="">
                    <p>
                        <input id="t_name" class="" type="text" minlength="5" required="required" name="t_name">
                    </p>
                    <p>
                        <input id="t_pass" class="" type="text" minlength="5" required="required" name="t_pass">
                    </p>
                    <p>
                        <input id="t_phone" class="" type="t_phone" name="t_phone">
                    </p>
                    <input type="submit" value="提交">
                </form>
            </div> -->
            <div class="ibox-content">
                <!-- <ul>
                    <li>
                        <div>
                            <span>系统管理</span>
                            <a class="btn_add">添加</a>
                            <a>编辑</a>
                            <a>删除</a>
                        </div>
                        <ul>
                            <li>用户管理</li>
                            <li>用户管理</li>
                            <li>用户管理</li>
                        </ul>
                    </li>
                </ul> -->
                <?php $func = function($data) use(&$func){?>
                    <?php foreach($data as $d):?>
                        <ul>
                            <li>
                                <div>
                                    <span><?php echo $d['menu_icon']; echo $d['menu_name'];?></span>
                                    <span>【<?php echo $d['menu_url'];?>】</span>
                                    <a href="index.php/admin/SysControl/sys_menu_add/<?php echo $d['menu_id']?>" class="btn_add" >添加</a>
                                    <a href="index.php/admin/SysControl/sys_menu_edit/<?php echo $d['menu_id']?>" class="btn_edit">编辑</a>
                                    <a href="index.php/admin/SysControl/sys_menu_del/<?php echo $d['menu_id']?>" class="btn_del" >删除</a>
                                </div>
                                <!-- 添加 -->
                                <ul class="add_menu" style="display:none;">
                                    <li>
                                        <div>    
                                            <form id="<?php echo 'add_form_'.$d['node']?>" class="">
                                                    <input type="hidden" name="menu_pid" value="<?php echo $d['menu_id']?>">
                                                    <p>    
                                                        <input type="text" name="menu_name" value="" minlength="2" required="required" placeholder="菜单名称">
                                                    </p>
                                                    <p>
                                                        <input type="text" name="menu_url" placeholder="菜单地址"> 
                                                    </p>
                                                    <p>
                                                        <input type="text" name="menu_icon" placeholder="菜单图标">
                                                    </p>
                                                    <p>
                                                        <input type="number" name="menu_order" value="0" placeholder="序号">
                                                    </p>
                                                    <input class="" type="submit" value="确定">
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                                <!-- 编辑 -->
                                <ul class="edit_menu" style="display:none;">
                                    <li>
                                        <div>    
                                            <form id="<?php echo 'edit_form_'.$d['node']?>" class="">
                                                    <input type="hidden" name="menu_id" value="<?php echo $d['menu_pid']?>">
                                                    <p>    
                                                        <input type="text" name="menu_name" value="<?php echo $d['menu_name']?>" minlength="2" required="required" placeholder="菜单名称">
                                                    </p>
                                                    <p>
                                                        <input type="text" name="menu_url" value="<?php echo $d['menu_url']?>" placeholder="菜单地址"> 
                                                    </p>
                                                    <p>
                                                        <input type="text" name="menu_icon" value="<?php echo $d['menu_icon']?>" placeholder="菜单图标">
                                                    </p>
                                                    <p>
                                                        <input type="number" name="menu_order" value="<?php echo $d['menu_order']?>" placeholder="序号">
                                                    </p>
                                                    <input class="" type="submit" value="确定">
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                                <?php $func($d['child']);?>
                            </li>
                        </ul>
                    <?php endforeach;?>
                <?php }?>
                <?php $func($info);?>
            </div>
        </div>
    </div>
</div>

<!-- <script src="./public/plugins/validate/jquery.validate.min.js"></script> -->
<!-- <script src="./public/plugins/validate/messages_zh.min.js"></script> -->
<!-- <script src="./public/plugins/validate/common_config.js"></script> -->
<!-- <script src="./public/plugins/form/jquery.form.js"></script> -->
<script type="text/javascript">
    // $('form').each(function(){
    //     var id = $(this).attr('id');
    //     var url = "./index.php/admin/SysControl/sys_menu_save";//提交路径，添加表单路径
    //     if(id.indexOf("edit_form_")+1)                          //如果是编辑表单，切换编辑表单路径
    //         url = "./index.php/admin/SysControl/sys_menu_edit";
    //     $("#"+id).validate({
    //         submitHandler:function(form){
    //             console.dir("验证成功");
    //             console.dir(url);
    //             // $(form).ajaxSubmit({
    //             //     type:"POST",
    //             //     url:url,
    //             //     dataType:"json",
    //             //     success:function(result){
    //             //         if(result['err_code'] == 0){
    //             //             window.location = './index.php/admin/SysControl/sys_menu';
    //             //         }
    //             //     }
    //             // });
    //             return false;
    //         }
    //     });

    // });
    // var func = function(e){
    //     var menu_a = $(e).parent().siblings(".add_menu");
    //     var menu_e = $(e).parent().siblings(".edit_menu");
        
    //     menu_a.is(":hidden") ? menu_a.show() : menu_a.hide();
    // }
    //显示对应的添加表单
    // $(document).on('click','.btn_add',function(){
    //     $(this).parent().siblings(".edit_menu").hide();
    //     var menu = $(this).parent().siblings(".add_menu");
    //     menu.is(":hidden") ? menu.show(): menu.hide();
    // });
    //显示对应的编辑表单
    // $(document).on('click','.btn_edit',function(){
    //     $(this).parent().siblings(".add_menu").hide();
    //     var menu = $(this).parent().siblings(".edit_menu");
    //     menu.is(":hidden") ? menu.show() : menu.hide();
    // });
</script>
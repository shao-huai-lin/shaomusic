<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>栏目</h5>
            </div>
            <div class="ibox-content">
                <button class="btn <?php if($type == 1):?> btn-primary <?php else:?> btn-default <?php endif;?>" onclick="location.href='index.php/admin/Content/classed/1'">音乐栏目</button>
                <button class="btn <?php if($type == 2):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/classed/2'">歌手栏目</button>
                <button class="btn <?php if($type == 3):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/classed/3'">专辑栏目</button>
            </div>
            <div class="ibox-content">
                <form id="edit_form">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>标记</th>
                            <th>ID</th>
                            <th>栏目名</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td><input type="checkbox"/></td>
                            <td><span>1</span></td>
                            <td><input type="text" name="class_name" value="华语音乐" required="required" minlength="5"/></td>
                            <td><input type="number" name="class_order" value="0" required="required"/></td>
                            <td><span>显示</span></td>
                            <td>XX</td>
                        </tr> -->
                        <?php $hide = array(0=>"显示",1=>"隐藏");?>
                        <?php foreach($info as $k => $v):?>
                            <tr>
                                <td><input name="index[]" value="<?php echo $k?>" type="checkbox"/></td>
                                <td><span><?php echo $v["class_id"];?></span></td>
                                <td>
                                    <input type="hidden" name="class_id[<?php echo $k?>]" value="<?php echo $v["class_id"];?>">
                                    <input type="text" name="class_name[<?php echo $k?>]" value="<?php echo $v["class_name"];?>" required="required" minlength="4"/>
                                    <span class="err"></span>
                                </td>
                                <td>
                                    <input type="number" name="class_order[<?php echo $k?>]" value="<?php echo $v["class_order"];?>"/>
                                    <span class="err"></span>
                                </td>
                                <td><span><a href="index.php/admin/Content/classed_save/<?php echo "$v[class_id]/$v[class_hide]?type=$type";?>"> <?php echo $hide[$v["class_hide"]];?> </a></span></td>
                                <td>XX</td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><label class="checkbox-inline"><input id="all_check" type="checkbox">全选</label></td>
                            <td colspan="5"><button type="submit" class="btn btn-primary btn-xs">修改</button></td>
                        </tr>
                    </tfoot>
                </table>
                </form>
            </div>
            <div class="ibox-title">
                <h5>添加栏目</h5>
            </div>
            <div class="ibox-content">
                <form id="save_form" class="form-inline">
                    <div class="form-group">
                        <input type="hidden" name="class_type" value="<?php echo $type;?>">
                    </div>
                    <div class="form-group">
                        <label for="class_name">栏目名</label>
                        <input id="class_name" name="class_name" type="text" class="form-control" placeholder="栏目名" required="required">
                        <span class="err"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_order">排序</label>
                        <input id="class_order" name="class_order" type="number" value="0" class="form-control" placeholder="序号">
                        <span class="err"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <span class="err"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    /*.form-group .err{
        display: block;
        color: #f00;
        text-align: right;
        padding-right: 10px;
        min-height: 18px;
    }*/
</style>
<script src="./public/plugins/validate/jquery.validate.min.js"></script>
<script src="./public/plugins/validate/messages_zh.min.js"></script>
<script src="./public/plugins/form/jquery.form.js"></script>
<script type="text/javascript">
    $("#save_form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"index.php/admin/Content/classed_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        document.location = "index.php/admin/Content/classed/<?php echo $type;?>";
                    }
                },
                error:function(){

                }
            });
            return false;
        },
        errorPlacement:function(error,element){
            error.appendTo( $(element).parent().find(".err"));
        }
    });

    // 全选
    $("#all_check").click(function(){
        var form = $(this).context.form;
        for (var i = 0; i < form.elements.length; i++) {
            var e = form.elements[i];
            if(e != this) e.checked = this.checked;
        }
    });


    //
    $("#edit_form").validate({
        submitHandler:function(form){
            //地址后面的9999是为了后台判断用
            $(form).ajaxSubmit({
                type:"POST",
                url:"index.php/admin/Content/classed_save/9999",
                dataType:"json",
                success:function(result){
                    if( ! parseInt(result["err_code"])){
                        document.location = "index.php/admin/Content/classed/<?php echo $type;?>";
                    }else{
                        layer.msg(result["err_msg"],{icon:6});
                    }
                }
            });
        },
        errorPlacement:function(error,element){
            error.appendTo( $(element).parent().find(".err"));
        }
    });
    //bug
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>标签</h5>
            </div>
            <div class="ibox-content">
                <button class="btn <?php if($type == 1):?> btn-primary <?php else:?> btn-default <?php endif;?>" onclick="location.href='index.php/admin/Content/tag/1'">地域</button>
                <button class="btn <?php if($type == 2):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/tag/2'">曲风</button>
                <button class="btn <?php if($type == 3):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/tag/3'">心情</button>
                <button class="btn <?php if($type == 4):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/tag/4'">歌手</button>
                <button class="btn <?php if($type == 5):?> btn-primary <?php else:?> btn-default <?php endif;?>" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/tag/5'">语言</button>
            </div>
            <div class="ibox-content">
                <form id="edit_form">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 100px;">标记</th>
                            <th>ID</th>
                            <th>标签名</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td><input type="checkbox"/></td>
                            <td><span>1</span></td>
                            <td><input type="text" name="tag_name" value="测试的" required="required"/></td>
                            <td>XX</td>
                        </tr> -->
                        <?php foreach($info as $k=>$v):?>
                            <tr>
                                <td><input type="checkbox" name="index[]" value="<?php echo $k?>" /></td>
                                <td><span><?php echo $v["tag_id"]?></span></td>
                                <td>
                                    <input type="hidden" name="tag_id[<?php echo $k?>]" value="<?php echo $v["tag_id"];?>" >
                                    <input type="text" name="tag_name[<?php echo $k?>]" value="<?php echo $v["tag_name"];?>" required="required">
                                </td>
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
                <h5>添加标签</h5>
            </div>
            <div class="ibox-content">
                <form id="save_form" class="form-inline">
                    <div class="form-group">
                        <input type="hidden" name="tag_type" value="<?php echo $type;?>">
                    </div>
                    <div class="form-group">
                        <label for="tag_name">标签名</label>
                        <input id="tag_name" name="tag_name" type="text" class="form-control" placeholder="标签名" required="required">
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
<script src="./public/plugins/validate/jquery.validate.min.js"></script>
<script src="./public/plugins/validate/messages_zh.min.js"></script>
<script src="./public/plugins/form/jquery.form.js"></script>
<script type="text/javascript">
    $("#save_form").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                url:"index.php/admin/Content/tag_save",
                dataType:"json",
                success:function(result){
                    if(! parseInt(result["err_code"])){
                        document.location = "index.php/admin/Content/tag/<?php echo $type;?>";
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

    $("#edit_form").validate({
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type:"POST",
                url:"index.php/admin/Content/tag_save/9999",
                dataType:"json",
                success:function(result){
                    if( ! parseInt(result["err_code"])){
                        document.location = "index.php/admin/Content/tag/<?php echo $type;?>";
                    }else{
                        layer.msg(result["err_msg"],{icon:6});
                    }
                },
                error:function(){

                }
            });
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
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>用户角色</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-primary" onclick="location.href='javascript:0;'">用户角色</button>
                <button class="btn btn-default" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_role_mod'">新增角色</button>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="role_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>角色</th>
                            <th>菜单权限</th>
                            <th>状态</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="./public/plugins/dataTables/jquery.dataTables.js"></script>
<script src="./public/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    //表格调用 的URL
    var url = 'index.php/admin/SysControl/sys_role_info';
    get_datatables(url);

    //编辑
    $(document).on("click",".btn_edit",function(){
        var val = $(this).attr("data-value");
        window.location.href = "index.php/admin/SysControl/sys_role_mod/" + val ;
    });
    //删除
    $(document).on("click",".btn_del",function(){
        var val = $(this).attr("data-value");
        layer.alert("您确定要删除该角色吗?",function(index){
            layer.msg("暂时不能删除");
            // $.ajax({
            //     type: "POST",
            //     url: "",
            //     data: {"admin_id":val},
            //     dataType: "json",
            //     success: function(result){
            //         if( ! parseInt(result.err_code)){
            //             layer.msg('删除成功！');
            //             //重新刷新datatable表格
            //             var oTable = $("#admin_table").dataTable();
            //             oTable.fnDraw();
            //         }else{
            //             layer.msg(result.err_msg);
            //         }
            //     }
            // });
        });
    });
    function get_datatables(sAjaxSource){
        var datatables = $('#role_table').dataTable({
            "bServerSide": true,
            'bPaginate': true, //是否分页
            "bProcessing": true, //datatable获取数据时候是否显示正在处理提示信息。
            "iDisplayLength": iDisplayLength, 
            'bFilter': false, //是否使用内置的过滤功能
            "sAjaxSource": sAjaxSource,
            "ordering":false, //禁用排序
            "bAutoWidth":false,
            "aaSorting": [
                [0, "desc"],
            ],
            "aoColumns" : [
                        { "mDataProp": "role_id","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "role_name","bSortable": false, "bSearchable": false, },
                        

            ],
            //添加自定义的列
            "columnDefs": [
                {
                    "targets":[2],
                    "data":"menu_list",
                    "render":function(data){
                        var result = '<div style="max-width:500px">{0}</div>';
                        if(data.length){
                            var txt = "";
                            for(var i=0;i<data.length;i++){
                                txt += data[i].menu_name;
                                txt += " - "
                            }
                            return result.format(txt);
                        }
                        return "没有分配权限";
                    }
                },
                {
                    "targets":[3],
                    "render":function(data,type,row){
                        //0 未锁（启用）  1 锁定（禁用）
                        var path = 'index.php/admin/SysControl/sys_role_save/{0}/{1}'.format(row.role_id,row.role_islock);
                        var on     = '<a href="{0}">启用</a>'.format(path);
                        var off    = '<a href="{0}">禁用</a>'.format(path);
                        return parseInt(row.role_islock) ? off : on;
                    }
                },
                {
                    "targets":[4], // 目标列位置，下标从0开始
                    "data":"role_id", // 数据列名
                    "render":function(data, type, full) { // 返回自定义内容
                        return "<button type='button' data-value='"+data+"' class='btn btn-primary btn_edit'>编辑</button>"
                                +" <button type='button' data-value='"+data+"' class='btn btn-primary btn_del'>删除</button>";
                    }
                }
            ],
            "oLanguage":oLanguage,
        });
    }
</script>


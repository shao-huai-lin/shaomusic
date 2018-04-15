<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>系统用户</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-primary" onclick="location.href='javascript:0;'">系统用户</button>
                <button class="btn btn-default" style="margin-left: 10px;" onclick="location.href='index.php/admin/SysControl/sys_admin_add'">新增用户</button>
                
                <form class="form-inline" style="float: right;" id="form_search">
                    <div class="form-group ">
                        <label for="a_name" class="sr-only">账号名</label>
                        <input type="text" placeholder="请输入账号名" id="admin_name" class="form-control">
                    </div>
                    <button class="btn btn-primary" id="btn_search" type="button">搜索</button>
                    <button class="btn btn-white" id="btn_clean" type="button">清除搜索</button>
                </form>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="admin_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>账号名</th>
                            <th>角色</th>
                            <th>登录时间</th>
                            <th>登录次数</th>
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
    var url = 'index.php/admin/SysControl/sys_admin_info';
    get_datatables(url);

    //搜索
    $("#form_search").on('click','#btn_search',function(){
        var admin_name = $("#admin_name").val();
        var parm='?admin_name='+admin_name;
        $('#admin_table').dataTable().fnDestroy();
        get_datatables(url + parm);
    });
    //编辑
    $(document).on("click",".btn_edit",function(){
        var val = $(this).attr("data-value");
        window.location.href = "index.php/admin/SysControl/sys_admin_add?admin_id=" + val ;
    });
    //删除
    $(document).on("click",".btn_del",function(){
        var val = $(this).attr("data-value");
        layer.alert("您确定要删除该用户吗?",function(index){
            $.ajax({
                type: "POST",
                url: "index.php/admin/SysControl/sys_admin_del",
                data: {"admin_id":val},
                dataType: "json",
                success: function(result){
                    if( ! parseInt(result.err_code)){
                        layer.msg('删除成功！');
                        //重新刷新datatable表格
                        var oTable = $("#admin_table").dataTable();
                        oTable.fnDraw();
                    }else{
                        layer.msg(result.err_msg);
                    }
                }
            });
        });
    });
    function get_datatables(sAjaxSource){
        var datatables = $('#admin_table').dataTable({
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
                        { "mDataProp": "admin_id","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "admin_name","bSortable": true, "bSearchable": true, },
                        { "mDataProp": "role_list","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "admin_logintime","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "admin_loginnum","bSortable": false, "bSearchable": false, },
            ],
            //添加自定义的列
            "columnDefs": [
                {
                    "targets":[2],
                    "render":function(data){
                        var result = "";
                        var defaulted = "未分配角色";
                        for(var i=0;i<data.length;i++){
                            var is_default = parseInt( data[i].is_default ) ? "-默认": ""; 
                            result += (i+1) + "." + data[i].role_name;
                            result += is_default;
                            result += "<br/>";
                        }
                        return (result == "") ? defaulted : result;
                    }
                },
                {
                    "targets":[5],
                    "render":function(data,type,row){
                        $on     = '<a href="index.php/admin/SysControl/sys_admin_save/'+row.admin_id+'/'+row.admin_islock+'">启用</>';
                        $off    = '<a href="index.php/admin/SysControl/sys_admin_save/'+row.admin_id+'/'+row.admin_islock+'">禁用</>';
                        return parseInt(row.admin_islock) ? $off : $on;
                    }
                },
                {
                    "targets": [6], // 目标列位置，下标从0开始
                    "data": "admin_id", // 数据列名
                    "render": function(data, type, full) { // 返回自定义内容
                        return "<button type='button'    data-value='"+data+"' class='btn btn-primary btn_edit'>编辑</button>"
                                + "  <button type='button'    data-value='"+data+"' class='btn btn-primary btn_del'>删除</button>";
                    }
                }
            ],
            "oLanguage":oLanguage,
        });
    }

</script>


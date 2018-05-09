<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>用户列表</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-primary" onclick="location.href='javascript:0;'">所有用户</button>
                <button class="btn btn-default" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/user_mod'">vip</button>
                <button class="btn btn-default" style="margin-left: 10px;" onclick="location.href='index.php/admin/Content/user_mod'">锁定用户</button>
                
                <form class="form-inline" style="float: right;" id="form_search">
                    <div class="form-group">
                        <select id="btn_abc" class="form-control">
                            <option value="">所有</option>
                            <?php foreach(range('A','Z') as $v):?>
                            <option value="<?php echo $v;?>"><?php echo $v;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="user_name" class="sr-only">用户名</label>
                        <input type="text" placeholder="请输入用户名" id="user_name" class="form-control">
                    </div>
                    <button class="btn btn-primary" id="btn_search" type="button">搜索</button>
                    <button class="btn btn-white" id="btn_clean" type="button">清除搜索</button>
                </form>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>头像</th>
                            <th>邮箱</th>
                            <th>等级</th>
                            <th>状态</th>
                            <th>性别</th>
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
    // var url = 'index.php/admin/Content/user_info';
    // get_datatables(url);

    //搜索
    $("#form_search").on('click','#btn_search',function(){
        var user_name = $("#user_name").val();
        var parm='?user_name='+user_name;
        $('#table').dataTable().fnDestroy();
        get_datatables(url + parm);
    });
    //搜索2
    var search = function(){
        var abc = $("#btn_abc").val();
        var class_id = $("#btn_class").val();
        
        var parm = '?abc=' + abc;
        parm += '&class_id=' + class_id;
        $('#table').dataTable().fnDestroy();
        get_datatables(url + parm);
    }
    $("#form_search").on("change","#btn_abc",search);
    $("#form_search").on("change","#btn_class",search)
    //编辑
    $(document).on("click",".btn_edit",function(){
        var val = $(this).attr("data-value");
        window.location.href = "index.php/admin/Content/user_mod/" + val ;
    });
    //删除
    $(document).on("click",".btn_del",function(){
        // var val = $(this).attr("data-value");

        // swal({
        //     title: "您确定要删除该用户吗?",
        //     text: "删除后该用户的记录不存在，请谨慎操作！",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#DD6B55",
        //     confirmButtonText: "删除",
        //     closeOnConfirm: true,

        // }, function () {
        //     $.ajax({
        //        type: "POST",
        //        url: "index.php/admin/SysControl/sys_admin_del",
        //        data: {"admin_id":val},
        //        dataType: "json",
        //        success: function(msg){
        //           if(msg.err_code == 0){
        //               swal("删除成功！", msg.err_msg, "success");
        //               //重新刷新datatable表格
        //               var oTable = $("#admin_table").dataTable();
        //               oTable.fnDraw();
        //           }else{
        //              swal("出错啦！", msg.err_msg, "error");
        //           }
        //        }
        //     });
        // });
        //window.location.href = "index.php/admin/SysControl/sys_admin_del?admin_id=" + val;
    });
    function get_datatables(sAjaxSource){
        var datatables = $('#table').dataTable({
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
                        { "mDataProp": "user_id","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "user_cover","bSortable": true, "bSearchable": true, },
                        { "mDataProp": "user_name","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "user_best","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "singer_name","defaultContent":"未知歌手","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "special_name","defaultContent":"未知专辑","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "user_hits","bSortable": false, "bSearchable": false, },
            ],
            //添加自定义的列
            "columnDefs": [
                {
                    "targets":[1],
                    "render":function(data){
                        //data = data ? "public/mine/img/default_cd.png" : data;
                        data = data || "public/mine/img/default_cd.png";
                        return "<img src='{0}' width='30px' style='border:1px solid #ccc;' />".format(data);
                    }
                },
                {
                    "targets":[2],
                    "render":function(data,type,row){
                        return "<a href='index.php/portal/user/index/{0}' target='_blank'>{1}</a>".format(row.user_id,data);
                    }
                },
                {
                    "targets":[3],
                    "render":function(data,type,row){
                        return "<div class='star' data-val='{0}'></div>".format([data,row.user_id]);
                        // return "<div class='star' data-val='"+[data,row.user_id]+"'></div>";
                    }
                },
                {
                    "targets":[7],
                    "data": "user_id", // 数据列名
                    "render":function(data){
                        return "<button type='button' data-value='"+data+"' class='btn btn-primary btn_edit'>编辑</button>"
                                + "  <button type='button' data-value='"+data+"' class='btn btn-primary btn_del'>删除</button>";
                    }
                }
            ],
            "oLanguage":oLanguage,
        });

        //表格完全加载完成回调函数
        datatables.on('init.dt',function(){
            $(".star").each(function(){
                var arr = $(this).attr("data-val").split(',');
                var best = arr[0],id = arr[1];
                $(this).raty({
                    score:best,
                    click:function(score,e){
                        var best = score || 0;
                        // document.location = "index.php/admin/Content/user_save/" + id + "/" + best;
                        document.location = "index.php/admin/Content/user_save/{0}/{1}".format(id,best);
                    }
                });
            });
        });
    }

</script>
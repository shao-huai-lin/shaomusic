<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content con-pad-sm">
                <div class="opt">
                    <div class="opt-con">
                        <input type="text" placeholder="请输入歌手名" id="singer_name" class="form-control input-sm">
                    </div>
                    <div class="opt-con">
                        <button class="btn btn-primary btn-sm" id="btn_search" type="button">搜索</button>
                    </div>
                    <div class="opt-con">
                        <button class="btn btn-white btn-sm" id="btn_clean" type="button">清除搜索</button>
                    </div>
                </div>
            </div>
            <div class="ibox-content con-pad-sm">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>封面</th>
                            <th>歌手</th>
                            <th>艺名</th>
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
    var url = 'index.php/admin/Content/singer_info';
    get_datatables(url);

    //搜索
    $("#btn_search").click(function(){
        var name = $("#singer_name").val();
        var parm='?singer_name='+ name;
        $('#table').dataTable().fnDestroy();
        get_datatables(url + parm);
    });

    function get_datatables(sAjaxSource){
        var datatables = $('#table').dataTable({
            "bServerSide": false,
            'bPaginate': true, //是否分页
            'lengthChange':false,
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
                        { "mDataProp": "singer_id","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "singer_cover","bSortable": true, "bSearchable": true, },
                        { "mDataProp": "singer_name","bSortable": false, "bSearchable": false, },
                        { "mDataProp": "singer_nick","bSortable": false, "bSearchable": false, },
            ],
            //添加自定义的列
            "columnDefs": [
                {
                    "targets":[1],
                    "render":function(data,type,row){
                        data = data || "public/mine/img/default_cd.png";
                        return "<img class='cover' src='"+data+"' data-id='"+row.singer_id+"' data-name='"+row.singer_name+"' width='30px' style='cursor:pointer;border:1px solid #ccc;' />";
                    }
                }
            ],
            "oLanguage":oLanguage,
        });
    }

    $(document).on("click",".cover",function(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        var id = $(this).attr("data-id");//当前id
        var name = $(this).attr("data-name");//当前歌手名
        parent.$('#add_singer_btn').html(this);
        parent.$('#add_singer_btn').append("<span>"+name+"</span>");
        parent.$('#singer_id').val(id);

        parent.layer.close(index);
    });
</script>
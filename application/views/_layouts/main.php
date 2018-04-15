<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo base_url()?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title></title>
    <link href="./public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/mine/css/font-awesome.min.css" rel="stylesheet">
    <link href="./public/mine/css/animate.min.css" rel="stylesheet">
    <link href="./public/mine/css/style.min.css" rel="stylesheet">
    
    <link href="./public/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="./public/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="./public/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <!-- 全局js -->
    <script src="./public/bootstrap/js/jQuery-2.1.4.min.js"></script>
    <script src="./public/bootstrap/js/bootstrap.min.js"></script>
    <script src="./public/plugins/layer/layer.js"></script>
    <script src="./public/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="./public/mine/js/common.js"></script>
    <script src="./public/mine/js/function.js"></script>
</head>
<style type="text/css">
    /*小的进度条*/
    .progress-sm{
        margin: 5px 0;
        height: 10px;
    }
    .progress-sm .progress-bar{
        line-height: 10px;
    }

    .opt{
        display: flex;
        flex-wrap: wrap;
    }
    .opt-con{
        margin-bottom: 2px;
        padding-right: 5px;
    }
    .ibox-content.con-pad-sm{
        padding: 10px 15px;
    }
    .btn-plus{
        border:1px solid #e5e6e7;
        color: #676a6c;
    }
    .btn-plus span{margin-left: 5px;}

    .tag{
        position: relative;
        display: inline-block;
        padding-top: 10px;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    .tag .tag-con{
        border:1px solid #e5e6e7;
        border-radius: 10px;
        color: #676a6c;
        padding:2px 10px;
    }
    .tag-shut{
        position: absolute;
        top: 0px;
        right: -8px;
        width: 18px;
        height: 18px;
        border: 1px solid #fff;
        border-radius: 10px;
        background: url('public/plugins/raty/img/cancel-off.png');
    }
    .tag-shut:hover{
        background: url('public/plugins/raty/img/cancel-on.png');
    }
</style>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <?php echo $content_for_layout?>
    </div>
</body>
</html>
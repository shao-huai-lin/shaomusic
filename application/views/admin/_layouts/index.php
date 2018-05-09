<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo base_url()?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="PHP,SQL,HTML">
    <meta name="description" content="后台管理">

    <title>Shao音乐后台管理</title>


    <!--[if lt IE 8]>
    <script>
        alert('H+已不支持IE6-8，请使用谷歌、火狐等浏览器\n或360、QQ等国产浏览器的极速模式浏览本页面！');
    </script>
    <![endif]-->

    <link href="./public/bootstrap/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="./public/mine/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <link href="./public/mine/css/animate.min.css" rel="stylesheet">
    <link href="./public/mine/css/style.min.css?v=3.0.0" rel="stylesheet">
</head>

<?php $user = $this->session->user;?>
<body class="fixed-sidebar full-height-layout gray-bg">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="./public/mine/img/default.png" width="64" height="64" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs"><strong class="font-bold"><?php echo $user["admin_name"]?></strong></span>
                                    <span class="text-muted text-xs block"><?php if( ! empty($user["new_role"])) echo $user["new_role"]["role_name"];?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" _href="/admin/sysmanage/sysmanage_admin_mod?myid=<?PHP //echo($_SESSION["sys_admin_id"]); ?>" _title="人员管理">修改资料</a></li>
                                <li class="divider"></li>
                                <li><a href="index.php/admin/Auth/logout">安全退出</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">Shao音乐后台管理
                        </div>
                    </li>

                    <?php if(!empty($_SESSION['sys_menu_info'])):?>
                        <?php foreach($_SESSION['sys_menu_info']['pright'] as $key => $val):?>
                            <li class="" id="root_<?php echo $key+2;?>">
                                <a href="<?php echo ((strlen($val['ar_url']) < 8) ? '#' : (base_url().$val['ar_url']));?>" class="nav-click">
                                    <i class="
                                    <?php
                                        if(empty($val['ar_icon'])){
                                            switch($key){
                                                case 0:
                                                    echo 'fa fa-edit';
                                                    break;
                                                case 1:
                                                    echo 'fa fa-desktop';
                                                    break;
                                                case 2:
                                                    echo 'fa fa fa-bar-chart-o';
                                                    break;
                                                case 3:
                                                    echo 'fa fa-cutlery';
                                                    break;
                                                default:
                                                    echo 'fa fa-home';
                                            }
                                        }else{
                                            echo $val['ar_icon'];
                                        }
                                    ?>
                                    "></i>
                                    <span class="nav-label"><?php echo $val['ar_name'];?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <?php if(isset($_SESSION['sys_menu_info']['right']['key_'.$val['ar_id']])):?>
                                    <ul class="nav nav-second-level">
                                        <?php foreach($_SESSION['sys_menu_info']['right']['key_'.$val['ar_id']] as $v):?>
                                            <li>
                                                <a class="J_menuItem" data-index="<?php echo $key+2;?>" _href="<?php echo base_url().$v['ar_url']?>"><?php echo $v['ar_name'];?></a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>

                    <!--  -->
                    <?php if( ! empty($user["new_role"]["menu_list"]) && isset($this->session->menu)):?>
                        <?php $menu = $this->session->menu;?>
                        <?php foreach($menu as $key => $val):?>
                            <li class="" id="root_<?php echo $key+2;?>">
                                <?php if( in_array($val["menu_id"],$user["new_role"]["menu_list"]) ):?>
                                    <a href="javascript:0;" class="nav-click">
                                        <!-- <i class="fa fa-desktop"></i> -->
                                        <?php echo $val["menu_icon"]?>
                                        <span class="nav-label"><?php echo $val["menu_name"]?></span>
                                        <span class="fa arrow"></span>
                                    </a>
                                <?php endif;?>
                                <ul class="nav nav-second-level">
                                    <?php foreach($val["child"] as $v):?>
                                        <?php if(in_array($v["menu_id"], $user["new_role"]["menu_list"])):?>
                                            <li>
                                                <?php if( ! empty($v["menu_url"])):?>
                                                    <a class="J_menuItem" data-index="<?php echo $key+2;?>" _href="index.php/<?php echo $v["menu_url"]?>"> <?php echo $v["menu_icon"]; echo $v["menu_name"];?></a>
                                                <?php else:?>
                                                    <a class="J_menuItem" data-index="<?php echo $key+2;?>" _href=""><?php echo $v["menu_icon"]; echo $v["menu_name"];?></a>
                                                <?php endif;?>
                                            </li>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>

                    <!--
                    <li class="" id="root_1">
                        <a href="javascript:0;" class="nav-click">
                            <i class="fa fa-desktop"></i>
                            <span class="nav-label">系统管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" data-index="1" _href="index.php/admin/SysControl"><i class="fa fa-desktop"></i> 系统用户</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="1" _href="index.php/admin/SysControl/sys_role">用户角色</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="1" _href="index.php/admin/SysControl/sys_menu">系统菜单</a>
                            </li>
                        </ul>
                    </li>
                    <li class="" id="root_2">
                        <a href="javascript:0;" class="nav-click">
                            <i class="fa fa-desktop"></i>
                            <span class="nav-label">用户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">用户</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">评论</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">说说</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">留言</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">日志</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="2" _href="">照片</a>
                            </li>
                        </ul>
                    </li>
                    <li class="" id="root_3">
                        <a href="javascript:0;" class="nav-click">
                            <i class="fa fa-desktop"></i>
                            <span class="nav-label">内容管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">音乐标签</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">音乐栏目</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">所有音乐</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">专辑栏目</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">所有专辑</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">歌手栏目</a>
                            </li>
                            <li>
                                <a class="J_menuItem" data-index="3" _href="">所有歌手</a>
                            </li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft navbar-minimalize"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
        
                <a href="index.php/admin/Auth/logout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="index.php/admin/Main/" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2010-2018 Shao音乐后台管理</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="./public/bootstrap/js/jQuery-2.1.4.min.js"></script>
    <script src="./public/bootstrap/js/bootstrap.min.js?v=3.4.0"></script>
    <script src="./public/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="./public/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="./public/plugins/layer/layer.js"></script>

    <!-- 自定义js -->
    <script src="./public/mine/js/hplus.min.js?v=3.0.0"></script>
    <script src="./public/mine/js/contabs.min.js" type="text/javascript"></script>

    <!-- 第三方插件(网页进度条加载) -->
    <!-- <script src="./public/mine/js/plugins/pace/pace.min.js"></script> -->
</body>
</html>
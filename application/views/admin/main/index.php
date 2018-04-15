<div>首页</div>
<?php $user = $this->session->user;?>
<p><?php if(isset($user["admin_id"])) echo $user["admin_id"]; ?></p>
<p><?php if(isset($user["admin_name"])) echo $user["admin_name"];?></p>

<!-- 当前角色 -->
<p>当前角色： <?php if( ! empty($user["new_role"])) echo $user["new_role"]["role_name"]; ?></p>
<!-- 角色列表 -->
<?php foreach($user["role_list"] as $role):?>
	<p>角色：<a href="index.php/admin/SysControl/sys_role_change/<?php echo $role["role_id"];?>"><?php echo $role["role_name"];?></a></p>
<?php endforeach;?>

<?php var_dump($user);?>
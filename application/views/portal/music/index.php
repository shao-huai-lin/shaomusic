<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url()?>">
	<meta charset="utf-8">
	<title>音乐播单</title>
	<script src="./public/bootstrap/js/jQuery-2.1.4.min.js"></script>
</head>
<body>
	<h1>选择的歌</h1>
	<object type="application/x-shockwave-flash" data="public/plugins/cmp/cmp.swf?php=fm" width="100%" height="400px" id="cmp">
		<param name="flashvars" value="lists=<?php echo base_url() . "index.php/portal/Cmp/fm?ids={$id}"?>" />
	</object>
</body>
</html>
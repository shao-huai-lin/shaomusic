<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=utf-8");
switch($_GET['id']){
	case 'fm':
		$skins = 'skins/fm.zip';
		break;
	default:
		$skins = '';
}

echo 
	"<cmp
		name = \"暂无音乐\"
		description = \"暂无歌词\"
		skin = \"{$skins}\"
	/>"
?>
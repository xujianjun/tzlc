<?php

include_once '../init.php';
$act = isset($_GET['act']) ? trim($_GET['act']) : '';

$result = array();
switch ($act){
	case 'updateSitemap':
		$res = $toolLib->updateSitemap(SITE_ROOT_PATH.'/public/sitemap.txt');
		break;
	case 'updateTagPinyin':
		$res = $toolLib->updateTagPinyin();
		break;
	case 'updateTreeLink':
		$res = $toolLib->updateTreeLink();
		break;
	case 'updateTreeLR':
		$res = $toolLib->updateTreeLR();
		break;
	case 'updateTreePos':
		$res = $toolLib->updateTreePos();
		break;
	default:
		$result = array('resCode'=>2, 'resMsg'=>'参数错误');
		break;
}

if (!$result && $res){
	if ($res){
		$result = array('resCode'=>0, 'resMsg'=>'成功！');
	} else {
		$result = array('resCode'=>1, 'resMsg'=>'失败！');
	}
}

echo json_encode($result);

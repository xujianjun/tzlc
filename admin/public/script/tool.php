<?php

include_once '../init.php';
$act = isset($_GET['act']) ? trim($_GET['act']) : '';

$result = array();
switch ($act){
	case 'updateSitemap':	//更新/sitemap.txt
		$res = $toolLib->updateSitemap(SITE_ROOT_PATH.'/public/sitemap.txt');
		break;
	case 'updateTagPinyin':	//更新tags表的pinyin字段
		$res = $toolLib->updateTagPinyin();
		break;
	case 'updateTreeLink':	//更新tree_data的link字段
		$res = $toolLib->updateTreeLink();
		break;
	case 'updateTreeLR':	//修正tree_struct的lft,rgt字段
		$res = $toolLib->updateTreeLR();
		break;
	case 'updateTreePos':	//修正tree_struct的pos字段
		$res = $toolLib->updateTreePos();
		break;
	case 'updateNodeTag':	//修正nodetag的数据
		$nid = isset($_GET['nid']) ? (int)$_GET['nid'] : 0;

		//type:simple(修正没有tid的nid);node(单个node);all(全部重新修正)
		$type = isset($_GET['type']) ? trim($_GET['type']) : 'simple';
		$res = $toolLib->updateNodeTag($type, $nid);
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

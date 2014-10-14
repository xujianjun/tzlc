<?php
include_once '../init.php';

if (isset($_POST['act'])){
	$act = $_POST['act'];
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	$result = array(0, '参数错误');
	$res = false;
	switch ($act){
		case 'edit_tag':
			$pinyinPrefix = isset($_POST['pinyinPrefix']) ? $_POST['pinyinPrefix'] : '';
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$desc = isset($_POST['desc']) ? $_POST['desc'] : '';
			$is_cidian = isset($_POST['is_cidian']) ? $_POST['is_cidian'] : '';
			$status = isset($_POST['status']) ? $_POST['status'] : '';
			$params = array(
						'id' => $id,
						'pinyinPrefix' => $pinyinPrefix,
						'name' => $name,
						'description' => $desc,
						'is_cidian' => $is_cidian,
						'status' => $status,
					);
			$res = $tagLib->updateTag($params);
			break;
		case 'del_tag':
			$res = $tagLib->delTag($id);
			break;
		default:
			break;
	}
	if ($res){
		$result = array(1, '操作成功');
	}
	$touzilicaiLib->resData($result);
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pagesize = isset($_COOKIE['tlIPP']) ? $_COOKIE['tlIPP'] : 20;

//get filter search
$tlat_startid = isset($_COOKIE['tlat_startid']) ? $_COOKIE['tlat_startid'] : 0;
$tlat_endid = isset($_COOKIE['tlat_endid']) ? $_COOKIE['tlat_endid'] : 0;
$tlat_name = isset($_COOKIE['tlat_name']) ? $_COOKIE['tlat_name'] : '';
$tlat_desc = isset($_COOKIE['tlat_desc']) ? $_COOKIE['tlat_desc'] : '';
$tlat_is_cidian = isset($_COOKIE['tlat_is_cidian']) ? (int)$_COOKIE['tlat_is_cidian'] : 10;
$tlat_status = isset($_COOKIE['tlat_status']) ? (int)$_COOKIE['tlat_status'] : 1;

$tlat_order_key = isset($_COOKIE['tlat_order_key']) ? $_COOKIE['tlat_order_key'] : '';
$tlat_order_type = isset($_COOKIE['tlat_order_type']) ? $_COOKIE['tlat_order_type'] : '';

$order = array('key'=>$tlat_order_key, 'type' => $tlat_order_type);
$params = array(
	'tlat_startid' => $tlat_startid,
	'tlat_endid' => $tlat_endid,
	'tlat_name' => $tlat_name,
	'tlat_desc' => $tlat_desc,
	'tlat_is_cidian' => $tlat_is_cidian,
	'tlat_status' => $tlat_status,

	'page' => $page,
	'pagesize' => $pagesize,
	'order' => $order
);
$params_json = json_encode($params);

$result = $tagLib->filterTags($params);
$tags = $result['list'];

//分页
$total = $result['total'];
$pager = '记录总数: '.$total;
if ($pagesize){
	$pageTotal = ceil($total/$pagesize);
	$pager .= ', 总页数: '.$pageTotal.', 当前第 '.$page.' 页'.$pagerLib->get($total, $pagesize, $page, '/script/tag.php'.$type, array(), 10);
}

if ($params['order']['key']){
	$orderStr = isset($pagePaths[$params['order']['key']]) ? $pagePaths[$params['order']['key']] : $params['order']['key'];
	if ($params['order']['type'] && in_array($params['order']['type'], array('order_asc', 'order_desc'))){
		$orderStr .= ' , ';
		$orderStr .= $params['order']['type']=='order_asc' ? '升序' : '降序';
	}

	$orderStr .= '&nbsp;&nbsp;&nbsp;&nbsp;<button class="cancel-order-btn">取消排序</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
} else {
	$orderStr = '无&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
}
$smarty->assign('orderStr', $orderStr);
$smarty->assign('params_json', $params_json);
$smarty->assign('params', $params);
$smarty->assign('pager', $pager);
$smarty->assign('tags', $tags);

$smarty->display('script/tag.html');

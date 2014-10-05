<?php
include_once('../header.php');
$linkTxt = 'sitemap.txt';
$baseUrl = 'http://www.licaimap.com';
die();
initTagLinks();
initNodeLinks();

function initTagLinks(){
	global $baseUrl;
	$sql = 'select * from tags order by id';
	$result = mysql_query($sql);
	$sitemap = '';
	while ($row = mysql_fetch_assoc($result)){
		$line = $baseUrl.'/tag/'.$row['id'].'.html';
//		echo $line.'<br>';
		writeToTxt($line);
	}
}

function initNodeLinks(){
	global $baseUrl;
	$sql = 'select ts.*,td.* from tree_struct ts left join tree_data td on ts.id=td.id where ts.lvl>=2 and ts.lft>2 and ts.rgt<5693 order by ts.lft limit 10000';
	$result = mysql_query($sql);
	$sitemap = '';
	$basePath = array();
	$pathStr = '/';
	$parentType = 'default';
	while ($row = mysql_fetch_assoc($result)){
		if ($row['type']=='default'){
			if ($parentType != 'default'){
				array_pop($basePath);
				for ($i = count($basePath)-1;$i>=0;$i--){
					if ($basePath[$i]['lft']>$row['lft'] || $basePath[$i]['rgt']<$row['rgt']){
						array_pop($basePath);
					}
				}
			}
			$basePath[] = array('title_en'=>$row['title_en'], 'lft'=>$row['lft'], 'rgt'=>$row['rgt']);
			$pathStr = '/';
			if (count($basePath)){
				foreach ($basePath as $value){
					$pathStr .= $value['title_en'].'/';
				}
			}
			$path = $pathStr;
		} else {
			$path = $pathStr.$row['id'].'.html';
		}
		$line = $baseUrl.$path;
//		echo $line.'<br>';
		writeToTxt($line);
		$parentType = $row['type'];
	}
}

function writeToTxt($line){
	global $linkTxt;
	file_put_contents($linkTxt, $line."\n", FILE_APPEND);
}
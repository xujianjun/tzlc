<?php
include('../header.php');

initNodeLinks();

function initNodeLinks(){
	$sql = 'select ts.*,td.* from tree_struct ts left join tree_data td on ts.id=td.id where ts.lvl>=2 order by ts.lft limit 10000';
	$result = mysql_query($sql);
	$sitemap = '';
	$basePath = array();
	$pathStr = '';
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
			$pathStr = '';
			if (count($basePath)){
				foreach ($basePath as $value){
					if ($value['title_en']){
						$pathStr .= $pathStr ? $value['title_en'].'/' : '/'.$value['title_en'].'/';
					}
				}
			}
			$path = $pathStr;
		} else {
			$path = $pathStr.$row['id'].'.html';
		}
		$parentType = $row['type'];
		$updateSql = 'update tree_data set link="'.$path.'" where id='.$row['id'];
		echo $row['id'].' -- '.$updateSql.'<br>';
		mysql_query($updateSql);
	}
}


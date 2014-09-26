<?php
header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$linkTxt = 'addsummary.txt';

$lnk = mysql_connect('114.215.210.34', 'licaimap', 'licaimap@2014')
       or die ('Not connected : ' . mysql_error());

// make foo the current db
mysql_select_db('touzilicai', $lnk) or die ('Can\'t use foo : ' . mysql_error());
mysql_query("set names utf8");

$rows = array();
//$sql:select td.* from tree_data td inner join tree_struct ts on td.id=ts.id where ts.type="article" and td.summary is NULL order by td.id
$sql = 'select td.* from tree_data td ' .
		'inner join tree_struct ts on td.id=ts.id ' .
		'where ts.type="article" and td.summary is NULL ' .
		'order by td.id limit 2000';
$result = mysql_query($sql);

$total = mysql_affected_rows();
$index = 0;
while ($row = mysql_fetch_assoc($result)){
	$index++;
	$content = $row['content'];
	$summary = gelSummary($content);
	$updateSql = 'update tree_data set summary="'.$summary.'" where id='.$row['id'];
	echo $updateSql;
	mysql_query($updateSql);
	$line = 'nid:'.$row['id'].', title:'.$row['title'].', summary:'.$summary;
//	echo 'line:'.$line.'<hr>';
	echo $index.'/'.$total.': '.$line.'<br>';
	writeToTxt($line);
	ob_flush();
	flush();
}

function gelSummary($content, $length=300){
	$filter = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
				 "'<img.*?>'i",
				 "'<iframe.*?>.*?<\/iframe>'si",
				 "'<font.*?>.*?<\/font>'si",
				 "'<strong.*?>.*?<\/strong>'i",
				 "'<b.*?>.*?<\/b>'si",
                 "'<[\/\!]*?[^<>]*?>'si",           // 去掉 HTML 标记
                 "'([\r\n])[\s]+'",                 // 去掉空白字符
                 "'&(quot|#34);'i",                 // 替换 HTML 实体
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e",		// 作为 PHP 代码运行
                 "'(nbsp;|ldquo;|rdquo;|<br>|<br/>|<br /|br/|　　|　　　　|/pp|p)'i");
    $endMarks = array('.','。',';','；','?','？','!','！');

    //去掉头尾空格
//	$content = strip_tags($content);
//	$content = trim($content);
	//截取前面total个字符
//	echo $length.'<hr>';
//	echo $content.'<hr>';

	//去掉过滤字符
	$content = preg_replace($filter, '', $content);
//	echo 'filter：'.$content.'<hr>';
	$content = strip_tags($content);

	$summary = mb_substr($content, 0, $length, 'utf-8');
//	echo '截取length：'.$summary.'<hr>';

	$summary = str_replace(array(' ','\'','"','’','‘','“','”'), '', $summary);
//	echo '去掉空字符：'.$summary.'<hr>';
	//查找终止字符
	$endPos = 0;
	foreach ($endMarks as $endMark){
		$endIndex = mb_strrpos($summary, $endMark, 'utf-8');
		$endPos = $endIndex > $endPos? $endIndex : $endPos;
	}
	$summary = mb_substr($summary, 0, $endPos+1, 'utf-8');
	$summary = str_replace(' ', '', $summary);
//	echo '寻找结尾：'.$summary.'<hr>';
	return $summary;
}

function writeToTxt($line){
	global $linkTxt;
	file_put_contents($linkTxt, $line."\n", FILE_APPEND);
}





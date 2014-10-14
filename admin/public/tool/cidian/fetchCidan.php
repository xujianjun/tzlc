<?php
header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');

$lnk = mysql_connect('114.215.210.34', 'licaimap', 'licaimap@2014')
       or die ('Not connected : ' . mysql_error());

// make foo the current db
mysql_select_db('touzilicai', $lnk) or die ('Can\'t use foo : ' . mysql_error());
mysql_query("set names utf8");


$result = mysql_query('select * from collect where sourceName="华股词典" and title="" order by id asc limit 2000');
$total = mysql_affected_rows();
$index = 0;
while ($row = mysql_fetch_assoc($result)){
	$index++;
	$id = $row['id'];
	$cidianUrl = $row['source'];
	$details = fetchDetails($cidianUrl);
//	echo '<pre>';print_r($details);echo '</pre>';continue;

	$sql = 'update collect set title="'.$details['title'].'",content="'.$details['content'].'" where id='.$id;
	mysql_query($sql) or die("Invalid query: " . mysql_error().', '.$sql);
	echo $index.'/'.$total.'<br>';

	ob_flush();
	flush();

}


function fetchDetails($cidianUrl){
	$detail = array();
	$content = file_get_contents($cidianUrl);

	$titlePattern = '/<h1 class="f14b">(.*?)<\/h1>/i';
	$contentPattern = '/<div class="cont"><div class="spage"><\/div>([\s\S]*?)<\/div>/i';

	preg_match($titlePattern, $content, $title_matches);
	$title = isset($title_matches[1]) ? $title_matches[1] : '';
	$title = trim(strip_tags($title));
	$detail['title'] = $title;

	preg_match($contentPattern, $content, $content_matches);
	$content = $content_matches[1];
	$content = trim(strip_tags($content));
	$content = str_replace('&nbsp;', '', $content);
	$detail['content'] = $content;
	return $detail;
}

<?php
/**
 *
 */
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
header("Content-type: text/html; charset=utf8");
$pageUrls = array(
	'http://study.huagu.com/cidian/cjch/',
	'http://study.huagu.com/cidian/zqch/',
	'http://study.huagu.com/cidian/qhch/',
	'http://study.huagu.com/cidian/qtch/'
);

$linkTxt = 'cidianLink.txt';
file_put_contents($linkTxt, '');

$baseUrl = 'http://study.huagu.com';
$links = array();
foreach($pageUrls as $pageUrl){
	$links = getLinks($pageUrl);
	writeToTxt($links);
	echo $pageUrl.', total:'.count($links).'<br>';
	ob_flush();
	flush();
}

function getLinks($pageUrl){
	$links = array();
	$listContentPattern = '/<div class="wordlist clearfix"><div class="cont blue">[\s\S]*?<\/div><\/div>/i';
	$linkPattern = '/<a href="(.*?)"[^>]*>.*?<\/a>/i';

	$content = file_get_contents($pageUrl);
	preg_match($listContentPattern, $content, $matches);
	$listContent = $matches[0];
	if ($listContent){
		preg_match_all($linkPattern, $listContent, $matches);
		$links = $matches[1];
	}

	return $links;
}
function writeToTxt($links){
	global $linkTxt, $baseUrl;
	foreach ($links as $link){
		file_put_contents($linkTxt, $baseUrl.$link."\n", FILE_APPEND);
	}
}

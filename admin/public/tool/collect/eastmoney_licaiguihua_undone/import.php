<?php
die();
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
header("Content-type: text/html; charset=utf8");

$lnk = mysql_connect('localhost', 'root', '123456')
       or die ('Not connected : ' . mysql_error());

// make foo the current db
mysql_select_db('touzilicai', $lnk) or die ('Can\'t use foo : ' . mysql_error());
mysql_query("set names utf8");

$sources = file('eastmoney.txt');
foreach ($sources as $source){
	$sql = 'insert into collect(source,sourceName) values("'.trim($source).'","东方财富理财规划")';
//	mysql_query($sql) or die("Invalid query: " . mysql_error());
	echo $sql.'<br>';
	ob_flush();
	flush();
}



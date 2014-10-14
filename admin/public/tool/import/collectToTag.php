<?php

include_once('../header.php');

$result = mysql_query('select * from collect where imported=0 and sourceName="华股词典" order by id asc limit 5000');
$total = mysql_affected_rows();
$index = 0;
while ($row = mysql_fetch_assoc($result)){
	$index++;
	$sql = 'insert into tags (name,description,source,sourceName) values("'.$row['title'].'","'.$row['content'].'","'.$row['source'].'","'.$row['sourceName'].'")';
//	echo $sql.'<br>';continue;
	mysql_query($sql) or die("Invalid query: " . mysql_error());
	$updateSql = 'update collect set imported=1 where id='.$row['id'];
	mysql_query($updateSql) or die("Invalid query: " . mysql_error());
	echo $index.'/'.$total.'<br>';
	ob_flush();
	flush();
}
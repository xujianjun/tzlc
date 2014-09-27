<?php
include('../header.php');
done();
$sql = 'SELECT *,count(*) as num FROM tree_data where id not in (6995,5996,5997) group by title having num>1 order by num desc';
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)){
	$res1 = mysql_query('select * from tree_struct where id='.$row['id']);
	$row1 = mysql_fetch_assoc($res1);
	if ($row1 && $row1['type']=='article'){
		$delSql = 'delete from tree_data where title="'.$row['title'].'" and id!='.$row['id'];
		echo $delSql.'<br>';
		mysql_query($delSql);
	}
}
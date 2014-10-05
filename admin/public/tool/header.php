<?php

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
error_reporting(0);
ini_set('display_errors', 'Off');

$linkTxt = 'addsummary.txt';

$lnk = mysql_connect('114.215.210.34', 'licaimap', 'licaimap@2014')
       or die ('Not connected : ' . mysql_error());

// make foo the current db
mysql_select_db('touzilicai', $lnk) or die ('Can\'t use foo : ' . mysql_error());
mysql_query("set names utf8");
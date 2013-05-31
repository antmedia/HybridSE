<?php
	$dbhost='localhost';
	$dbusername='root';
	$dbuserpass='';
	$dbname='formbuilder';
	$dbtname='form';

	mysql_connect($dbhost,$dbusername,$dbuserpass);
	mysql_select_db($dbname);
?>
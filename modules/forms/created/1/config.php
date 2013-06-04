<?php
    $dbhost='localhost';
    $dbusername='root';
    $dbuserpass='';
    $dbname='hybrid_se';

    $link_id=mysql_connect($dbhost,$dbusername,$dbuserpass) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
?>
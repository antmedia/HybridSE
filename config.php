<?php
    //error_reporting(E_ERROR); // Turn off all error reporting 
    //DATABASE LOGIN
    $dbhost='localhost';
    $dbusername='hybridpt';
    $dbuserpass='3N59khtP';
    $dbname='hybridpt_se';
    
    //Credenciais do servidor final
    //$dbhost='';
    //$dbusername='';
    //$dbuserpass='';
    //$dbname='';   
    
    //$db=new mysqli($dbhost,$dbusername,$dbuserpass,$dbname);

    $link_id=mysql_connect($dbhost,$dbusername,$dbuserpass) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
    
    $sql_config=mysql_query("SELECT * FROM config");
    while($dados_config=mysql_fetch_array($sql_config)){
        define($dados_config['term'],utf8_encode($dados_config['value']));
    }
    
    define("DATABASE_SITE",$dbname);  
?>
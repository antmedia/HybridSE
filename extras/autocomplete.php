<?php

sleep(1);
// no term passed - just exit early with no response
if (empty($_GET['term']))
    exit;
$q = strtolower($_GET["term"]);
// remove slashes if they were magically added
if (get_magic_quotes_gpc())
    $q = stripslashes($q);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

function list_something(){
	$sql=mysql_query("SELECT * FROM $_GET[what] WHERE status=1");
	$count=mysql_num_rows($sql);
	$aux=1;
	while($data=mysql_fetch_array($sql)){
		$vigula=($aux<$count)?NULL:",";
		$data['id'] => $data['name']$vigula;
		$aux++;
	}
}
	
$items = array(
	list_something();
    //"Great Bittern" => "Botaurus stellaris",
    //"Little Grebe" => "Tachybaptus ruficollis"
);


$result = array();
foreach ($items as $key => $value) {
    if (strpos(strtolower($key), $q) !== false) {
        array_push($result, array(
            "id" => $value,
            "label" => $key,
            "value" => strip_tags($key)
        ));
    }
    if (count($result) > 11)
        break;
}

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
echo json_encode($result);

?>
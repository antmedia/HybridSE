<?php
$app_id		= "549473515084151";
$app_secret	= "e4d42d5f5cd7c2d71f267bf04186156a";


$site_url	= "http://www.hybrid.pt/se/?st=fb1";

try{
	include_once "extras/insights/src/facebook.php";
}catch(Exception $e){
	error_log($e);
}
// Create our application instance
$facebook = new Facebook(array(
	'appId'		=> $app_id,
	'secret'	=> $app_secret,
	));

$user = $facebook->getUser();

if($user){
//==================== Single query method ======================================
	try{
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
}

if($user){
	$logoutUrl = $facebook->getLogoutUrl();
}else{
	// Get login URL
	$loginUrl = $facebook->getLoginUrl(array(
		'scope'			=> 'user_photos,email,manage_pages,read_insights,read_stream',
		'redirect_uri'	=> $site_url,
		));
}

if($user){
	
	// Save your method calls into an array
	$fields='id,name,email,accounts';
	$queries = array(
		array('method' => 'GET', 'relative_url' => '/me?fields='.$fields)
		);

	// POST your queries to the batch endpoint on the graph.
	try{
		$batchResponse = $facebook->api('?batch='.json_encode($queries), 'POST');
	}catch(Exception $o){
		error_log($o);
	}

	//string. Decode for use as a PHP array.
	$user_info		= json_decode($batchResponse[0]['body'], TRUE);
	if(count($user_info)==0) {
		//echo "<script>window.location.href='index.php'</script>";die;
	}
	$a_token=$facebook->getAccessToken();
} else if(basename($_SERVER['SCRIPT_NAME'])!="index.php"){
	echo "<script>window.location.href='index.php'</script>";die;
}

?>
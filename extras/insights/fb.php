<?php
$app_id		= "549473515084151";
$app_secret	= "60e02524ba99f7e063705806a0fea655";


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
	'cookie'	=> true
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
		'scope'			=> 'publish_stream,user_photos,user_about_me,manage_pages,read_insights,read_stream,user_birthday,user_location,user_work_history,user_hometown,email,user_likes',
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
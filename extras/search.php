<?php
/*
 * This is an example for the search. It returns
 * a JSON array of objects:
 * Format:
   [
		{
			"href" : "link to target page",
			"text" : "text which is shown in the results",
			"img" : "a URL to a 50x50 pixel image which is displayd with the result (optional)"
		},
		[more results...]
   ]
 */

ob_start();

sleep(1);

// Check for AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $term = trim($_POST['term']);
    
    // Example results array:
    $result = array(
        array(
            'href' => 'http://google.com',
            'text' => 'Description text',
            'img' => 'http://<url>/50x50.jpg'
        ),
        array(
            'href' => 'http://facebook.com',
            'text' => 'Description text'
        )
        
    );
    
	//$result = insideSite($term);
	
    // Demonstration: ThemeForest Results
    // $result = themeforesSearch($term);
   
	// Alternative: Wikipedia
	//$result = wikipediaSearch($term);
	
    echo json_encode($result);
}






ob_end_flush();
?>
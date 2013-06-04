<?php
	include("config.php");
	include("functions.php");
	
	$form_id=1;
?>
<meta charset="utf-8">

<link rel="stylesheet" href="styles.css">

<!--DatePicker-->
<link rel="stylesheet" type="text/css" href="lib/jscal/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="lib/jscal/css/border-radius.css" />
<script type="text/javascript" src="lib/jscal/js/jscal2.js"></script>
<script type="text/javascript" src="lib/jscal/js/lang/pt.js"></script>

<form action="" method="POST">
<?php design_form($form_id) ?>
</form>
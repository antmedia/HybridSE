<?php
	include("config.php");
	include("lib/functions.php");
	
	$form_id=1;
	
	if(!session_id()) session_start();
	
	if($_POST){
		if($_POST['secCode'] != $_SESSION['secCode']) {
			echo"Codigo errado";
		}
		else {
			echo"Enviado";
			$_SESSION['secCode'] = rand(100000, 999999);
		}
	}
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
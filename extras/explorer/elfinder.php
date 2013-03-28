<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>File Explorer</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
        <!--<script type="text/javascript" src="http://localhost/tinymce/last/jscripts/tiny_mce/tiny_mce_popup.js"></script>-->

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.full.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="js/i18n/elfinder.pt.js"></script>
		<!-- elFinder initialization (REQUIRED) -->
		<?php $myfolder=(isset($_GET['folder']) && $_GET['folder']!="")?$_GET['folder']:"/" ?>
		<script type="text/javascript" charset="utf-8">        
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
				    lang: 'pt',             // language (OPTIONAL)
					url : 'php/connector.php?folder=<?php echo $myfolder ?>',  // connector URL (REQUIRED)
                    getFileCallback : function(url) {
                        //path = url.path;
                        //path = url.url.replace('\', '/');
                        path = url.path;
                        var newString = path.replace(/\\/g,"/");
                        //FileBrowserDialogue.mySubmit(path);
                        window.tinymceFileWin.document.forms[0].elements[window.tinymceFileField].value = newString;
                        window.tinymceFileWin.focus();
                        window.close();
                    }
				}).elfinder('instance');			
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>

<?php
	function check_coupons($marca){
		$qrcode="www.danone.pt";
		$ean13="2222222222222";
		print_r("<tr>");
		print_r('<td><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http%3A//www.danone.pt&chld=H|0\"></td>');
		print_r("<td><h2> Desconto de $_POST[desconto]% para ".ucfirst($marca)."</h2> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis neque nisl, ac tempor urna. Sed elementum enim ligula.</td>");
		print_r('<td valign="top" align="right"><img src="http://localhost/hybrid_coupons/misc/10desconto.png" width="50px"></td>');
		print_r("</tr>");
		print_r("<tr>");
		print_r('<td colspan="2" align="center"><img src="http://localhost/hybrid_coupons/ean13/html/image.php?code=ean13&o=1&dpi=72&t=30&r=1&rot=0&text=$ean13&f1=Arial.ttf&f2=10&a1=&a2=&a3="></td>');
		print_r('<td><img src="http://localhost/hybrid_coupons/misc/danone_logo.png" width="100px">');
		print_r("</tr>");
	}
	
	function what_coupons(){
		$marcas=$_POST['marca'];
		$N = count($marcas);
		for($i=0; $i < $N; $i++){
			check_coupons($marcas[$i]);
		}
	}
?>

<meta charset="utf-8">
<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS -->
<link rel="stylesheet" href="http://www.ansonika.com/mastenia/css/base.css">
<link rel="stylesheet" href="http://www.ansonika.com/mastenia/css/skeleton.css">
<link rel="stylesheet" href="http://www.ansonika.com/mastenia/css/forms.css">
<link rel="stylesheet" href="http://www.ansonika.com/mastenia/css/layout.css">
<!-- Jquery -->
<script src="http://www.ansonika.com/mastenia/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	var sleepCounter = 0;
	function monitorFinding2() {
		var applet = document.jZebra;
		if (applet != null) {
			if (!applet.isDoneFinding()) {
				window.setTimeout('monitorFinding2()', 100);
			} else {
				var listing = applet.getPrinters();
				var printers = listing.split(',');
				for(var i in printers){
					document.getElementById("printersList").options[i]=new Option(printers[i]);
					//alert(printers[i]);
				}
			}
		} else {
			alert("O java não foi carregado. Por favor verifique se deu permissões para executar o Java ou se tem o Java Instalado");
		}
	}
	
	function findPrinter() {
		var applet = document.jZebra;
		if (applet != null) {
			// Searches for locally installed printer with "zebra" in the name
			applet.findPrinter(document.getElementById("printersList").value);
		}
		monitorFinding();
	}
	
	function findPrinters() {
		var applet = document.jZebra;
		if (applet != null) {
			// Searches for locally installed printer with "zebra" in the name
			applet.findPrinter(",");
		}
		monitorFinding2();
	}
	
	function monitorFinding() {
		monitorApplet('isDoneFinding()', 'alert("Impressora encontrada [" + document.jZebra.getPrinter() + "]")', 'monitor finding job');
    }
	  
	function monitorPrinting() {
		
		monitorApplet("isDonePrinting()", 'alert("Os dados foram enviados para a impressora [" + document.jZebra.getPrinter() + "] correctamente.")', "monitor printing job");
	}
	
	function monitorApplet(appletFunction, finishedFunction, description) {
		var NOT_LOADED = "jZebra ainda não carregou.";
		var INVALID_FUNCTION = 'jZebra não reconhece a função: "' + appletFunction; + '"';
		var INVALID_PRINTER = "jZebra não é capaz de encontrar a impressora";
		if (document.jZebra != null) {
			var finished = false;
			try {
				finished = eval('document.jZebra.' + appletFunction);
			} catch (err) {
				alert('jZebra Exception:  ' + INVALID_FUNCTION);
				return;
			}
			if (!finished) {
				window.setTimeout('monitorApplet("' + appletFunction + '", "' + 
				finishedFunction.replace(/\"/g,'\\"') + '", "' + description + '")', 100);
			} else {
				var p = document.jZebra.getPrinterName();
					if (p == null) {
					alert("jZebra Exception:  " + INVALID_PRINTER);
					return;
				}
				var e = document.jZebra.getException();
				if (e != null) {
					var desc = description == "" ? "" : " [" + description + "] ";
					alert("jZebra Exception: " + desc + document.jZebra.getExceptionMessage());
					document.jZebra.clearException();
				} else {
					eval(finishedFunction);
				}
			}
		} else {
			alert("jZebra Exception:  " + NOT_LOADED);
		}
    }
	
	//Testing
	function printHTML() {
		var applet = document.jZebra;
		if (applet != null) {
			<?php if(isset($_GET['choose'])) { ?>
			if (applet.getPrinterName() == null) {
                   applet.findPrinter("<?php echo $_POST['impressoras'] ?>");
                   while (!applet.isDoneFinding()) {
                        // Wait
                   }
            }
			<?php } ?>

		// No suitable printer found, exit
		if (applet.getPrinter() == null) {
			alert("Could not find a suitable printer for an HTML document");
			return;
		}
		<?php if(isset($_GET['choose'])){ ?>
		applet.appendHTML('<html><table width="400px" style="border: 1px dashed green; padding: 10px">'+ '<?php what_coupons() ?>' +'</table></html>');
		//applet.appendHTML('<html><table width="400px" style="border: 1px dashed green; padding: 10px">TESTE</table></html>');
		<?php } else { ?>
		applet.appendHTML('<html></html>');		   
		<?php } ?>
		}

		// Very important for html, uses printHTML() instead of print()
		monitorAppending3();
    }
      
	// Fixes some html formatting for printing. Only use on text, not on tags!  Very important!
	//    1.  HTML ignores white spaces, this fixes that
	//    2.  The right quotation mark breaks PostScript print formatting
	//    3.  The hyphen/dash autoflows and breaks formatting  
    function fixHTML(html) {
		return html.replace(/ /g, "&nbsp;").replace(/â€™/g, "'").replace(/-/g,"&#8209;");
	}
	
	function monitorAppending3() {
		var applet = document.jZebra;
		if (applet != null) {
			if (!applet.isDoneAppending()) {
				window.setTimeout('monitorAppending3()', 100);
			} else {
				applet.printHTML(); // Don't print until all of the image data has been appended
				monitorPrinting();
			}
		} else {
			alert("Applet not loaded!");
		}
	}
</script>
</head>

<applet name="jZebra" code="jzebra.PrintApplet.class" alt="jZebra did not load properly" archive="dist/jzebra.jar" width="0" height="0">
	<param name="printer" value="zebra">
</applet>

<?php if(isset($_GET['choose'])) {?>
<body onload="printHTML()">
<?php } else { ?>
<body onload="findPrinters()">
<?php } ?>

<section id="form_area">
  <div id="shadow"></div>
  <article class="container">
    <div class=" four columns" id="top-msg">
      <div id="top-msg-wp">
        <h1>Imprimir cupões</h1>
        <h2>Complete o formulário</h2>
      </div>
    </div>
    <div class="twelve columns" >
      <form id="custom" action="?choose" method="POST" >
      
        <fieldset title="Passo 1">
          <legend>Cupões</legend>
          <div class="five columns alpha">
			<label>Actimel</label>
            <img src="misc/marcas/actimel.jpg" width="40px" height="40px">
			<input type="checkbox" name="marca[]" value="Actimel" />
          </div>
          <div class="five columns omega">
			<label>Activia</label>
			<img src="misc/marcas/activia.jpg" width="40px" height="40px">
            <input type="checkbox" name="marca[]" value="Activia" />
          </div>
          <div class="five columns alpha " >
			<label>Corpos Danone</label>
			<img src="misc/marcas/corpos_danone.jpg" width="40px" height="40px">
            <input type="checkbox" name="marca[]" value="Corpos Danone" />
          </div>
		  <div class="five columns omega">
			<label>Danacol</label>
			<img src="misc/marcas/danacol.png" width="40px" height="40px">
            <input type="checkbox" name="marca[]" value="Danacol" />
          </div>
		  <div class="five columns alpha " >
			<label>Danoninho</label>
			<img src="misc/marcas/danoninho.gif" width="40px" height="40px">
            <input type="checkbox" name="marca[]" value="Danoninho" />
          </div>
		  <div class="five columns omega">
			<label>DanUp</label>
			<img src="misc/marcas/danup.jpg" width="40px" height="40px">
            <input type="checkbox" name="marca[]" value="DanUp" />
          </div>
        </fieldset><!-- End Step one -->
        
        <fieldset title="Passo 2" >
			<legend>Desconto</legend>
			<div class="five columns alpha" >
				<label>Escolha o desconto que pretende</label>
				<select name="desconto">
					<option value="">Escolher</option>
					<option value="10">10%</option>
					<option value="20">20%</option>
					<option value="30">30%</option>
					<option value="40">40%</option>
					<option value="50">50%</option>
				</select>
			</div>
        </fieldset><!-- End Step two -->
        
        <fieldset title="Passo 3">
			<legend>Imprimir</legend>
			<div class="five columns alpha" >
				<label>Lista de impressoras</label>
				<select id="printersList" name="impressoras"></select>
			<div class="five columns omega">
				<input type="button" onClick="findPrinter()" value="Escolher impressora">
			</div>
				<!--<input type="button" onClick="printFile();" value="Imprimir ficheiro">-->
			
			<!--<div class="five columns omega">
				<input type="button" onClick="printHTML();" value="Imprimir HTML">
			</div>
			-->
        </fieldset><!-- End Step three -->
        
        <input type="submit" class="finish" value="Finish!" />
      </form>
    </div>
  </article>
  <div id="shadow_2"></div>
</section><!-- End Form Area -->

<!-- Form style  --> 
<script src="http://www.ansonika.com/mastenia/js/jquery.uniform.js"></script> 
<script type="text/javascript" >
      $(function(){
        $("input[type='text'],input[type='email'],input[type='radio'],input[type='checkbox'],input[type='date'], textarea, select").uniform();
      });
</script>
<!-- JQUERY plugins: Poshy Tip, GMAP3, jQuery Validation, Tabs --> 
<script src="http://www.ansonika.com/mastenia/js/plug_ins.js"></script>
<script src="http://www.ansonika.com/mastenia/js/jquery.stepy.min.js"></script>
<script src="js/validate.js"></script>
</body>
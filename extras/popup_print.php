<?php
	include("../config.php");
?>
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
			if (applet.getPrinterName() == null) {
                   applet.findPrinter("EPSON");
                   while (!applet.isDoneFinding()) {
                        // Wait
                   }
            }

		// No suitable printer found, exit
		if (applet.getPrinter() == null) {
			alert("Could not find a suitable printer for an HTML document");
			return;
		}
		applet.appendHTML('<html>');
		<?php
			$coupons=explode(',',$_GET['coupons']);
				foreach($coupons as $copao){
					$dataproducts=mysql_fetch_array(mysql_query("SELECT * FROM shop_products WHERE id_shop_products='$copao'"));
					$datacoupons=mysql_fetch_array(mysql_query("SELECT * FROM clients_coupons WHERE fk_shop_products='$dataproducts[id_shop_products]'"));
		?>
					applet.appendHTML('<table width="400px" style="border: 1px dashed green; padding: 10px; margin: 10px">');
					applet.appendHTML('<tr>');
					applet.appendHTML('<td><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http%3A//www.danone.pt&chld=H|0\"></td>');
					applet.appendHTML('<td><h2> Desconto de 10% para <?php print_r($dataproducts['name_shop_products']) ?></h2> <?php print_r($dataproducts['intro_text_shop_products']) ?></td>');
					applet.appendHTML('<td valign="top" align="right"><img src="http://www.hybrid.pt/se/extras/coupons/misc/10desconto.png" width="50px"><br><?php print_r($datacoupons['print_code_clients_coupons']) ?></td>');
					applet.appendHTML('</tr>');
					applet.appendHTML('<tr>');
					applet.appendHTML('<td colspan="2" align="center"><img src="http://www.hybrid.pt/se/extras/coupons/ean13/html/image.php?code=ean13&o=1&dpi=72&t=30&r=1&rot=0&text=<?php print_r($dataproducts['code_min_shop_products']) ?>&f1=Arial.ttf&f2=10&a1=&a2=&a3="></td>');
					applet.appendHTML('<td><img src="http://www.hybrid.pt/se/extras/coupons/misc/danone_logo.png" width="100px">');
					applet.appendHTML('</tr>');
					applet.appendHTML('</table>');	
					<?php } ?>
					
		}
		applet.appendHTML('</html>');
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
<link rel="stylesheet" href="../css/elements.css">
<center>
<applet name="jZebra" code="jzebra.PrintApplet.class" alt="jZebra did not load properly" archive="coupons/dist/jzebra.jar" width="0" height="0">
	<param name="printer" value="zebra">
</applet>

<button onClick="findPrinters()" class="block">Procurar impressora</button><br>
<select id="printersList" name="impressoras"></select><br>
<input type="button" onClick="findPrinter()" value="Escolher impressora"><br>
<input type="button" onClick="printHTML()" value="Imprimir">
</center>
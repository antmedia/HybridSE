<div id="print_button_container"></div>
<script src="http://www.google.com/cloudprint/client/cpgadget.js">
</script>
<script>
    window.onload = function() {
	var gadget = new cloudprint.Gadget();
	gadget.setPrintButton(
            cloudprint.Gadget.createDefaultPrintButton("print_button_container")); //div id to contain the button
	gadget.setPrintDocument("[document mimetype]", "[document title]", "[document content]", "[encoding] (optional)");
    }
</script>
APENAS UM TESTE PARA VER COMO FICA

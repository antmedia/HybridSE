<script type="text/javascript" src="qrcode/js/jquery.min.js"></script>
<script type="text/javascript" src="qrcode/js/jquery.webcamqrcode.js"></script>

<script>
(function($){
	$('document').ready(function(){
		$('#qrcodebox').WebcamQRCode({
			onQRCodeDecode: function( p_data ){
				$('#qrcode_result').html( p_data );			
				//document.getElementById("mycoderesult").value=document.getElementById("qrcode_result").innerHTML;
				showVoucher(document.getElementById("qrcode_result").innerHTML);
				//alert(document.getElementById("qrcode_result").innerHTML);
				//document.getElementById("mycoderesult").value="TESTE";
			}
		});
		
		$('#btn_start').click(function(){
			$('#qrcodebox').WebcamQRCode().start();
		});
		
		$('#btn_stop').click(function(){
			$('#qrcodebox').WebcamQRCode().stop();
		});
	});
})(jQuery);

function showVoucher(str){
	if (str==""){
		document.getElementById("txtDesconto").innerHTML="";
		return;
	} 
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("txtDesconto").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax_functions.php?what=find_voucher&q="+str,true);
	xmlhttp.send();
}
</script>
<div style="width: 350px; height: 350px;" id="qrcodebox"></div>
<input type="button" value="Start" id="btn_start" /> 
<input type="button" value="Stop" id="btn_stop" />
Last QRCode value: <span id="qrcode_result">none</span>
<div id="txtDesconto"><b>O desconto será mostrado aqui</b></div>
<?php
	function list_coupons(){
		$sql=mysql_query("SELECT * FROM clients_coupons");
		while($data=mysql_fetch_array($sql)){
			echo "<tr class='gradeX'>
						<td>$data[id_clients_coupons]</td>
						<td>$data[fk_clients]</td>
						<td>$data[fk_shop_products]</td>
						<td class='center'><input type='checkbox' name='checkme[]'></td>
						<td class='center'><input type='text' size='6' maxlength='6' name='' id=''><input type='button' value='GO'></td>
						<td class='center'><a href='#' class='button small grey tooltip' data-gravity='s' title='Editar'><i class='icon-pencil'></i></a> <a href='#' class='button small grey tooltip' data-gravity='s' title='Apagar'><i class='icon-remove'></i></a></td>
					</tr>";
		}
	}
?>
<script type="text/javascript" src="extras/qr/js/jquery.webcamqrcode.js"></script>
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
	xmlhttp.open("GET","extras/ajax_functions.php?what=find_voucher&q="+str,true);
	xmlhttp.send();
}

function formSubmit(){ 
	$("#lista").attr("action", "/script.php");
	javascript:document.forms["lista"].submit();
} 
</script>

<h1 class="grid_12">Área de Cliente</h1>

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Lista de Cupóes</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a href="" onclick="formSubmit()"><i class="icon-print"></i>Imprimir cupões</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
				<thead>
					<tr>
						<th>ID</th>
						<th>ID Cliente</th>
						<th>ID Product</th>
						<th>Imprimir</th>
						<th>Activar</th>
						<th>Acções</th>
					</tr>
				</thead>
				<tbody>
					<form action="http://www.sapo.pt" name="lista" id="lista" method="POST">
					<?php list_coupons() ?>
					</form>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Table</h2>
		</div>
		
		<div class="content">
			<div style="width: 350px; height: 350px;" id="qrcodebox"></div>
			<input type="button" value="Start" id="btn_start" /><input type="button" value="Stop" id="btn_stop" /><br/>
			Last QRCode value: <span id="qrcode_result">none</span><div id="txtDesconto"><b>O desconto será mostrado aqui</b></div>
		</div>
	</div>
</div>
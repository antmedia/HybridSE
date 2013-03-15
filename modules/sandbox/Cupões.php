<?php
	/*
	function list_coupons(){
		$sql=mysql_query("SELECT * FROM clients_coupons");
		while($data=mysql_fetch_array($sql)){
			$mystatus=($data['status_clients_coupons']==0)?"<input type='text' size='6' maxlength='6' name='upstatus_$data[id_clients_coupons]' id='upstatus_$data[id_clients_coupons]'><input type='button' onclick=\"javascript:change_status(document.getElementById('upstatus_$data[id_clients_coupons]').value)\" value='GO'>":NULL;
			echo "<tr class='gradeX'>
						<td>$data[id_clients_coupons]</td>
						<td>$data[fk_clients]</td>
						<td>$data[fk_shop_products]</td>
						<td class='center'><input type='checkbox' class='mycheck' name='checkme[]' value='$data[fk_shop_products]'></td>
						<td class='center'>$mystatus</td>
						<td class='center'><a href='#' class='button small grey tooltip' data-gravity='s' title='Editar' onclick=\"javascript:return alert('Lamentamos mas esta opção ainda não se encontra disponível.')\"><i class='icon-pencil'></i></a> <a href='?st=$_GET[st]&del=$data[id_clients_coupons]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td>
					</tr>";
		}
	}
	*/
	
	if(isset($_GET['del'])){
		if(mysql_query("DELETE FROM clients_coupons WHERE id_clients_coupons='$_GET[del]'")) echo"<div class='alert success'><span class='icon'></span><span class='close'>x</span><strong>Apagado correctamente!</div>";
		else echo "<div class='alert error'><span class='icon'></span><span class='close'>x</span>Erro apagar. Por favor tente mais tarde.</div>";
	}
	
	if(isset($_GET['print'])){
		$data_products=mysql_fetch_array(mysql_query("SELECT * FROM shop_products WHERE id_shop_products='$_GET[print]'"));
	}
?>

<!-- Print Coupons Dialog -->
<div style="display: none;" id="dialog_print_coupons" title="Imprimir cupões" linkiframe="extras/popup_print.php">
	<iframe src="extras/popup_print.php" frameborder="0"></iframe>
</div>

<!-- Scan Coupons Dialog -->
<div style="display: none;" id="dialog_scan_coupons" title="Digitalizar cupões">
	<script type="text/javascript" src="extras/qrcode/js/jquery.webcamqrcode.js"></script>
	<div style="width: 350px; height: 350px;" id="qrcodebox"></div>
	<input type="button" value="Scan" id="btn_start" /> 
	<input type="button" value="Stop" id="btn_stop" />
	Last QRCode value: <span id="qrcode_result">none</span>
	<!--<div id="txtDesconto"><b>O desconto será mostrado aqui</b></div>-->
	<!--<iframe src="extras/popup_scan.php" frameborder="0" width="370" height="440"></iframe>-->
</div>

<script>
$$.ready(function() {
	$( "#dialog_print_coupons").dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ 
			$(this).parent().css('overflow', 'visible'); $$.utils.forms.resize(); 
			//Help by Hugo Pereira
			var matches = [];
			$(".mycheck:checked").each(function() {
				matches.push(this.value);
			});
			var iframe = $(this).find("iframe");
			$(iframe).attr("src","extras/popup_print.php?coupons="+matches);
			//Help by Hugo Pereira --
		}
	});
	$( "#dialog_scan_coupons" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	});
	
	$( ".open-print_coupons-dialog" ).click(function() {
		$( "#dialog_print_coupons" ).dialog( "open" );
		return false;
	});
	$( ".open-scan_coupons-dialog" ).click(function() {
		$( "#dialog_scan_coupons" ).dialog( "open" );
		return false;
	});
	
	AlimentaTabela();
});

function AlimentaTabela(){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			//alert(xmlhttp.responseText);
			//xmlhttp.responseType = 'text/html';
			document.getElementById("tabela_alimentada").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","extras/ajax_functions.php?what=alimenta_tabela",true);
	xmlhttp.send();
}

function change_status(str){
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
			document.getElementById("tbody").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","extras/ajax_functions.php?what=voucher_status&q="+str,true);
	xmlhttp.send();
	AlimentaTabela();
}

//SCAN
(function($){
	$('document').ready(function(){
		$('#qrcodebox').WebcamQRCode({
			onQRCodeDecode: function( p_data ){
				$('#qrcode_result').html( p_data );			
				//document.getElementById("mycoderesult").value=document.getElementById("qrcode_result").innerHTML;
				showVoucher(document.getElementById("qrcode_result").innerHTML);
				//alert(document.getElementById("qrcode_result").innerHTML);
				//document.getElementById("mycoderesult").value="TESTE";
				AlimentaTabela();
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
</script>

<h1 class="grid_12">Área de Cliente</h1>

<div class="grid_12">

	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Lista de Cupóes</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-print_coupons-dialog" href="javascript:void(0);"><i class="icon-print"></i>Imprimir cupões</a>
					<a class="open-scan_coupons-dialog" href="javascript:void(0);"><i class="icon-camera"></i>Digitalizar cupões</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<form action="http://www.sapo.pt" name="lista" id="lista" method="POST">
			<table class="dynamic styled" data-table-tools='{"display":true}'>
			<thead>
					<tr>
						<th>ID</th>
						<th>ID Cliente</th>
						<th>ID Product</th>
						<th>Imprimir</th>
						<th>Activar</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody id="tabela_alimentada">
					<!--<span id="tabela_alimentada"></span>-->
					<?//php list_coupons() ?>
				</tbody>
			</table>
			</form>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->

</div><!-- End of .grid_12 -->
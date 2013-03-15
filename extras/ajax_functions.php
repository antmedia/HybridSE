<?php
	include('../config.php');
	
	$q=$_GET["q"];

	if($_GET['what']=="find_voucher"){
		$result = mysql_query("SELECT * FROM shop_products WHERE code_min_shop_products<='$q' AND code_max_shop_products>='$q'");
		$conta=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if($conta>0){
			
			$find_coupons=mysql_num_rows(mysql_query("SELECT * FROM clients_coupons WHERE fk_clients='1' AND fk_shop_products='$row[id_shop_products]'"));
			if($find_coupons==0){
				$random = substr(number_format(time() * rand(),0,'',''),0,6); //Random code to activate voucher
				if(mysql_query("INSERT INTO clients_coupons (fk_clients,fk_shop_products,print_code_clients_coupons) VALUES ('1','$row[id_shop_products]',$random)")) echo "Os dados foram gravados<br>";
				else echo "Erro ao gravar os dados";
				echo "O seu desconto é válido $row[id_shop_products]<br>";
			} else {
				echo "Esse voucher já se encontra registado na sua área de cliente.<br>";
			}
		} else {
			echo "Não foram encontrados registos<br>";
		}
		
	} else if($_GET['what']=="print"){
		$result = mysql_query("SELECT * FROM shop_products WHERE id_shop_products='$q'");
		$row = mysql_fetch_array($result);
		$data_client=mysql_fetch_array("SELECT * FROM clients_coupons WHERE fk_shop_products='$row[shop_products]'");
		print_r("<tr>");
		print_r('<td><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=http%3A//www.danone.pt&chld=H|0\"></td>');
		print_r("<td><h2> Desconto de 10% para $row[name_shop_products]</h2> $row[intro_text_shop_products]</td>");
		print_r('<td valign="top" align="right"><img src="http://localhost/hybrid_coupons/misc/10desconto.png" width="50px"><br>$row[print_code_clients_coupons]</td>');
		print_r("</tr>");
		print_r("<tr>");
		print_r('<td colspan="2" align="center"><img src="http://localhost/hybrid_coupons/ean13/html/image.php?code=ean13&o=1&dpi=72&t=30&r=1&rot=0&text='.$data_client['code_min_shop_products'].'&f1=Arial.ttf&f2=10&a1=&a2=&a3="></td>');
		print_r('<td><img src="http://localhost/hybrid_coupons/misc/danone_logo.png" width="100px">');
		print_r("</tr>");
		
	} else if($_GET['what']=="voucher_status"){
		if(mysql_query("UPDATE clients_coupons SET status_clients_coupons=1 WHERE print_code_clients_coupons='$q'")) echo"Actualizado";
		
	} else if($_GET['what']=="alimenta_tabela"){
		$sql=mysql_query("SELECT * FROM clients_coupons");
		while($data=mysql_fetch_array($sql)){
			$data_products=mysql_fetch_array(mysql_query("SELECT * FROM shop_products WHERE id_shop_products='$data[fk_shop_products]'"));
			$mystatus=($data['status_clients_coupons']==0)?"<input type='text' size='6' maxlength='6' name='upstatus_$data[id_clients_coupons]' id='upstatus_$data[id_clients_coupons]'><input type='button' onclick=\"javascript:change_status(document.getElementById('upstatus_$data[id_clients_coupons]').value)\" value='GO'>":"Activado";
			echo"<tr class='gradeX'>
						<td>$data[id_clients_coupons]</td>
						<td>$data[fk_clients]</td>
						<td>$data_products[name_shop_products]</td>
						<td class='center'><input type='checkbox' class='mycheck' name='checkme[]' value='$data[fk_shop_products]'></td>
						<td class='center'>$mystatus</td>
						<td class='center'><a href='#' class='button small grey tooltip' data-gravity='s' title='Editar' onclick=\"javascript:return alert('Lamentamos mas esta opção ainda não se encontra disponível.')\"><i class='icon-pencil'></i></a> <a href='?st=sb2&del=$data[id_clients_coupons]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td>
					</tr>";
		}
	}

mysql_close($con);
?>
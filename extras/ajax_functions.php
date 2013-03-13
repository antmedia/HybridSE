<?php
	include('../config.php');
	
	$q=$_GET["q"];

if($_GET['what']=="find_voucher"){
	$result = mysql_query("SELECT * FROM shop_products WHERE code_min_shop_products>='$q' AND code_max_shop_products<='$q'");
	if($result){
		$row=mysql_fetch_array($result);
		$find_coupons=mysql_num_rows(mysql_query("SELECT * FROM clients_coupons WHERE fk_clients='1' AND fk_shop_products='$row[id_shop_products]'"));
		if($find_coupons==0){
			if(mysql_query("INSERT INTO clients_coupons (fk_clients,fk_shop_products) VALUES ('1','$row[id_shop_products]')")) echo "Os dados foram gravados";
			else echo "Erro ao gravar os dados";
			echo "O seu desconto é válido $row[id_shop_products]";
		} else {
			echo "Esse voucher já se encontra registado na sua área de cliente.";
		}
	} else {
		echo "Não foram encontrados registos";
	}
} else if($_GET['what']=="change_status"){

}

mysql_close($con);
?>
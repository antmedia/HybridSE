<?php
	function list_produtos(){
		$sql=mysql_query("SELECT * FROM shop_products");
		while($data=mysql_fetch_array($sql)){
			echo "<tr class='gradeX'>
						<td>$data[id_shop_products]</td>
						<td>$data[name_shop_products]</td>
						<td class='center'>$data[code_min_shop_products]</td>
						<td class='center'>$data[code_max_shop_products]</td>
						<td class='center'>$data[validity_shop_products]</td>
					</tr>";
		}
	}
?>

<h1 class="grid_12">Listagem de Produtos</h1>

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Table</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="javascript:void(0);"><i class="icon-plus"></i>Adicionar produto</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>MIN</th>
						<th>MAX</th>
						<th>Validade</th>
					</tr>
				</thead>
				<tbody>
					<?php list_produtos() ?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->
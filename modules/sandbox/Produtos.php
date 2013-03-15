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
						<td class='center'><a href='#' class='button small grey tooltip' data-gravity='s' title='Editar' onclick=\"javascript:return alert('Lamentamos mas esta opção ainda não se encontra disponível.')\"><i class='icon-pencil'></i></a> <a href='?st=$_GET[st]&del=$data[id_shop_products]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td>
					</tr>";
		}
	}
	
	if(isset($_GET['fadd'])){
		if(mysql_query("INSERT INTO shop_products (name_shop_products,title_shop_products,intro_text_shop_products,full_text_shop_products,code_min_shop_products,code_max_shop_products,validity_shop_products) VALUES ('$_POST[name_shop_products]','$_POST[title_shop_products]','$_POST[intro_text_shop_products]','$_POST[full_text_shop_products]','$_POST[code_min_shop_products]','$_POST[code_max_shop_products]','$_POST[validity_shop_products]')")) echo"<div class='alert success'><span class='icon'></span><span class='close'>x</span><strong>Informação gravada correctamente!</div>";
		else echo "<div class='alert error'><span class='icon'></span><span class='close'>x</span>Erro ao gravar os seus dados. Por favor tente mais tarde.</div>";
	}
	
	if(isset($_GET['del'])){
		if(mysql_query("DELETE FROM shop_products WHERE id_shop_products='$_GET[del]'")) echo"<div class='alert success'><span class='icon'></span><span class='close'>x</span><strong>Apagado correctamente!</div>";
		else echo "<div class='alert error'><span class='icon'></span><span class='close'>x</span>Erro apagar. Por favor tente mais tarde.</div>";
	}
?>

<h1 class="grid_12">Produtos</h1>

<?php if(isset($_GET['add'])) { ?>
<form action="?st=<?php echo $_GET['st'] ?>&fadd" class="grid_12" method="POST">
	<fieldset>
		<legend>Inserir novo produto</legend>
		<div class="row"><label for="f3_date"><strong>Validade</strong></label><div><input type="date" name="validity_shop_products" id="validity_shop_products"  /></div></div>
		<div class="row"><label for="f1_normal_input"><strong>Nome</strong></label><div><input type="text" name="name_shop_products" id="name_shop_products" /></div></div>
		<div class="row"><label for="f1_normal_input"><strong>Título</strong></label><div><input type="text" name="title_shop_products" id="title_shop_products" /></div></div>
		<div class="row not-on-phone"><label for="f6_file"><strong>Imagem</strong></label><div><input type="file" id="image_shop_products" name="image_shop_products" /></div></div>
		<div class="row not-on-phone"><label for="f6_file"><strong>Texto de introdução</strong></label><div><textarea name="intro_text_shop_products" id="intro_text_shop_products" class="tinymce"></textarea></div></div>
		<div class="row not-on-phone"><label for="f6_file"><strong>Texto completo</strong></label><div><textarea name="full_text_shop_products" id="full_text_shop_products" class="tinymce"></textarea></div></div>
		<div class="row"><label for="f1_normal_input"><strong>Código mínimo</strong></label><div><input type="text" name="code_min_shop_products" id="code_min_shop_products" /></div></div>
		<div class="row"><label for="f1_normal_input"><strong>Código máximo</strong></label><div><input type="text" name="code_max_shop_products" id="code_max_shop_products" /></div></div>
		<div class="actions">
			<div class="left">
				<input type="reset" value="Cancel" />
			</div>
			<div class="right">
				<input type="submit" value="Send" name=send />
			</div>
		</div><!-- End of .actions -->
	</fieldset>
</form>

<?php } else { ?>
<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Lista de produtos</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="?st=<?php echo $_GET['st']?>&add"><i class="icon-plus"></i>Adicionar produto</a>
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
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php list_produtos() ?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->
<?php } ?>
<?php
	function list_tables(){
		$sql=mysql_query("SHOW TABLES FROM ".DATABASE_SITE);
		echo "<select name='sb_values_fields' id='sb_values_fields' class='search $required' data-placeholder='Escolha a tabela'>";
		echo "<option value=''></option>";
		while ($row = mysql_fetch_row($sql)) {
			//echo "Table: {$row[0]}\n";
			echo "<option value='$data_tbl[id]'>$row[0]</option>";
		}
		echo "</select>";
		mysql_free_result($result);
	}
	
	function list_fields(){
		$sql=mysql_query("SELECT * FROM fields");
		while($data=mysql_fetch_array($sql)){
			echo "<tr class='gradeA'><td>$data[name_fields]</td><td>$data[type_fields]</td><td>$data[required_fields]</td><td>$data[module_fields]</td><td class='center'><a href='#' class='button small grey tooltip' data-gravity='s' title='Editar' onclick=\"javascript:return alert('Lamentamos mas esta opção ainda não se encontra disponível.')\"><i class='icon-pencil'></i></a> <a href='?st=$_GET[st]&del=$data[id_shop_products]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td></tr>";
		}
	}
?>

<h1 class="grid_12 margin-top no-margin-top-phone">Criar módulo</h1>

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Campos</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="javascript:void(0);"><i class="icon-plus"></i>Novo campo</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
				<thead>
					<tr>
						<th>Campo</th>
						<th>Tipo</th>
						<th>Obrigatório</th>
						<th>Módulo</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php list_fields() ?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<div class="grid_6">
	<form action="?st=<?php echo $_GET['st'] ?>&send" class="box validate" method="POST">
	
		<div class="header">
			<h2>Adicionar campo</h2>
		</div>

		<div class="content" id="sheepItForm_template">
			<div class="row">
				<label for="name_fields">
					<strong>Nome do campo</strong>
				</label>
				<div>
					<input type='text' name='name_fields' id='name_fields'/>
				</div>
			</div>
			<div class="row">
				<label for="type_fields">
					<strong>Tipo de campo</strong>
				</label>
				<div>
					<select name="type_fields" id="type_fields" class="search" data-placeholder="Escolha o tipo de campo">
						<option value=""></option>
						<option value="text">Caixa de Texto</option> 
						<option value="password">Caixa de Palavra-Chave</option> 
						<option value="password_meter">Caixa de Palavra-Chave com medidor</option> 
						<option value="textarea_nogrow">Área de Texto sem crescer</option> 
						<option value="textarea_autogrow">Área de Texto que cresce</option> 
						<option value="wysiwyg">Editor de Texto</option> 
						<option value="select_search">Caixa de escolha com pesquisa</option> 
						<option value="select_nosearch">Caixa de escolha sem pesquisa</option> 
						<option value="select_tags">Caixa de escolha de Tags</option> 
						<option value="select_dual">Caixa de escolha dupla</option> 
						<option value="picker_date">Campo de Data</option> 
						<option value="picker_time">Campo de Hora</option> 
						<option value="picker_date_time">Campo de Data e Hora</option> 
						<option value="picker_color">Campo de escolha de Cor</option> 
						<option value="checkbox">Escolha múltipla</option> 
						<option value="radio">Escolha única</option> 
						<option value="slider">Escolha de valor</option> 
						<option value="slider_range">Escolha de intervalo</option> 
						<option value="image">Escolha de Imagem</option> 
						<option value="document">Escolha de Documento</option> 
					</select>
				</div>
			</div>
			<div class="row">
				<label for="txt_values_fields">
					<strong>Valores</strong>
				</label>
				<div>
					<?php list_tables() ?><br>
					Ou introduza os dados manualmente<br>
					<input type='text' name='txt_values_fields' id='txt_values_fields' placeholder="1,2,3;Sim,Não,Talvez"/>
				</div>
			</div>
			<div class="row">
				<label for="required_fields">
					<strong>Obrigatório</strong>
				</label>
				<div>
					<div><input type='checkbox' name='required_fields' id='required_fields' value='1'/> <label for='required'></label></div>
				</div>
			</div>
			<div class="row">
				<label for="help_fields">
					<strong>Ajuda</strong>
				</label>
				<div>
					<input type='text' name='help_fields' id='help_fields'/>
				</div>
			</div>
			<div class="row">
				<label for="predefined_fields">
					<strong>Valor predefinido</strong>
				</label>
				<div>
					<input type='text' name='predefined_fields' id='predefined_fields'/>
				</div>
			</div>
			<div class="row">
				<label for="placeholder_fields">
					<strong>Valor interno</strong>
				</label>
				<div>
					<input type='text' name='placeholder_fields' id='placeholder_fields'/>
				</div>
			</div>
		
		</div><!-- End of .content -->
		
		<div class="actions">
			<div class="left">
				
			</div>
			<div class="right">
				<input type="reset" value="Cancelar" />
				<input type="submit" value="Adicionar" name="submit" />
			</div>
		</div><!-- End of .actions -->
		
	</form><!-- End of .box -->
</div><!-- End of .grid_4 -->
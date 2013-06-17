<?php
	include("modules/forms/classes.php");
	
	if(isset($_GET['fadd'])){
		EditOnTable("form_fields","id,sort,style,status,created,delete",NULL); //$table,$ignore,$id_item=NULL
	}
	
	if(isset($_GET['fedit'])){
		EditOnTable("form_fields","id,sort,style,status,created,delete",$_GET['id_field']); //$table,$ignore,$id_item=NULL
	}
	
	if(isset($_GET['delete'])){
		DeleteFromTable("form_fields",$_GET['delete']);
	}
	
	if(isset($_GET['save_css'])){
		Kint::dump( $_POST );
	
		$arquivo = "modules/forms/created/$_GET[form]/styles.css"; //Nome do arquivo para gravar
		if (file_exists($arquivo)) {
			unlink($arquivo);
			$connection = "O ficheiro já existe!";
		} 
		$abrir = fopen($arquivo, "a"); //Abrir o arquivo
		$para_gravar="
form input[type=\"text\"], form textarea, form select{
	border-color: $_POST[inside_border_color];
	background-color: $_POST[inside_background_color];
	border-radius: $_POST[inside_border_radius];
	-moz-border-radius: $_POST[inside_border_radius];
	-webkit-border-radius: $_POST[inside_border_radius];
	-ms-border-radius: $_POST[inside_border_radius];
	padding: $_POST[inside_padding];
	margin: $_POST[inside_margin];
	width: $_POST[inside_width];
	height: $_POST[inside_height];
	font-family: $_POST[inside_font_family];
	font-size: $_POST[inside_font_size];
	color: $_POST[inside_font_color];
}

.outside{
	border-color: $_POST[outside_border_color];
	background-color: $_POST[outside_background_color];
	border-radius: $_POST[outside_border_radius];
	-moz-border-radius: $_POST[outside_border_radius];
	-webkit-border-radius: $_POST[outside_border_radius];
	-ms-border-radius: $_POST[outside_border_radius];
	padding: $_POST[outside_padding];
	margin: $_POST[outside_margin];
	width: $_POST[outside_width];
	height: $_POST[outside_height];
}

form label{
	padding: $_POST[label_padding];
	margin: $_POST[label_margin];
	font-family: $_POST[label_font_family];
	font-size: $_POST[label_font_size];
	color: $_POST[label_font_color];
}
";
		if(fwrite($abrir, $para_gravar)) alert_box("success","Sucesso!","Os estilos do seu formulário foram gravados com sucesso");//Codigo inicial do ficheiro
		else alert_box("error","Erro","Existiu um erro ao gravar os estilos do seu formulário.");
		
		mkdir("modules/forms/created/$_GET[form]/lib/jscal", 0700); //Para criar pasta
		echo recurse_copy("modules/forms/copy/jscal","modules/forms/created/$_GET[form]/lib/jscal");
		
	}
	
	if(isset($_GET['style_field'])){
		
		Kint::dump( $_POST );
	}
	
	$data_form=mysql_fetch_array(mysql_query("SELECT * FROM forms WHERE id_forms='$_GET[form]'"));
	$data_field=mysql_fetch_array(mysql_query("SELECT * FROM form_fields WHERE id_form_fields='$_GET[edit]'"));
?>

<script type="text/javascript" src="modules/forms/js/change_styles.js"></script>
<h1 class="grid_12"><?php echo __("Edit")." $data_form[title_forms] ".__("form") ?></h1>
<h2 class="grid_12"><a href="?st=f1"><?php echo __("Back to forms") ?></a></h2>

<?php list_step_form($_GET['form']) ?>

<?php if(isset($_GET['add'])) {?>
<!-- Form preview -->
<div class="grid_6">
	<div class="box">
				
		<div class="header">
			<h2>Form Test</h2>
		</div>
		
		<div class="content">
			<iframe src="modules/forms/created/<?php echo $_GET['form'] ?>/index.php" width="100%" height="600px" frameborder="0" id="form_preview"></iframe>
		</div>
	</div>
</div>
<!-- //Form preview -->
<div class="grid_6">
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&step=$_GET[step]&fadd"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Properties</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Step","step_form_fields",$_GET['step']); ?>
			<?php fields_type("Title","title_form_fields"); ?>
			<?php fields_type("Name","name_form_fields"); ?>
			<?php fields_type("Type","type_form_fields"); ?>
			<?php fields_type("Required","required_form_fields"); ?>
			<?php fields_type("Validation","validation_form_fields"); ?>
		</div>
		<div class='actions'>
			<div class='left'>
				<input type="reset" value="<?php echo __("Cancel") ?>" />
			</div>
			<div class='right'>
				<input type="submit" value="<?php echo __("Submit") ?>" name="submit" />
			</div>
		</div>
	</form>
	<?//php CreateForm("Add Field","form_fields",NULL,"id,fk_forms,sort,step,style,created,delete,status","?st=$_GET[st]"); //($title,$table,$id,$ignore,$action) ?>
</div>
<?php } else if(isset($_GET['edit'])) {?>
<div class="grid_12">
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&id_field=$_GET[edit]&fedit"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Properties</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Step","step_form_fields",$_GET['step']); ?>
			<?php fields_type("Title","title_form_fields",$data_field['title_form_fields']); ?>
			<?php fields_type("Name","name_form_fields",$data_field['name_form_fields']); ?>
			<?php fields_type("Type","type_form_fields",$data_field['type_form_fields']); ?>
			<?php fields_type("Required","required_form_fields",$data_field['required_form_fields']); ?>
			<?php fields_type("Validation","validation_form_fields",$data_field['validation_form_fields']); ?>
		</div>
		<div class='actions'>
			<div class='left'>
				<input type="reset" value="<?php echo __("Cancel") ?>" />
			</div>
			<div class='right'>
				<input type="submit" value="<?php echo __("Submit") ?>" name="submit" />
			</div>
		</div>
	</form>
	<?//php CreateForm("Add Field","form_fields",NULL,"id,fk_forms,sort,step,style,created,delete,status","?st=$_GET[st]"); //($title,$table,$id,$ignore,$action) ?>
</div>

<!-- Form preview -->
<div class="grid_8">
	<div class="box">
				
		<div class="header">
			<h2>Form Test</h2>
		</div>
		
		<div class="content">
			<iframe src="modules/forms/created/<?php echo $_GET['form'] ?>/index.php" width="100%" height="600px" frameborder="0" id="form_preview"></iframe>
		</div>
	</div>
</div>
<!-- //Form preview -->

<div class="grid_4">
	<div class="box tabbedBox">
		<form action='<?php echo "?st=f2&form=$_GET[form]&step=$_GET[step]&style_field=$_GET[edit]"?>' method='post'>
			<?php
				switch($data_field['type_form_fields']){
					case "text": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					case "textarea": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					case "select": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					case "radio": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					case "checkbox": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					case "datepicker": fields_styles("Field Styles","global,inside,outside,label,button",$data_field['name_form_fields']); break;
					case "submit": fields_styles("Field Styles","global,inside,outside,label,button",$data_field['name_form_fields']); break;
					case "reset": fields_styles("Field Styles","global,inside,outside,label,button",$data_field['name_form_fields']); break;
					case "button": fields_styles("Field Styles","global,inside,outside,label,button",$data_field['name_form_fields']); break;
					case "secCode": fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
					default : fields_styles("Field Styles","global,inside,outside,label",$data_field['name_form_fields']); break;
				}
			?>
			<div class='actions'>
				<div class='left'>
					<input type="reset" value="<?php echo __("Cancel") ?>" />
				</div>
				<div class='right'>
					<input type="submit" value="<?php echo __("Submit") ?>" name="submit" />
				</div>
			</div>
		</form>
	</div>
</div>
<?php } else { ?>
<!-- Form preview -->
<div class="grid_8">
	<div class="box">
				
		<div class="header">
			<h2>Form Test <a href="javascript:document.getElementById('form_preview').location.reload();">Actualizar</a></h2>
		</div>
		
		<div class="content">
			<iframe src="modules/forms/created/<?php echo $_GET['form'] ?>/index.php" width="100%" height="600px" frameborder="0" id="form_preview"></iframe>
		</div>
	</div>
</div>
<!-- //Form preview -->
<div class="grid_4">
	<div class="box tabbedBox">
		<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&save_css"?>' method='post'>
			<?php fields_styles("General Styles","inside,outside,label",$field) ?>
			<div class='actions'>
				<div class='left'>
					<input type="reset" value="<?php echo __("Cancel") ?>" />
				</div>
				<div class='right'>
					<input type="submit" value="<?php echo __("Submit") ?>" name="submit" />
				</div>
			</div>
		</form>
	</div>
</div>

<?php } ?>
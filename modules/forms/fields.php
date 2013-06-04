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
		$arquivo = "modules/forms/created/$_GET[form]/styles.css"; //Nome do arquivo para gravar
		if (file_exists($arquivo)) {
			unlink($arquivo);
			$connection = "O ficheiro já existe!";
		} 
		$abrir = fopen($arquivo, "a"); //Abrir o arquivo
		$para_gravar="
form input, form textarea, form select{
	border-color: $_POST[style_border_color];
	background-color: $_POST[style_background_color];
	padding: $_POST[style_padding];
	margin: $_POST[style_margin];
	width: $_POST[style_width];
	height: $_POST[style_height];
	font-family: $_POST[style_font_family];
	font-size: $_POST[style_font_size];
	color: $_POST[style_font_color];
	border-radius': $_POST[border_radius];
	-moz-border-radius': $_POST[border_radius];
	-webkit-border-radius': $_POST[border_radius];
	-ms-border-radius': $_POST[border_radius];
}
";
		if(fwrite($abrir, $para_gravar)) alert_box("success","Sucesso!","Os estilos do seu formulário foram gravados com sucesso");//Codigo inicial do ficheiro
		else alert_box("error","Erro","Existiu um erro ao gravar os estilos do seu formulário.");
		
		mkdir("modules/forms/created/$_GET[form]/lib/jscal", 0700); //Para criar pasta
		echo recurse_copy("modules/forms/copy/jscal","modules/forms/created/$_GET[form]/lib/jscal");
	}
	
	$data_form=mysql_fetch_array(mysql_query("SELECT * FROM forms WHERE id_forms='$_GET[form]'"));
	$data_field=mysql_fetch_array(mysql_query("SELECT * FROM form_fields WHERE id_form_fields='$_GET[edit]'"));
?>

<script type="text/javascript" src="modules/forms/js/change_styles.js"></script>
<h1 class="grid_12"><?php echo __("Edit")." $data_form[title_forms] ".__("form") ?></h1>
<h2 class="grid_12"><a href="?st=f1"><?php echo __("Back to forms") ?></a></h2>

<?php list_step_form($_GET['form']) ?>
	
<?php if(isset($_GET['add'])) {?>
<div class="grid_6">
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&step=$_GET[step]&fadd"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Properties</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Step","step_form_fields",$_GET['step']); ?>
			<?php fields_type("Name","name_form_fields"); ?>
			<?php fields_type("Type","type_form_fields"); ?>
			<?php fields_type("Required","required_form_fields"); ?>
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
	
<div class="grid_6">
	<form action='#' method='post' class='box validate'>
		<div class='header'>
			<h2>Field Styles</h2>
		</div>
		<div class='content'>
			<?php fields_type("Border color","style_border_color"); ?>
			<?php fields_type("Background color","style_background_color"); ?>
			<?php fields_type("Border Radius","border_radius"); ?>
			<?php fields_type("Padding","style_padding"); ?>
			<?php fields_type("Margin","style_margin"); ?>
			<?php fields_type("Width","style_width"); ?>
			<?php fields_type("Height","style_height"); ?>
			<?php fields_type("Font family","style_font_family"); ?>
			<?php fields_type("Font size","style_font_size"); ?>
			<?php fields_type("Font color","style_font_color"); ?>
			<?php fields_type("Image button","style_image_button"); ?>
			<?php fields_type("Action submit button","action_submit_button","<script>
	$(\"#action_submit_button\").click(function () {
	  //Action of this button
	});
</script>"); ?>
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
</div>
<?php } else if(isset($_GET['edit'])) {?>
<div class="grid_6">
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&id_field=$_GET[edit]&fedit"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Properties</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Step","step_form_fields",$_GET['step']); ?>
			<?php fields_type("Name","name_form_fields",$data_field['name_form_fields']); ?>
			<?php fields_type("Type","type_form_fields",$data_field['type_form_fields']); ?>
			<?php fields_type("Required","required_form_fields",$data_field['required_form_fields']); ?>
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
<?php } ?>
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
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&save_css"?>' method='post' class='box validate'>
		<div class='header'>
			<h2>General Styles</h2>
		</div>
		<div class='content'>
			<?php fields_type("Border color","style_border_color"); ?>
			<?php fields_type("Background color","style_background_color"); ?>
			<?php fields_type("Border radius","border_radius"); ?>
			<?php fields_type("Padding","style_padding"); ?>
			<?php fields_type("Margin","style_margin"); ?>
			<?php fields_type("Width","style_width"); ?>
			<?php fields_type("Height","style_height"); ?>
			<?php fields_type("Font family","style_font_family"); ?>
			<?php fields_type("Font size","style_font_size"); ?>
			<?php fields_type("Font color","style_font_color"); ?>
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
</div>
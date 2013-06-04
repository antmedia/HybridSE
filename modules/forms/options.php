<?php
	include("modules/forms/classes.php");
	
	if(isset($_GET['fadd'])){
		EditOnTable("form_options","id,sort,status,created,delete",NULL); //$table,$ignore,$id_item=NULL
	}
	
	if(isset($_GET['fedit'])){
		EditOnTable("form_options","id,sort,status,created,delete",$_GET['option']); //$table,$ignore,$id_item=NULL
	}
	
	if(isset($_GET['delete'])){
		DeleteFromTable("form_options",$_GET['delete']);
	}
	
	$data_form=mysql_fetch_array(mysql_query("SELECT * FROM forms WHERE id_forms='$_GET[form]'"));
	$data_field=mysql_fetch_array(mysql_query("SELECT * FROM form_fields WHERE id_form_fields='$_GET[field]'"));
	$data_options=mysql_fetch_array(mysql_query("SELECT * FROM form_options WHERE id_form_options='$_GET[edit]'"));
?>

<script type="text/javascript" src="modules/forms/js/change_styles.js"></script>
<h1 class="grid_12"><?php echo __("Edit")." $data_field[name_form_fields] ".__("options from ")." $data_form[title_forms] ".__("form") ?></h1>
<h2 class="grid_12"><a href="?st=f2&form=<?php echo $_GET['form'] ?>"><?php echo __("Back to fields") ?></a></h2>

<div class="grid_6">
	<div class="box">
		
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("List")." $data_field[name_form_fields] ".__("options") ?></h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="?st=<?php echo $_GET['st'] ?>&form=<?php echo $_GET['form']?>&field=<?php echo $_GET['field'] ?>&add"><i class="icon-plus"></i><?php echo __("New option") ?></a>
				</div>
				<div class="right">								
				</div>
			</div>
			
			<?php ListTable("form_options","id,name,value,created","OptionEdit,OptionDelete") ?>
		
		</div>
		
	</div>
</div>

<?php if(isset($_GET['add'])) {?>
<div class="grid_6">
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&field=$_GET[field]&fadd"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Options</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Field","fk_form_fields",$_GET['field']); ?>
			<?php fields_type("Name","name_form_options"); ?>
			<?php fields_type("Value","value_form_options"); ?>
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
	<form action='<?php echo "?st=$_GET[st]&form=$_GET[form]&field=$_GET[field]&option=$_GET[edit]&fedit"?>' method='POST' class='box validate'>
		<div class='header'>
			<h2>Field Options</h2>
		</div>
		<div class='content'>
			<?php fields_type("Form","fk_forms",$_GET['form']); ?>
			<?php fields_type("Field","fk_form_fields",$_GET['field']); ?>
			<?php fields_type("Name","name_form_options",$data_options['name_form_options']); ?>
			<?php fields_type("Value","value_form_options",$data_options['value_form_options']); ?>
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
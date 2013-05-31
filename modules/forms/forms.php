<?php
	if(isset($_GET['fadd'])){
		EditOnTable("forms","id,status,created,delete",NULL); //$table,$ignore,$id_item=NULL
	}
	if(isset($_GET['fedit'])){
		EditOnTable("forms","id,status,created,delete",$_GET['form']); //$table,$ignore,$id_item=NULL
	}
	if(isset($_GET['delete'])){
		DeleteFromTable("forms",$_GET['delete']);
	}
?>
<h1 class="grid_12"><?php echo __("Forms") ?></h1>

<?php if(isset($_GET['add'])){ ?>
<div class="grid_12">
	<?php CreateForm("Add Form","forms",NULL,"id,created,delete,status","?st=$_GET[st]&fadd"); //($title,$table,$id,$ignore,$action) ?>
</div>

<?php } else if(isset($_GET['edit'])){ ?>
<div class="grid_12">
	<?php CreateForm("Edit Form Properties","forms",$_GET['edit'],"id,created,delete,status","?st=$_GET[st]&form=$_GET[edit]&fedit"); //($title,$table,$id,$ignore,$action) ?>
</div><!-- End of .grid_12 -->
<?php } else if(isset($_GET['create'])){ ?>
<div class="grid_6">
	<div class="box">
				
		<div class="header">
			<h2>Form</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="?st=<?php echo $_GET['st'] ?>&add"><i class="icon-plus"></i><?php echo __("New Fields") ?></a>
				</div>
				<div class="right">								
				</div>
			</div>
			
			<?php ListTable("form_fields","id,name,type,placeholder,created","edit,delete") ?>
		</div>
	</div>
</div>

<div class="grid_6">
	<?php CreateForm("Add Field","form_fields",NULL,"id,fk_forms,style,created,delete,status","?st=$_GET[st]"); //($title,$table,$id,$ignore,$action) ?>
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
				
		<div class="header">
			<h2>Form Test</h2>
		</div>
		
		<div class="content">
			<iframe src="modules/forms/created/1/index.php" width="100%" height="100%" frameborder="0"></iframe>
		</div>
	</div>
</div>

<div class="grid_6">
	<form action='#' method='post' class='box validate'>
		<div class='header'>
			<h2>Field Properties</h2>
		</div>
		<div class='content'>
			<?php fields_type("style_border_color"); ?>
			<?php fields_type("style_background_color"); ?>
			<?php fields_type("style_padding"); ?>
			<?php fields_type("style_margin"); ?>
			<?php fields_type("style_width"); ?>
			<?php fields_type("style_height"); ?>
			<?php fields_type("style_font_family"); ?>
			<?php fields_type("style_font_size"); ?>
			<?php fields_type("style_font_color"); ?>
		</div>
		<div class='actions'>
			<div class='left'>
				<input type='reset' value='Cancel' />
			</div>
			<div class='right'>
				<input type='submit' value='Submit' name=submit />
			</div>
		</div>
	</form>
</div><!-- End of .grid_12 -->
<?php } else { ?>
<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("List Forms") ?></h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="?st=<?php echo $_GET['st'] ?>&add"><i class="icon-plus"></i><?php echo __("New Form") ?></a>
				</div>
				<div class="right">								
				</div>
			</div>
			
			<?php ListTable("forms","id,title,created","edit,delete,see") ?>
		
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->
<?php } ?>
<?php
	include("modules/forms/classes.php");

	if(isset($_GET['fadd'])){
		EditOnTable("forms","id,status,created,delete",NULL); //$table,$ignore,$id_item=NULL
		$lastId=mysql_insert_id();
		mkdir("modules/forms/created/$lastId", 0700); //Para criar pasta
		$arquivo = "modules/forms/created/$lastId/config.php"; //Nome do arquivo para gravar
		if (file_exists($arquivo)) {
			unlink($arquivo);
			$connection = "O ficheiro já existe!";
		} 
		$abrir = fopen($arquivo, "a"); //Abrir o arquivo
		$para_gravar="<?php
	\$dbhost='$_POST[mysql_host_forms]';
	\$dbusername='$_POST[mysql_user_forms]';
	\$dbuserpass='$_POST[mysql_pass_forms]';
	\$dbname='$_POST[mysql_database_forms]';
	\$dbtname='$_POST[mysql_table_forms]';

	mysql_connect(\$dbhost,\$dbusername,\$dbuserpass);
	mysql_select_db(\$dbname);
?>";
		if(fwrite($abrir, $para_gravar)) alert_box("success","Sucesso!","O seu ficheiro de configuração da base de dados foi preparado com sucesso");//Codigo inicial do ficheiro
		else alert_box("error","Erro","Existiu um erro ao preparar o seu ficheiro de configuração à base de daddos.");
		if($_POST['form_action']){
			//sleep(5);//seconds to wait..
			if($_POST['form_action']=="add_new"){
				alert_box("information","Informação","Dentro de 5 segundos irá ser redireccionado. Clique <a href='?st=$_GET[st]&add'>aqui</a> caso contrário.");
				?>
				<script>
					var delay = 5000; //seconds to wait.. in milliseconds
					setTimeout(function(){ window.location = "<?php echo "?st=$_GET[st]&add" ?>"}, delay);
				</script>
				<?php
				//header("Location:/?st=$_GET[st]&add");
			} else if($_POST['form_action']=="edit_this"){
				alert_box("information","Informação","Dentro de 5 segundos irá ser redireccionado. Clique <a href='?st=$_GET[st]&edit=$lastId'>aqui</a> caso contrário.");
				?>
				<script>
					var delay = 5000; //seconds to wait.. in milliseconds
					setTimeout(function(){ window.location = "<?php echo "?st=$_GET[st]&edit=$lastId" ?>"}, delay);
				</script>
				<?php
				//header("Location:/?st=$_GET[st]&edit=$lastId");
			}
		}
	}
	
	if(isset($_GET['fedit'])){
		EditOnTable("forms","id,status,created,delete",$_GET['form']); //$table,$ignore,$id_item=NULL
		if($_POST['form_action']){
			//sleep(5);//seconds to wait..
			if($_POST['form_action']=="add_new"){
				alert_box("information","Informação","Dentro de 5 segundos irá ser redireccionado. Clique <a href='?st=$_GET[st]&add'>aqui</a> caso contrário.");
				?>
				<script>
					var delay = 5000; //seconds to wait.. in milliseconds
					setTimeout(function(){ window.location = "<?php echo "?st=$_GET[st]&add" ?>"}, delay);
				</script>
				<?php
				//header("Location:/?st=$_GET[st]&add");
			} else if($_POST['form_action']=="edit_this"){
				alert_box("information","Informação","Dentro de 5 segundos irá ser redireccionado. Clique <a href='?st=$_GET[st]&edit=$_GET[form]'>aqui</a> caso contrário.");
				?>
				<script>
					var delay = 5000; //seconds to wait.. in milliseconds
					setTimeout(function(){ window.location = "<?php echo "?st=$_GET[st]&edit=$_GET[form]" ?>"}, delay);
				</script>
				<?php
				//header("Location:/?st=$_GET[st]&edit=$_GET[form]");
			}
		}
	}

	if(isset($_GET['delete'])){
		DeleteFromTable("forms",$_GET['delete']);
		//Apagar pasta e ficheiros dentro dessa pasta
		$dir="modules/forms/created/$_GET[delete]";
		foreach(glob($dir . '/*') as $file) { 
			if(is_dir($file)) rrmdir($file); else unlink($file); 
		}
		if(rmdir("modules/forms/created/$_GET[delete]"))alert_box("success","Sucesso!","A pasta do seu formulário foi removida com sucesso"); //Remove a pasta
		else alert_box("error","Erro","Existiu um erro ao remover a pasta do seu formulário.");
	}
?>
<script type="text/javascript" src="modules/forms/js/change_styles.js"></script>

<h1 class="grid_12"><?php echo __("Forms") ?></h1>

<?php if(isset($_GET['add'])){ ?>
<div class="grid_12">
	<?php CreateForm("Add Form","forms",NULL,"id,created,delete,status","?st=$_GET[st]&fadd"); //($title,$table,$id,$ignore,$action) ?>
</div>

<?php } else if(isset($_GET['edit'])){ ?>
<div class="grid_12">
	<?php CreateForm("Edit Form Properties","forms",$_GET['edit'],"id,created,delete,status","?st=$_GET[st]&form=$_GET[edit]&fedit"); //($title,$table,$id,$ignore,$action) ?>
</div>

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
			
			<?php ListTable("forms","id,title,created","edit,delete,FieldCreate") ?>
		
		</div>
		
	</div>
</div>
<?php } ?>